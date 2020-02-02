<?php
namespace Application\Controllers;

use Application\Framework\Controller;
use Application\Models\CountrySearchModel;
use Application\Services\CountryService;

class CountriesController extends Controller
{
    public function homeAction()
    {
        $request = $this->getServiceLocator()->getRequest();
        $db = $this->getServiceLocator()->getDB();

        $this->scope['countries'] = [];

        if ($request->isPost()) {
            $countrySearchModel = new CountrySearchModel($request);

            // Validation

            // Retrieve countries
            $guzzleClient = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.eu/rest/v2/']);
            $countryService = new CountryService($db, $guzzleClient);
            $this->scope['countries'] = $countryService->findCountries($countrySearchModel);

            $this->scope['countrySearchModel'] = $countrySearchModel;
        }

        $this->getServiceLocator()->getRenderer()->html($this, 'home');
    }
}
