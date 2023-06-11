<?php

namespace Modules\Review\Http\Controllers;

use Exception;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Review\Entities\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Alert;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('review::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('review::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('review::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('review::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function deleteView($id)
    {
        $review = Review::where('id',$id)->first();
        return view('review::delete',compact('review'));
    }

    public function destroy(Request $request)
    {
        try{  
            if(Auth::guard('admin')->check()){
                $review = Review::findOrFail($request->id);
                $review->delete();
                Alert::success(trans('admin.review_deleted_successfully'));
                return redirect()->route('admin.review.index');
            }
        
        } catch (Exception $e) {
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
