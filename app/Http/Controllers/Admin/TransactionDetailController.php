<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Toaster;

class TransactionDetailController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        toast('Status pengiriman berhasil diupdate', 'success');

        return redirect()->route('transaction.index');
    }
}
