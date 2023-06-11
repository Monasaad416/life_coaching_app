<?php

namespace Modules\Category\Http\Livewire;
use App\Models\Coach;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\Entities\Category;
use Modules\Service\Entities\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchCategoryComponent extends Component
{

    use WithPagination;

    public $search_by_category;

    public function render()
    {
        $categories = Category::where( function($query) {
            if(!empty($this->search_by_category)){
                $query->where('name_'.LaravelLocalization::getCurrentLocale(), 'like', '%'.$this->search_by_category.'%');
            }
        })
        ->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id')
        ->latest()->paginate(20);

        return view('category::livewire.search-category-component',compact('categories'));
    }
}
