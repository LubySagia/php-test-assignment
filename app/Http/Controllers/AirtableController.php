<?php

namespace App\Http\Controllers;

use App\Services\ModelService;
use App\Site;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Tapp\Airtable\Api\AirtableApiClient;

class AirtableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchModels($siteId)
    {
        $site = Site::findOrFail($siteId);
        $modelService = new ModelService($site);

        $models = $modelService->fetchAllModels();
        return view('airtable.models', [
            'siteName' => $site->name,
            'models' => $models
        ]);
    }
}
