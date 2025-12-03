<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FeeResource;
use App\Http\Resources\SelectResource;
use App\Models\Fee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class FeeController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the fees.
     */
    public function index(): AnonymousResourceCollection
    {
        $fees = Fee::filter()->simplePaginate();

        return FeeResource::collection($fees);
    }

    /**
     * Display the specified fee.
     */
    public function show(Fee $fee): FeeResource
    {
        return new FeeResource($fee);
    }

    /**
     * Display a listing of the fees.
     */
    public function select(): AnonymousResourceCollection
    {
        $fees = Fee::filter()->simplePaginate();

        return SelectResource::collection($fees);
    }
}
