<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $paymentMethods = PaymentMethod::all();
        if ($paymentMethods) {
            return ResponseFormater::success($paymentMethods, 'Sukses menampilkan data Payments Method');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Payments Method');
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
        $request->validate([
            'payment_method_name' => 'required|unique:payment_methods,payment_method_name',
            'payment_method_rek' => 'required|numeric',
        ]);

        $paymentMethod = $request->except(['_token']);
        $createDB = PaymentMethod::create($paymentMethod);

        if ($createDB) {
            return ResponseFormater::success($paymentMethod, 'Sukses menambahkan data Payments Method');
        }
        return ResponseFormater::error(false, 'Gagal menambahkan data Payments Method');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        $show = PaymentMethod::where('payment_method_id', $paymentMethod->payment_method_id)->get();
        if ($show) {
            return ResponseFormater::success($show, 'Sukses menampilkan data Payment Method');
        }
        return ResponseFormater::error(false, 'Gagal menampilkan data Payment Method');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'payment_method_name' => ['required', Rule::unique('payment_methods')->ignore($paymentMethod->payment_method_id, 'payment_method_id')],
            'payment_method_rek' => 'required|numeric',
        ]);

        $update = $request->except(['_token']);

        $paymentDb = PaymentMethod::where('payment_method_id', $paymentMethod->payment_method_id);
        $updateDB = $paymentDb->update($update);

        if ($updateDB) {
            return ResponseFormater::success($paymentDb->get(), 'Sukses memperbarui data Payments Method');
        }
        return ResponseFormater::error(false, 'Gagal memperbarui data Payments Method');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $deleteDB = PaymentMethod::where('payment_method_id', $paymentMethod->payment_method_id)->delete();

        if ($deleteDB) {
            return ResponseFormater::success(false, 'Sukses menghapus data Payments Method');
        }
        return ResponseFormater::error(false, 'Gagal menghapus data Payments Method');
    }
}
