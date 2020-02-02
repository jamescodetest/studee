<?php
namespace Application\Models;

class CountryModel
{
    private $dbConn;
    private $id;

    public $countryName;
    public $capitalCity;
    public $countryCode;
    public $primaryLanguage;
    public $internationalDialingCode;
    public $region;
    public $timezones = [];
    public $currencies = [];
    public $flagUrl;

    public function __construct(\Application\Framework\DB $_dbConn, int $_id = 0)
    {
        $this->dbConn = $_dbConn;
        $this->id = $_id;
    }

    public function save()
    {
        if ($this->id == 0) {
            $this->dbConn->beginTransaction();

            $params = [
                'country_name' => $this->countryName,
                'capital_city' => $this->capitalCity,
                'country_code' => $this->countryCode,
                'primary_language' => $this->primaryLanguage,
                'international_dialing_code' => $this->internationalDialingCode,
                'region' => $this->region,
                'flag_url' => $this->flagUrl
            ];

            $sql = 'INSERT INTO countries (country_name, country_code, capital_city, primary_language, international_dialing_code, region, flag_url)
                    VALUES (:country_name, :country_code, :capital_city, :primary_language, :international_dialing_code, :region, :flag_url)';
            $this->dbConn->execute($sql, $params);

            $this->id = $this->dbConn->getIdentity();

            $this->saveTimezones();
            $this->saveCurrencies();

            $this->dbConn->commit();
        }
    }

    private function saveTimezones()
    {
        $sqlInserts = [];
        $params = [];
        foreach ($this->timezones as $idx => $timezone) {
            $sqlInserts[] = '(:country_id_' . $idx . ', :timezone_' . $idx . ')';
            $params['country_id_' . $idx] = $this->id;
            $params['timezone_' . $idx] = $timezone;
        }

        if (count($sqlInserts) > 0) {
            $sql = sprintf('INSERT INTO countries_timezones (country_id, timezone) VALUES %s', implode(',', $sqlInserts));
            $this->dbConn->execute($sql, $params);
        }
    }

    private function saveCurrencies()
    {
        $sqlInserts = [];
        $params = [];
        foreach ($this->currencies as $idx => $currencyCode) {
            $sqlInserts[] = '(:country_id_' . $idx . ', :currency_' . $idx . ')';
            $params['country_id_' . $idx] = $this->id;
            $params['currency_' . $idx] = $currencyCode;
        }

        if (count($sqlInserts) > 0) {
            $sql = sprintf('INSERT INTO countries_currencies (country_id, currency_code) VALUES %s', implode(',', $sqlInserts));
            $this->dbConn->execute($sql, $params);
        }
    }

    public function setData(array $_data)
    {
        $this->countryName = $_data['country_name'] ?? '';
        $this->countryCode = $_data['country_code'] ?? '';
        $this->capitalCity = $_data['capital_city'] ?? '';
        $this->primaryLanguage = $_data['primary_language'] ?? '';
        $this->internationalDialingCode = $_data['international_dialing_code'] ?? '';
        $this->region = $_data['region'] ?? '';
        $this->timezones = is_array($_data['timezones']) ? $_data['timezones'] : explode(',', $_data['timezones']);
        $this->currencies = is_array($_data['currency_codes']) ? $_data['currency_codes'] : explode(',', $_data['currency_codes']);
        $this->flagUrl = $_data['flag_url'] ?? '';
    }
}
