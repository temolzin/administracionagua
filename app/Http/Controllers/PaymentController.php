<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Debt;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(10);
        $customers = Customer::all();
        $debts = Debt::all();
        return view('payments.index', compact('payments', 'customers', 'debts'));
    }

    public function getCustomerDebts(Request $request)
    {
        $customerId = $request->input('customer_id');
        $debts = Debt::where('customer_id', $customerId)
            ->where('status', '!=', 'paid')
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
}
