<?php
namespace Application\Models;

class CountrySearchModel
{
    public $countryName;
    public $countryCode;
    public $capitalCity;
    public $currencyCode;
    public $language;

    public function __construct(\Application\Framework\Request $_request)
    {
        $this->countryName = $_request->getPost('country_name');
        $this->countryCode = $_request->getPost('country_code');
        $this->capitalCity = $_request->getPost('capital_city');
        $this->currencyCode = $_request->getPost('currency_code');
        $this->language = $_request->getPost('language');
    }
}
