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
        $results = $this->searchCountryDatabase($_countrySearchModel);

        if (count($results) == 0) {
            // Search using API
        }

        return $results;
    }

    public function searchCountryDatabase(\Application\Models\CountrySearchModel $_countrySearchModel): array
    {
        $results = [];

        $sql = 'SELECT *
                FROM countries';

        $where = [];
        $params = [];

        if ($_countrySearchModel->countryName != '') {
            $where[] = 'country_name LIKE :country_name';
            $params['country_name'] = '%' . $_countrySearchModel->countryName . '%';
        }

        if ($_countrySearchModel->countryCode != '') {
            $where[] = 'country_code LIKE :country_code';
            $params['country_code'] = '%' . $_countrySearchModel->countryCode . '%';
        }

        if ($_countrySearchModel->capitalCity != '') {
            $where[] = 'capital_city LIKE :capital_city';
            $params['capital_city'] = '%' . $_countrySearchModel->capitalCity . '%';
        }

        if ($_countrySearchModel->currency_code != '') {
            $where[] = 'currency_code LIKE :currency_code';
            $params['currency_code'] = '%' . $_countrySearchModel->currency_code . '%';
        }

        if ($_countrySearchModel->language != '') {
            $where[] = 'language LIKE :language';
            $params['language'] = '%' . $_countrySearchModel->language . '%';
        }

        if (count($where) > 0) {
            $sql .= sprintf(' WHERE %s', implode(' AND ', $where));
            $results = $this->dbConn->getAll($sql, $params);
        }

        return $results;
    }
}
