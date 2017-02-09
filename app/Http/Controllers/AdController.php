<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use App\Services\AdService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    private $ad_service;

    private $result = array(
        'error' => false,
        'error_code' => 0,
        'error_desc' => '',
        'response' => null
    );


    public function __construct(AdService $ad_service)
    {
        $this->ad_service = $ad_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = $this->ad_service->getAds(5);
        return view('pages.ads_list', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('pages.create_update_ad');
        } else {
            return abort(403);
        }
    }

    /**
     * @param AdRequest $request
     */
    public function store(AdRequest $request)
    {
        $ad_id = $this->ad_service->createAd($request->all());
        $query_result = is_int($ad_id) && $ad_id > 0 ? true : false;
        $this->result['response']['redirect'] = route('show_ad', ['id' => $ad_id]);
        return $this->jsonResponse($query_result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = $this->ad_service->getAd($id);
        return view('pages.show_ad', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = $this->ad_service->getAd($id);
        if ($this->authorize('adPolicy', $ad)) {
            return view('pages.create_update_ad', compact('ad'));
        } else {
            return abort(403);
        }
    }

    /**
     * @param AdRequest $request
     * @param $id
     */
    public function update(AdRequest $request, $id)
    {
        $parameters = $request->all();
        $parameters['id'] = $id;
        $query_result = $this->ad_service->updateAd($parameters);
        $this->result['response']['redirect'] = route('show_ad', ['id' => $id]);
        return $this->jsonResponse($query_result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query_result = $this->ad_service->removeAd($id);
        $this->result['response']['redirect'] = route('home');
        return $this->jsonResponse($query_result);
    }

    /**
     * @param $success
     */
    private function jsonResponse($success)
    {
        if ($success) {
            return response()->json($this->result);
        } else {
            return abort(500);
        }
    }
}
