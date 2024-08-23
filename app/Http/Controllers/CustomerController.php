<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Cost;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $costs = Cost::all();
        return view('customers.index', compact('customers', 'costs'));
    }

    public function store(Request $request)
    {
        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Usuario registrado correctamente.');
    }

    public function update(Request $request, $id)
    {

        $customer = Customer::find($id);
        if ($customer) {
            $customer->name = $request->input('nameUpdate');
            $customer->last_name = $request->input('lastNameUpdate');
            $customer->block = $request->input('blockUpdate');
            $customer->street = $request->input('streetUpdate');
            $customer->interior_number = $request->input('interiorNumberUpdate');
            $customer->marital_status = $request->input('maritalStatusUpdate');
            $customer->partner_name = $request->input('partnerNameUpdate');
            $customer->has_water_connection = $request->input('hasWaterConnectionUpdate');
            $customer->has_store = $request->input('hasStoreUpdate');
            $customer->has_all_payments = $request->input('hasAllPaymentsUpdate');
            $customer->has_water_day_night = $request->input('hasWaterDayNightUpdate');
            $customer->occupants_number = $request->input('occupantsNumberUpdate');
            $customer->water_days = $request->input('waterDaysUpdate');
            $customer->has_water_pressure = $request->input('hasWaterPressureUpdate');
            $customer->has_cistern = $request->input('hasCisternUpdate');
            $customer->cost_id = $request->input('costIdUpdate');

            $customer->save();


            return redirect()->route('customers.index')->with('success', 'Usuario actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }


    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function pdfCustomers()
    {
        $customers = Customer::all();
        $pdf = PDF::loadView('customers.pdfCustomers', compact('customers'))
            ->setPaper('legal', 'landscape');

        return $pdf->stream('customers.pdf');
    }
}
