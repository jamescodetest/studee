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

        if ($request->isPost()) {
            $countrySearchModel = new CountrySearchModel($request);

            // Validation

            // Retrieve countries
            $countryService = new CountryService($db);
            $this->scope['countries'] = $countryService->findCountries($countrySearchModel);

            $this->scope['countrySearchModel'] = $countrySearchModel;
        }

        $this->getServiceLocator()->getRenderer()->html($this, 'home');
    }
}
