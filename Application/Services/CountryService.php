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
        $sql = 'SELECT c.*, currencies.currency_codes, timezones.timezones
                FROM countries AS c
                LEFT JOIN (
                    SELECT country_id, GROUP_CONCAT(DISTINCT currency_code ORDER BY currency_code ASC SEPARATOR ", ") AS currency_codes
                    FROM countries_currencies
                    GROUP BY country_id
                ) AS currencies ON c.id = currencies.country_id
                LEFT JOIN (
                    SELECT country_id, GROUP_CONCAT(DISTINCT timezone ORDER BY timezone ASC SEPARATOR ", ") AS timezones
                    FROM countries_timezones
                    GROUP BY country_id
                ) AS timezones ON c.id = timezones.country_id';

        $where = [];
        $having = [];
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

        if ($_countrySearchModel->currencyCode != '') {
            $having[] = 'currencies.currency_codes LIKE :currency_code';
            $params['currency_code'] = '%' . $_countrySearchModel->currencyCode . '%';
        }

        if ($_countrySearchModel->language != '') {
            $where[] = 'primary_language LIKE :language';
            $params['language'] = '%' . $_countrySearchModel->language . '%';
        }

        if (count($where) > 0) {
            $sql .= sprintf(' WHERE %s', implode(' AND ', $where));
        }

        if (count($having) > 0) {
            $sql .= sprintf(' HAVING %s', implode(' AND ', $having));
        }

        return $this->dbConn->getAll($sql, $params);;
    }
}
