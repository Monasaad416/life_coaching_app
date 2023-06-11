<?php

namespace Modules\Service\Http\Controllers;

use Alert;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Service\Entities\Service;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Modules\Service\Http\Requests\StoreServiceRequest;
use Modules\Service\Http\Requests\UpdateServiceRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        return view('service::index');//handeled by livewire
    }

    public function create()
    {
        $categories = Category::all();
        return view('service::create',compact('categories'));
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            //return dd($request->all());
            $slug = Str::slug($request->name_en);

            Service::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'shipping_price' => $request->shipping_price,
                'duration' => $request->duration,
                'type' => $request->type,
                'coach_id' => auth('coach')->user()->id,

            ]);

            Alert::success(trans('admin.service_created_successfully'));
            return redirect()->route('coach.service.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $service = Service::where('id',$id)
        ->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','description_'.LaravelLocalization::getCurrentLocale().' as description','category_id','price','discount_price','shipping_price','duration','type','coach_id')->first();
        return view('service::show',compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service::edit',compact('service'));
    }
    public function update(UpdateServiceRequest $request)
    {
        try{
            $service = Service::findOrFail($request->service_id);
            $slug = Str::slug($request->name_en);
            $service->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'shipping_price' => $request->shipping_price,
                'duration' => $request->duration,
                'type' => $request->type,
            ]);
            Alert::info(trans('admin.service_updated_successfully'));
            return redirect()->route('coach.service.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    public function deleteView($id)
    {
        $service = Service::where('id',$id)
        ->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name')
            ->first();
        return view('service::delete',compact('service'));
    }

    public function destroy(Request $request)
    {
        try{
            if(Auth::guard('coach')->check()){
                $service = Service::findOrFail($request->service_id);
                $service->delete();
                Alert::success(trans('admin.service_deleted_successfully'));
                return redirect()->route('coach.service.index');
            } if(Auth::guard('admin')->check()){
                $service = Service::findOrFail($request->service_id);
                $service->delete();
                Alert::success(trans('admin.service_deleted_successfully'));
                return redirect()->route('admin.service.index');
            }

        } catch (Exception $e) {
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }



//     public function searchByServiceOrProduct(Request $request)
//     {
//         $query = $request->get('query');
//         $services = Service::where('name_ar', 'like', '%'.$query.'%')->orWhere('name_en', 'like', '%'.$query.'%')->get();
//         if (!$services) {
//             // services not found, return an empty result set
//             $services = collect();
//         } else {
//             // services found
//             $services = $services;
//         }

//         $data = [];

//         foreach ($services as $service) {
//             $data[] = [
//                 'id' => $service->id,
//                 'name_en' => $service->name_en,
//                 'name_ar' => $service->name_ar,
//                 'type' => $service->type,
//                 'price'=> $service->price,
//                 'discount_price'=> $service->discount_price,
//                 'shipping_price'=> $service->shipping_price,
//                 'duration'=> $service->duration,
//                 'category' => $service->category ? $service->category->name : null,
//                 'coach' => $service->coach ? $service->coach->name : null,

//             ];
//         }

//         return response()->json([
//             'services' => $data,
//         ]);
//     }
}

