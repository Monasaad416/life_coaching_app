<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientProfileController extends Controller
{
    public function editProfile()
    {
        $client = Client::findOrFail(Auth::guard('client')->user()->id);
        return view('client.dashboard.edit_profile',compact('client'));
    }


    public function updateProfile(Request $request)
    {
        try{
            //return dd($request->all());
            $request->validate([
                'name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'email' => 'nullable|email|string|max:255',
                'password' => 'nullable|string|min:5|max:25|confirmed',
                'photo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            ]);

            $client = client::findOrFail($request->id);
            if(!empty($request->password)){
                $client->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                ]);

            } else {
                $client->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                ]);
            }


            if($request->hasFile('photo')) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = md5(mt_rand(11111111,99999999)).'.'.$photoExtension;
                $path = 'uploads/clients';
                $request->photo->move($path, $photoName);

                if($client->photo) {
                    unlink(public_path('uploads/clients/'. $client->photo));
                }

                $client->update([
                    'photo' => $photoName,
                ]);
            }


            Alert::info(trans('admin.profile_updated'));

            return redirect()->route('client.edit_profile');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}
