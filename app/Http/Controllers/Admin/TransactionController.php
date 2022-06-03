<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::with('user')->latest();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                        <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                
                            <a href="' . route('transaction.show', $item->id) . '" class="dropdown-item">Detail</a>
                            <a href="' . route('transaction.edit', $item->id) . '" class="dropdown-item">Edit</a>
                            <form action="' . route('transaction.destroy', $item->id) . '" method="POST">
                            ' . method_field('delete') . csrf_field() . '

                            <button class="text-danger dropdown-item" type="submit" >Hapus</button>
                            </form>
                           
                        </div>
                        </div>
                    </div>                
                ';
                })

                ->editColumn('created_at', function ($item) {

                    $date = $item->created_at;
                    $date_carbon = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMM Y | H:m');
                    return $date_carbon;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }

        return view('pages.admin.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.products.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction_details = TransactionDetail::with(['transaction.user', 'product.galleries'])->where('transactions_id', $id)->get();
        return view('pages.admin.transactions.detail', [
            'transaction_details' => $transaction_details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = TransactionDetail::with('transaction.user')->where('transactions_id', $id)->first();
        return view('pages.admin.transactions.edit', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);

        $item->update($data);

        toast('Status transaction berhasil diupdate', 'success');
        return redirect()->route('transaction.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::with('user')->findOrFail($id);
        $itemDetail = TransactionDetail::where('transactions_id', $id);

        toast('Transaksi ' . $item->user->name . ' berhasil dihapus', 'success');
        $item->delete();
        $itemDetail->delete();
        return redirect()->route('transaction.index');
    }
}
