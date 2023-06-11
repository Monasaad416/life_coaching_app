<?php

namespace Modules\Category\Http\Controllers;

use Alert;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->has('name')) {
            // Search by coach name
            return $this->searchByCategory($request->input('name'));
        } else {
            // Show all categories
            $categories = Category::
            select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id')
            ->latest()->paginate(20);
            return view('category::index',compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try{
            $slug = Str::slug($request->name_en);

            Category::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'parent_id' => $request->parent_id,
                'slug' => $slug,

            ]);


            Alert::success(trans('admin.category_created_successfully'));

            return redirect()->route('admin.category.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category::edit',compact('category'));
    }

    public function update(Request $request)
    {
        //eturn dd($request->all());
        $category = Category::findOrFail($request->id);
        $categories = Category::
            select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id')
            ->latest()->paginate(20);
        $category->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'parent_id' => $request->parent_id,
            ]);

        Alert::info(trans('admin.category_updated_successfully'));

        return redirect()->route('admin.category.index');
    }

    public function deleteView($id)
    {
        $category = Category::where('id',$id)
        ->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id')
            ->first();
        return view('category::delete',compact('category'));
    }
    public function destroy(Request $request)
    {
        try{
            Category::findOrFail($request->id)->delete();
            Alert::success(trans('admin.category_deleted_successfully'));
            return redirect()->route('admin.category.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function searchByCategory(Request $request)
    {
        $query = $request->get('query');
        $categories = Category::where('name_ar', 'like', '%'.$query.'%')->orWhere('name_en', 'like', '%'.$query.'%')->get();
        if (!$categories) {
            // category not found, return an empty result set
            $categories = collect();
        } else {
            // category found, get the categories for the category
            $categories = $categories;
        }

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'name_en' => $category->name_en,
                'name_ar' => $category->name_ar,
                'parent' => $category->parent ? $category->parent->name : null,
            ];
        }

        return response()->json([
            'categories' => $data,
        ]);
    }
}
