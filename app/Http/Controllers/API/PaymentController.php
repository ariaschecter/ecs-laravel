<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
        if ($payments) {
            return ResponseFormater::success($payments, 'Sukses menampilkan data Payments');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Payments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = $request->validate([
            'payment_price' => 'required',
            'user_id' => 'required',
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
            'payment_status' => $request->payment_status ?: 'PENDING',
        ];

        $createDB = Payment::create($payment);
        if ($createDB) {
            return ResponseFormater::success($payment, 'Sukses menambahkan data Payment');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $update = $request->only(['payment_status']);

        $payment = Payment::where('payment_id', $payment->payment_id);
        $updateDB = $payment->update($update);
        if ($updateDB) {
            return ResponseFormater::success($payment->get(), 'Sukses memperbarui data Payments');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $deleteDB = Payment::where('payment_id', $payment->payment_id)->delete();
        $deleteStg = Storage::delete($payment->payment_picture);
        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menghapus data Payments');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data Payments');
    }
}
