<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index($slug)
    {
        $details = Product::with(['galleries', 'user', 'category'])->where('slug', $slug)->firstOrFail();
        return view('pages.detail', [
            'details' => $details
        ]);
    }

    public function create($id)
    {
        $data = [
            'users_id' => Auth::user()->id,
            'products_id' => $id
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
