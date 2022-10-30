<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        return view('payment_methods.index')->with('payment_methods', $payment_methods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_name' => 'required|unique:payment_methods,payment_method_name',
            'payment_method_rek' => 'required|numeric',
        ]);

        $payment_method = $request->except(['_token']);
        PaymentMethod::create($payment_method);
        return redirect('payment_method');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $payment_method)
    {
        return view('payment_methods.edit')->with('payment_method', $payment_method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $payment_method)
    {
        $request->validate([
            'payment_method_name' => ['required',Rule::unique('payment_methods')->ignore($payment_method->payment_method_id, 'payment_method_id')],
            'payment_method_rek' => 'required|numeric',
        ]);

        $update = $request->except(['_token']);

        PaymentMethod::where('payment_method_id', $payment_method->payment_method_id)->update($update);
        return redirect('payment_method');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        PaymentMethod::where('payment_method_id', $payment_method->payment_method_id)->delete();
        return redirect('payment_method');
    }
}
