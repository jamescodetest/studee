<?php
namespace Application\Services;

class CountryService
{
    private $_dbConn;

    public function __construct(\Application\Framework\DB $_dbConn)
    {
        $this->dbConn = $_dbConn;
    }

    public function findCountries(\Application\Models\CountrySearchModel $_countrySearchModel): array
    {
        return [];
    }
}
