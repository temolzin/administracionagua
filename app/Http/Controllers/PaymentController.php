<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Debt;
use App\Models\Customer;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        $customers = Customer::all();
        $debts = Debt::all();
        return view('payments.index', compact('payments', 'customers', 'debts'));
    }

    public function getCustomerDebts(Request $request)
    {
        $customerId = $request->get('customer_id');
        $debts = Debt::where('customer_id', $customerId)->get();

        return response()->json(['debts' => $debts]);
    }


    public function store(Request $request)
    {
        $debt = Debt::findOrFail($request->debt_id);

        Payment::create([
            'debt_id' => $request->debt_id,
            'amount' => $request->amount,
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
    
        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }
    
}
