<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');

        $authUser = Auth::user();
        $totalCustomers = Customer::count();

        $customersWithDebts = Customer::whereHas('debts', function ($query) {
            $query->where('status', '!=', 'paid');
        })->count();

        $customersWithoutDebts = Customer::where('state', '!=', 0)
        ->whereDoesntHave('debts', function ($query) {
            $query->where('status', '!=', 'paid')
                  ->where('status', '!=', 'united');
        })
        ->count();
    
        $debtOverThreeYearsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
            ->join('debts', 'customers.id', '=', 'debts.customer_id')
            ->whereNotIn('debts.status', ['paid', 'united'])
            ->selectRaw(
                'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
            )
            ->groupBy('customers.id', 'customers.name', 'customers.last_name')
            ->havingRaw('total_months > ?', [36])
            ->paginate(10);

            $debtBetweenTwelveAndThirtySixMonthsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
            ->join('debts', 'customers.id', '=', 'debts.customer_id')
            ->whereNotIn('debts.status', ['paid', 'united'])
            ->selectRaw(
                'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
            )
            ->groupBy('customers.id', 'customers.name', 'customers.last_name')
            ->havingRaw('total_months BETWEEN ? AND ?', [12, 36])
            ->get();
        
            $debtBetweenOneAndElevenMonthsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
                ->join('debts', 'customers.id', '=', 'debts.customer_id')
                ->whereNotIn('debts.status', ['paid', 'united'])
                ->selectRaw(
                    'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
                )
                ->groupBy('customers.id', 'customers.name', 'customers.last_name')
                ->havingRaw('total_months BETWEEN ? AND ?', [1, 11])
                ->get();
            
        $debtOverThreeYears = $debtOverThreeYearsAll->take(5);
        $debtBetweenTwelveAndThirtySixMonths = $debtBetweenTwelveAndThirtySixMonthsAll->take(5);
        $debtBetweenOneAndElevenMonths = $debtBetweenOneAndElevenMonthsAll->take(5);

        $currentMonth = Carbon::now();
        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();
        
        $debtsThisMonth = Debt::where('start_date', '<=', $endOfMonth)
            ->where('end_date', '>=', $startOfMonth)
            ->count();
        
        $noDebtsForCurrentMonth = ($debtsThisMonth === 0);
        

        $monthlyEarnings = Payment::selectRaw('SUM(amount) as total, MONTH(payment_date) as month')
            ->whereYear('payment_date', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $earningsPerMonth = array_fill(1, 12, 0);

        foreach ($monthlyEarnings as $earning) {
            $earningsPerMonth[$earning->month] = $earning->total;
        }

        $months = collect(range(1, 12))->map(function ($month) {
            return ucfirst(Carbon::create()->month($month)->locale('es')->monthName);
        });

        $data = [
            'totalCustomers' => $totalCustomers,
            'customersWithDebts' => $customersWithDebts,
            'customersWithoutDebts' => $customersWithoutDebts,
            'noDebtsForCurrentMonth' => $noDebtsForCurrentMonth,
            'debtOverThreeYears' => $debtOverThreeYears,
            'debtBetweenTwelveAndThirtySixMonths' => $debtBetweenTwelveAndThirtySixMonths,
            'debtBetweenOneAndElevenMonths' => $debtBetweenOneAndElevenMonths,
            'months' => $months,
            'earningsPerMonth' => array_values($earningsPerMonth),
        ];

        return view('dashboard', compact('data', 'authUser'));
    }
    public function getDebtCustomersOverThreeYears(Request $request)
    {
        $debtOverThreeYearsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
            ->join('debts', 'customers.id', '=', 'debts.customer_id')
            ->whereNotIn('debts.status', ['paid', 'united'])
            ->selectRaw(
                'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
            )
            ->groupBy('customers.id', 'customers.name', 'customers.last_name')
            ->havingRaw('total_months > ?', [36])
            ->get();
        
        return response()->json(['data' => $debtOverThreeYearsAll]);
    }
    
    public function getDebtCustomersBetweenTwelveAndThirtySixMonths(Request $request)
    {
        $debtBetweenTwelveAndThirtySixMonthsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
            ->join('debts', 'customers.id', '=', 'debts.customer_id')
            ->whereNotIn('debts.status', ['paid', 'united'])
            ->selectRaw(
                'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
            )
            ->groupBy('customers.id', 'customers.name', 'customers.last_name')
            ->havingRaw('total_months BETWEEN ? AND ?', [12, 36])
            ->get();
    
        return response()->json(['data' => $debtBetweenTwelveAndThirtySixMonthsAll]);
    }
    
    public function getDebtCustomersBetweenOneAndElevenMonths(Request $request)
    {
        $debtBetweenOneAndElevenMonthsAll = Customer::select('customers.id', 'customers.name', 'customers.last_name')
        ->join('debts', 'customers.id', '=', 'debts.customer_id')
        ->whereNotIn('debts.status', ['paid', 'united'])
        ->selectRaw(
            'SUM(TIMESTAMPDIFF(MONTH, debts.start_date, debts.end_date) + IF(DAY(debts.end_date) >= DAY(debts.start_date), 1, 0)) as total_months'
        )
        ->groupBy('customers.id', 'customers.name', 'customers.last_name')
        ->havingRaw('total_months BETWEEN ? AND ?', [1, 11])
        ->get();
    
        return response()->json(['data' => $debtBetweenOneAndElevenMonthsAll]);
    }
    
}
