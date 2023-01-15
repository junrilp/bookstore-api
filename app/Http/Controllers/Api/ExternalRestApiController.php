<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExternalRestApiServices;

class ExternalRestApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 30;
        return (new ExternalRestApiServices())->getServices($limit);
    }

    public function getServiceById($id)
    {
        return (new ExternalRestApiServices())->getSpecificService($id);
    }

    public function store(Request $request)
    {
        return (new ExternalRestApiServices())->addService($request->all());
    }

    public function update(Request $request, $id)
    {
        return (new ExternalRestApiServices())->updateService($request->all(), $id);
    }

    public function destroy($id)
    {
        return (new ExternalRestApiServices())->deleteService($id);
    }
}
