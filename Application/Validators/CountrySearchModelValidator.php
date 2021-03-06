<?php
namespace Application\Validators;

use Application\Framework\Validator;

class CountrySearchModelValidator extends Validator
{
    private $countrySearchModel;

    public function __construct(\Application\Models\CountrySearchModel $_countrySearchModel)
    {
        $this->countrySearchModel = $_countrySearchModel;
    }

    public function validate(): bool
    {
        if ($this->countrySearchModel->countryCode != '' && strlen($this->countrySearchModel->countryCode) != 2) {
            $this->errors[] = 'Country code must be exactly 2 characters';
        }

        if ($this->countrySearchModel->currencyCode != '' && strlen($this->countrySearchModel->currencyCode) != 3) {
            $this->errors[] = 'Currency code must be exactly 3 characters';
        }

        if ($this->countrySearchModel->language != '' && strlen($this->countrySearchModel->language) != 2) {
            $this->errors[] = 'Language code must be exactly 2 characters';
        }

        if (
            $this->countrySearchModel->countryName == '' &&
            $this->countrySearchModel->countryCode == '' &&
            $this->countrySearchModel->currencyCode == '' &&
            $this->countrySearchModel->capitalCity == '' &&
            $this->countrySearchModel->language == ''
        ) {
            $this->errors[] = 'You must enter at least one search criteria';
        }

        return count($this->errors) == 0;
    }
}
