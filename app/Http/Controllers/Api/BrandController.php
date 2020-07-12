<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BrandController extends BaseController
{
    /**
     * Show all Brand.
     * or filtered thru Event
     *
     * @return JsonResponse
     */
    public function index()
    {
        //if there is a request with event id, return event participants




            //else return all participants

            $brands = Brand::all();


        if (is_null($brands)) {
            return $this->sendError('Brands not found.');
        }
        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully.');
    }
}
