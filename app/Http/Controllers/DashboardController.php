<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($query) {
                $query->where('users_id', Auth::user()->id);
            });

        $getTransactionWithSuccess = Transaction::where([
            ['users_id', Auth::user()->id],
            ['transaction_status', 'Terbayar']
        ]);

        $expenses = $getTransactionWithSuccess->get()->reduce(function ($carry, $item) {
            return $carry + $item->total_price;
        });

        $customer = User::count();

        return view('pages.dashboard-home', [
            'transaction_count' => $getTransactionWithSuccess->count(),
            'transaction_data' => $transactions->latest()->limit(5)->get(),
            'expenses' => $expenses,
            'customer' => $customer,
        ]);
    }
}
