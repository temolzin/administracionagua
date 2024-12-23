<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Debt;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('debt.customer')->orderBy('id', 'desc');

        if ($request->filled('name')) {
            $query->whereHas('debt.customer', function ($q) use ($request) {
                $q->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ['%' . $request->name . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', name) LIKE ?", ['%' . $request->name . '%']);
            });
        }

        if ($request->filled('period')) {
            $periodParts = explode('/', $request->period);
            $monthName = strtolower(trim($periodParts[0]));
            $year = trim($periodParts[1]);

            $months = [
                'enero' => 1,
                'febrero' => 2,
                'marzo' => 3,
                'abril' => 4,
                'mayo' => 5,
                'junio' => 6,
                'julio' => 7,
                'agosto' => 8,
                'septiembre' => 9,
                'octubre' => 10,
                'noviembre' => 11,
                'diciembre' => 12
            ];

            $monthNumber = $months[$monthName] ?? null;

            if ($monthNumber && $year) {
                $query->whereHas('debt', function ($q) use ($year, $monthNumber) {
                    $q->whereYear('start_date', $year)
                        ->whereMonth('start_date', $monthNumber)
                        ->orWhere(function ($q) use ($year, $monthNumber) {
                            $q->whereYear('end_date', $year)
                                ->whereMonth('end_date', $monthNumber);
                        });
                });
            }
        }

        $payments = $query->paginate(10);
        $customers = Customer::where('state', 1)
                     ->orWhereNull('state')
                     ->get();


        return view('payments.index', compact('payments', 'customers'));
    }

    public function getCustomerDebts(Request $request)
    {
        $customerId = $request->input('customer_id');
        $debts = Debt::where('customer_id', $customerId)
            ->whereNotIn('status', ['paid', 'united'])
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($debt) {
                $remainingAmount = $debt->amount - $debt->debt_current;

                return [
                    'id' => $debt->id,
                    'start_date' => $debt->start_date,
                    'end_date' => $debt->end_date,
                    'amount' => $debt->amount,
                    'remaining_amount' => $remainingAmount,
                ];
            });

        return response()->json(['debts' => $debts]);
    }

    public function store(Request $request)
    {
        $debt = Debt::findOrFail($request->debt_id);

        $remainingAmount = $debt->amount - $debt->debt_current;

        if ($request->amount > $remainingAmount) {
            return redirect()->route('payments.index')
                ->with('error', 'El monto del pago supera la cantidad restante de la deuda.');
        }

        Payment::create([
            'debt_id' => $request->debt_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'note' => $request->note,
        ]);

        $debt->debt_current += $request->amount;

        if ($debt->debt_current >= $debt->amount) {
            $debt->status = 'paid';
        } elseif ($debt->debt_current > 0) {
            $debt->status = 'partial';
        } else {
            $debt->status = 'pending';
        }

        $debt->save();

        return redirect()->route('payments.index')->with('success', 'Pago creado exitosamnete.');
    }

    public function update(Request $request, Payment $payment)
    {
        $debt = $payment->debt;

        $previousAmount = $payment->amount;
        $remainingAmount = $debt->amount - $debt->debt_current + $previousAmount;

        if ($request->amount > $remainingAmount) {
            return redirect()->route('payments.index')
                ->with('error', 'El monto del pago supera la cantidad restante de la deuda.');
        }

        $debt->debt_current -= $previousAmount;
        $payment->update([
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'note' => $request->note,
        ]);

        $debt->debt_current += $request->amount;

        if ($debt->debt_current >= $debt->amount) {
            $debt->status = 'paid';
        } elseif ($debt->debt_current > 0) {
            $debt->status = 'partial';
        } else {
            $debt->status = 'pending';
        }

        $debt->save();

        return redirect()->route('payments.index')->with('success', 'Pago actualizado exitosamnete.');
    }


    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        if (!$payment) {
            return redirect()->back()->with('error', 'Pago no encontrado.');
        }

        return redirect()->route('payments.index')->with('success', 'Pago eliminado exitosamnete.');
    }

    public function annualEarningsReport($year)
    {
        $year = intval($year);

        $monthlyEarnings = [];
        $totalEarnings = 0;

        for ($month = 1; $month <= 12; $month++) {
            $earnings = Payment::whereYear('payment_date', $year)
                ->whereMonth('payment_date', $month)
                ->sum('amount');

            $monthlyEarnings[$month] = $earnings;
            $totalEarnings += $earnings;
        }

        $pdf = PDF::loadView('reports.annualEarnings', compact('monthlyEarnings', 'totalEarnings', 'year'));

        return $pdf->stream('annual_earnings_' . $year . '.pdf');
    }

    public function weeklyEarningsReport(Request $request)
    {
        $startDate = Carbon::parse($request->input('weekStartDate'));
        $endDate = Carbon::parse($request->input('weekEndDate'));
    
        $weeks = [];
        $currentStart = $startDate->copy();
        $totalPeriodEarnings = 0;
    
        while ($currentStart->lte($endDate)) {
            $currentEnd = $currentStart->copy()->endOfWeek();
            if ($currentEnd->gt($endDate)) {
                $currentEnd = $endDate;
            }
    
            $dailyEarnings = [];
            $dailyFolios = [];
            $day = $currentStart->copy();
            $weekPayments = collect();

            while ($day->lte($currentEnd)) {
                $payments = Payment::whereDate('payment_date', $day->toDateString())->get();
                $earnings = $payments->sum('amount');

                $weekPayments = $weekPayments->merge($payments);

                $dailyEarnings[$day->format('l')] = $earnings;
                $day->addDay();
            }
    
            if ($weekPayments->isNotEmpty()) {
                $firstPayment = $weekPayments->first();
                $lastPayment = $weekPayments->last();
                $dailyFolios['first'] = $firstPayment->id;
                $dailyFolios['last'] = $lastPayment->id;
            }
    
            $totalPeriodEarnings += array_sum($dailyEarnings);
    
            $weeks[] = [
                'start' => $currentStart->toDateString(),
                'end' => $currentEnd->toDateString(),
                'dailyEarnings' => $dailyEarnings,
                'dailyFolios' => $dailyFolios,
            ];
    
            $currentStart = $currentEnd->copy()->addDay();
        }
    
        $pdf = PDF::loadView('reports.weeklyEarnings', compact('weeks', 'totalPeriodEarnings'))
            ->setPaper('A4', 'portrait');
    
        return $pdf->stream('weekly_earnings_' . now()->format('Ymd') . '.pdf');
    }

    public function receiptPayment($paymentId)
    {
        $decryptedId = Crypt::decrypt($paymentId);
        $payment = Payment::findOrFail($decryptedId);
        $debt = $payment->debt;
        $client = $debt->client;

        $startDate = Carbon::parse($debt->start_date);
        $endDate = Carbon::parse($debt->end_date);

        $months = [
            'January' => ['month' => 'ENERO', 'year' => null, 'amount' => null, 'note' => null],
            'February' => ['month' => 'FEBRERO', 'year' => null, 'amount' => null, 'note' => null],
            'March' => ['month' => 'MARZO', 'year' => null, 'amount' => null, 'note' => null],
            'April' => ['month' => 'ABRIL', 'year' => null, 'amount' => null, 'note' => null],
            'May' => ['month' => 'MAYO', 'year' => null, 'amount' => null, 'note' => null],
            'June' => ['month' => 'JUNIO', 'year' => null, 'amount' => null, 'note' => null],
            'July' => ['month' => 'JULIO', 'year' => null, 'amount' => null, 'note' => null],
            'August' => ['month' => 'AGOSTO', 'year' => null, 'amount' => null, 'note' => null],
            'September' => ['month' => 'SEPTIEMBRE', 'year' => null, 'amount' => null, 'note' => null],
            'October' => ['month' => 'OCTUBRE', 'year' => null, 'amount' => null, 'note' => null],
            'November' => ['month' => 'NOVIEMBRE', 'year' => null, 'amount' => null, 'note' => null],
            'December' => ['month' => 'DICIEMBRE', 'year' => null, 'amount' => null, 'note' => null],
            'newTake' => ['month' => 'NUEVA TOMA', 'year' => null, 'amount' => null, 'note' => null],
        ];

        $numberOfMonths = $startDate->diffInMonths($endDate) + 1;

        if ($numberOfMonths === 1) {
            $monthName = $startDate->format('F');
            $months[$monthName]['year'] = $startDate->year;
            $months[$monthName]['amount'] = $payment->amount;
            $months[$monthName]['note'] = $payment->note;
        }

        $numberToWords = new \NumberToWords\NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('es');
        $amountInWords = $numberTransformer->toWords($payment->amount);

        $note = $payment->note;
        $message = $numberOfMonths > 1
            ? "Monto total del pago $" . number_format($payment->amount, 2) . 
            ". Nota: " . $note
            : null;

        $pdf = PDF::loadView('reports.receiptPayment', compact('payment', 'months', 'message',  'amountInWords'))
            ->setPaper([0, 0, 300, 500], 'portrait');

        return $pdf->stream();
    }

}
