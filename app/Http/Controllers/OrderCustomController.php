<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\CustomDetail;
use App\Models\CustomDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderCustomController extends Controller
{
    public function index()
    {
        return view('pages.order-custom');
    }
    public function store(Request $request)
    {
        $code = 'INV -' . mt_rand('000', '999');


        $custom =  Custom::create([
            'users_id' => Auth::user()->id,
            'phone_number' => $request->phone_number,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'needs' => $request->needs,
            'categories' => $request->categories,
            'photos' => $request->file('photos')->store('assets/custom', 'public'),
            'caption' => $request->caption,
            'code' => $code

        ]);

        // create custom detail
        CustomDetail::create([
            'custom_id' => $custom->id,
            'estimasi_pengerjaan' => 'CHECKING',
            'estimasi_biaya' => 'CHECKING',
            'status_pengerjaan' => 'PENDING',
            'payment_status' => 'Menunggu Pembayaran'
        ]);

        Alert::success('Oke👍', 'Pesan berhasil dibuat, silahkan check pada dashboard pesanan anda, Terimakasih😇');
        return redirect()->route('order-custom');
    }

    public function show($id)
    {
        $custom = CustomDetail::with('custom.user')->findOrFail($id);
        $now = Carbon::parse($custom->created_at)->addDay(1);
        $expired =  $now->diffForHumans();

        return view('pages.dashboard-custom-detail', [
            'custom' => $custom,
            'expired' => $expired
        ]);
    }
    public function confirm($id)
    {
        $custom = CustomDetail::with('custom.user')->findOrFail($id);

        return view('pages.dashboard-custom-confirm', [
            'custom' => $custom
        ]);
    }
    public function confirmUpload(Request $request, $id)
    {
        $data = $request->all();
        $item = CustomDetail::findOrFail($id);

        $data['photos_confirm'] = $request->file('photos_confirm')->store('assets/payment_confirm', 'public');

        $item->update($data);

        toast('Success! konfirmasi Pembayaran Berhasil Dikirim ', 'success');
        return redirect()->route('order-custom-detail', $id);
    }
}
