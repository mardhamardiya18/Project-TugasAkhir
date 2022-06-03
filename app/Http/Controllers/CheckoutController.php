<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {

        $user = Auth::user();
        $user->update($request->except('total_price'));

        // proses checkout
        $code = 'INV -' . mt_rand('000', '999');
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();



        // transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'Menunggu Pembayaran',
            'code' => $code,
        ]);

        // buat transaction detail
        foreach ($carts as $cart) {
            $inv = 'INVPRDCT -' . mt_rand('000', '999');
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $inv
            ]);
        }

        // Menghapus data checkout
        Cart::where('users_id', Auth::user()->id)->delete();

        // konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            "transaction_details" => [
                "order_id" => $code,
                "gross_amount" => (int) $request->total_price
            ],
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "enable_payments" => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL

            $paymentUrl =  Snap::createTransaction($midtrans)->redirect_url;


            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        // Instance midtrans notification
        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_status;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($status == 'challage') {
                    $transaction->transaction_status = 'Menunggu Pembayaran';
                } else {
                    $transaction->transaction_status = 'Terbayar';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->transaction_status == 'Terbayar';
        } else if ($status == 'pending') {
            $transaction->transaction_status == 'Menunggu Pembayaran';
        } else if ($status == 'deny') {
            $transaction->transaction_status == 'CANCELED';
        } else if ($status == 'expire') {
            $transaction->transaction_status == 'CANCELED';
        } else if ($status == 'cancel') {
            $transaction->transaction_status == 'CANCELED';
        }

        // simpan transaksi
        $transaction->save();
    }
}
