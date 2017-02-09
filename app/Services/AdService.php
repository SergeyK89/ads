<?php

namespace App\Services;

use App\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdService
{

    use AuthorizesRequests;

    private $ad;

    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    public function getAds($paginate)
    {
        return $this->ad->orderBy('id', 'desc')->paginate($paginate);
    }

    public function getAd($id)
    {
        return $this->ad->find($id);
    }

    public function createAd($parameters)
    {
        $parameters['user_id'] = Auth::user()->id;
        $parameters['author_name'] = Auth::user()->username;
        $result = $this->ad->create($parameters);
        return $result->id ? $result->id : false;
    }

    public function updateAd($parameters)
    {
        $current_ad = $this->ad->find($parameters['id']);
        if ($this->authorize('adPolicy', $current_ad)) {
            $current_ad->user_id = Auth::user()->id;
            $current_ad->author_name = Auth::user()->username;
            $current_ad->title = $parameters['title'];
            $current_ad->description = $parameters['description'];
            return $current_ad->save();
        } else {
            return false;
        }
    }

    public function removeAd($id)
    {
        $current_ad = $this->ad->find($id);
        if ($this->authorize('adPolicy', $current_ad)) {
            return $current_ad->delete();
        } else {
            return false;
        }
    }
}