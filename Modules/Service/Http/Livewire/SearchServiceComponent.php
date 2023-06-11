<?php

namespace Modules\Service\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Service\Entities\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchServiceComponent extends Component
{

    use WithPagination;

    public $search_by_service;
    public $coach;

    public function render()
    {

        $services = Service::where( function($query) {

            if(!empty($this->search_by_service)){
                    if(auth('admin')->check()){
                        $query->where('name_'.LaravelLocalization::getCurrentLocale(), 'like', '%'.$this->search_by_service.'%');
                    }
                    if(auth('coach')->check()){
                        $query->where('name_'.LaravelLocalization::getCurrentLocale(), 'like', '%'.$this->search_by_service.'%')
                        ->where('coach_id',auth('coach')->user()->id);
                }
            }



        })->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','description_'.LaravelLocalization::getCurrentLocale().' as description','category_id','price','discount_price','shipping_price','duration','type','coach_id')
        ->latest()->paginate(20);

        return view('service::livewire.search-service-component',compact('services'));
    }
}
