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

        return count($this->errors) == 0;
    }
}
