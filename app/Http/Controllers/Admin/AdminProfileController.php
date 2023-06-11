<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;

class AdminProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('admin.dashboard.edit_profile',compact('admin'));
    }


    public function updateProfile(Request $request)
    {
        try{
            //return dd($request->all());
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|string|max:255',
                'password' => 'nullable|string|min:5|max:25|confirmed',
                'photo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            ]);

            $admin = admin::findOrFail($request->id);
            if(!empty($request->password)){
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                ]);

            } else {
                $admin->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }

            if($request->hasFile('photo')) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = md5(mt_rand(11111111,99999999)).'.'.$photoExtension;
                $path = 'uploads/admins';
                $request->photo->move($path, $photoName);

                if($admin->photo) {
                    unlink(public_path('uploads/admins/'. $admin->photo));
                }

                $admin->update([
                    'photo' => $photoName,
                ]);
            }


            Alert::info(trans('admin.profile_updated'));

            return redirect()->route('admin.edit_profile');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}
