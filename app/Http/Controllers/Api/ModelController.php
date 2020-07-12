<?php

namespace App\Http\Controllers\Api;


use App\Models\CarModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class ModelController extends BaseController
{
    /**
     * Show all CarModels.
     * or filtered thru Event
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        //if there is a request with event id, return event participants


            //else return all participants

            $models = CarModel::all();

        if (is_null($models)) {
            return $this->sendError('CarModels not found.');
        }
        return $this->sendResponse($models->toArray(), 'CarModels retrieved successfully.');
    }

}
