<?php

namespace App\Http\Controllers\Api;



use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class CarController extends BaseController
{
    /**
     * Show all Participants.
     * or filtered thru Event
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {

            $cars = Car::all();


        if (is_null($cars)) {
            return $this->sendError('Participants not found.');
        }
        return $this->sendResponse($cars->toArray(), 'Participants retrieved successfully.');
    }



}
