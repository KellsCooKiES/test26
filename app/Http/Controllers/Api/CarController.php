<?php

namespace App\Http\Controllers\Api;



use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
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

        $cars = Car::orderBy('id');

        //filter by string name brand and model

        if ($request->has('brand')) {
            $id = Brand::where('name', $request->brand)->firstOrFail()->id;

            $cars->where('brand_id', $id);
        }

        if ($request->has('model')) {
            $id = CarModel::where('name', $request->model)->firstOrFail()->id;
            $cars->where('model_id', $id);
        }
        //applies EloquentFilters
        $cars->filter();


        $cars = $cars->get();

        if (is_null($cars)) {
            return $this->sendError('Cars not found.');
        }
        return $this->sendResponse($cars->toArray(), 'Cars retrieved successfully.');
    }



}
