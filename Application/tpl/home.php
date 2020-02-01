<form action="/" method="post">
    <label for="country_name">Country name</label>
    <input type="text" name="country_name" id="country_name" value="<?php echo $countrySearchModel->countryName ?? ''?>" />

    <label for="country_code">Country code</label>
    <input type="text" name="country_code" id="country_code" value="<?php echo $countrySearchModel->countryCode ?? ''?>" />

    <label for="capital_city">Capital city</label>
    <input type="text" name="capital_city" id="capital_city" value="<?php echo $countrySearchModel->capitalCity ?? ''?>" />

    <label for="currency_code">Currency code</label>
    <input type="text" name="currency_code" id="currency_code" value="<?php echo $countrySearchModel->currencyCode ?? ''?>" />

    <label for="language">Language</label>
    <input type="text" name="language" id="language" value="<?php echo $countrySearchModel->language ?? ''?>" />

    <input type="submit" name="submit" value="Retrieve data" />
</form>
