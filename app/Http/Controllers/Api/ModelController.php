<?php

namespace App\Http\Controllers\Api;


use App\Filters\ModelFilters;
use App\Models\Brand;
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
        $models = CarModel::latest();


        if ($request->has('brand')) {
            $id = Brand::where('name', $request->brand)->firstOrFail()->id;

            $models->where('brand_id', $id);
        }

        $models = $models->get();

        if (is_null($models)) {
            return $this->sendError('CarModels not found.');
        }
        return $this->sendResponse($models->toArray(), 'CarModels retrieved successfully.');
    }


}
