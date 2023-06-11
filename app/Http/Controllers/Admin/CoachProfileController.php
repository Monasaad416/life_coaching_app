<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Exception;
use App\Models\Coach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CoachProfileController extends Controller
{
    public function editProfile()
    {
        $coach = Coach::findOrFail(Auth::guard('coach')->user()->id);
        return view('coach.dashboard.edit_profile',compact('coach'));
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
                'logo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
            ]);

            $coach = Coach::findOrFail($request->id);
            if(!empty($request->password)){
                $coach->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                ]);

            } else {
                $coach->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }


            if($request->hasFile('photo')) {
                $photoExtension = $request->photo->getClientOriginalExtension();
                $photoName = md5(mt_rand(11111111,99999999)).'.'.$photoExtension;
                $path = 'uploads/coaches_photo';
                $request->photo->move($path, $photoName);

                if($coach->photo) {
                    unlink(public_path('uploads/coaches_photo/'. $coach->photo));
                }

                $coach->update([
                    'photo' => $photoName,
                ]);
            }

            if($request->hasFile('logo')) {
                $logoExtension = $request->logo->getClientOriginalExtension();
                $logoName = md5(mt_rand(11111111,99999999)) . '.' .$logoExtension;
                $path = 'uploads/coaches_logo';
                $request->logo->move($path, $logoName);


                  if($coach->logo) {
                    unlink(public_path('uploads/coaches_logo/'. $coach->logo));
                }

                $coach->update([
                    'logo' => $logoName,
                ]);
            }

            Alert::info(trans('admin.profile_updated'));

            return redirect()->route('coach.edit_profile');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function certificates()
    {
        $certificates = Attachment::where('coach_id' , auth('coach')->user()->id)->get();
        return view('coach.dashboard.edit_certificates',compact('certificates'));
    }

    public function addCertificate(Request $request)
    {
        try {


            foreach($request->certificates as $certificate) {
                $certificateExtension = $certificate->getClientOriginalExtension();
                $certificateName = md5(mt_rand(11111111,99999999)) . '.' .$certificateExtension;
                $path = 'uploads/coaches_certificate';
                $certificate->move($path, $certificateName);
                Attachment::create([
                    'coach_id' => auth('coach')->user()->id,
                    'image' => $certificateName
                ]);
            }


            Alert::info(trans('admin.certificates_uploaded'));

            return redirect()->route('coach.edit_certificates');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function deleteCertificate(Request $request)
    {
        try{

            $image = Attachment::findOrFail($request->certificate_id);
            $image->delete();
            unlink(public_path('uploads/coaches_certificate/'. $image->image));

            Alert::error(trans('admin.oops'), trans('admin.certificate_deleted'));
            return redirect()->route('coach.edit_certificates');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
