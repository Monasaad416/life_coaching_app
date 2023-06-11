<?php

namespace Modules\Review\Http\Livewire;
use App\Models\Coach;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Review\Entities\Review;
use Modules\Service\Entities\Service;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchReviewComponent extends Component
{

    use WithPagination;

    public $search_by_service;
    public $search_by_coach;
    public $search_by_rating;

    public function render()
    {


        $reviews = Review::where( function($query) {
            $services_ids = Service::where('name_'.LaravelLocalization::getCurrentLocale(), 'like', '%'.$this->search_by_service.'%')->pluck('id')->toArray();
            $coaches_ids = Coach::where('name', 'like', '%'.$this->search_by_coach.'%')->pluck('id')->toArray();
            if(!empty($this->search_by_service)){
                    if(auth('admin')->check()){
                        $query->whereIn('service_id',$services_ids);
                    }
                    if(auth('coach')->check()){
                        $query->whereIn('service_id',$services_ids)
                        ->where('coach_id',auth('coach')->user()->id);
                    }
            }

            if(!empty($this->search_by_coach)){
                if(auth('admin')->check()){
                    $query->whereIn('coach_id',$coaches_ids);
                }
            }

            
            if(!empty($this->search_by_rating)){
                if(auth('admin')->check()){
                    $query->where('rating',$this->search_by_rating);
                }
                if(auth('coach')->check()){
                    $query->where('rating',$this->search_by_rating)
                    ->where('coach_id',auth('coach')->user()->id);
                }
            }

        })->latest()->paginate(20);

        return view('review::livewire.search-review-component',compact('reviews'));
    }
}
