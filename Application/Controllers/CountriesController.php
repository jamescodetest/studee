<?php
namespace Application\Controllers;

use Application\Framework\Controller;
use Application\Models\CountrySearchModel;
use Application\Services\CountryService;
use Application\Validators\CountrySearchModelValidator;

class CountriesController extends Controller
{
    public function homeAction()
    {
        $request = $this->getServiceLocator()->getRequest();
        $db = $this->getServiceLocator()->getDB();

        $this->scope['countries'] = [];
        $this->scope['errors'] = [];

        if ($request->isPost()) {
            $countrySearchModel = new CountrySearchModel($request);

            $validator = new CountrySearchModelValidator($countrySearchModel);

            if ($validator->validate()) {
                $guzzleClient = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.eu/rest/v2/']);
                $countryService = new CountryService($db, $guzzleClient);
                $this->scope['countries'] = $countryService->findCountries($countrySearchModel);
            }

            $this->scope['errors'] = $validator->getErrors();

            $this->scope['countrySearchModel'] = $countrySearchModel;
        }

        $this->getServiceLocator()->getRenderer()->html($this, 'home');
    }
}
