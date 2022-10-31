<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('payment.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = PaymentMethod::all();
        $users = User::all();

        return view('payment.add')->with([
            'payment_methods' => $payment_methods,
            'users' => $users,
        ]);
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
            'payment_price' => 'required',
            'payment_picture' => 'required|file|image|max:5120',
            'payment_method_id' => 'required',
        ]);

        $payment_picture = $request->file('payment_picture')->store('img/payment');

        $payment = [
            'payment_method_id' => $request->payment_method_id,
            'user_id' => $request->user_id,
            'payment_ref' => Str::upper(Str::random(14)),
            'payment_picture' => $payment_picture,
            'payment_price' => $request->payment_price,
            'payment_status' => $request->payment_status,
        ];

        Payment::create($payment);
        return redirect('payment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $payment_methods = PaymentMethod::all();
        return view('payment.edit')->with([
            'payment' => $payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $update = $request->only(['payment_status']);
        // dd($payment);

        Payment::where('payment_id', $payment->payment_id)->update($update);
        return redirect('payment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        Payment::where('payment_id', $payment->payment_id)->delete();
        Storage::delete($payment->payment_picture);
        return redirect('payment');
    }
}
