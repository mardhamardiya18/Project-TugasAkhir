<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Custom;
use App\Models\CustomDetail;

class DashboardTransactionController extends Controller
{
    public function index()
    {

        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->latest()->get();

        $customs = CustomDetail::with('custom.user')
            ->whereHas('custom', function ($item) {
                $item->where('users_id', Auth::user()->id);
            })
            ->latest()->get();

        return view('pages.dashboard-transaction', [
            'buyTransactions' => $buyTransactions,
            'customs' => $customs
        ]);
    }
    public function show(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);

        return view('pages.dashboard-transaction-detail', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        toast('Status Berhasil Terupdate!', 'success');

        return redirect()->route('transaction-detail', $id);
    }
}
