<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries']);


        $customer = User::where('roles', 'USER')->count();
        $revenue = Transaction::where('transaction_status', 'Terbayar')->sum('total_price');
        $transaction_pending = Transaction::where('transaction_status', 'Menunggu Pembayaran')->count();
        $transaction_success = Transaction::where('transaction_status', 'Terbayar')->count();
        return view('pages.admin.index', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction_pending' => $transaction_pending,
            'transaction_success' => $transaction_success,
            'transaction_data' => $transactions->latest()->limit(5)->get(),
        ]);
    }
}
