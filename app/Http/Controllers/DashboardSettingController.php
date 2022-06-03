<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-store-setting', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $user = Auth::user();
        return view('pages.dashboard-account-setting', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        if ($request->profile_picture) {
            $data['profile_picture'] = $request->file('profile_picture')->store('assets/user', 'public');
          
        } else {
            unset($data['profile_picture']);
         
        }

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }



        $item = Auth::user();

        $item->update($data);

        toast('Data akun berhasil diupdate!', 'success');

        return redirect()->route($redirect);
    }
}
