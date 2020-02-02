<?php if (count($errors) > 0) : ?>
<p>The following errors have occurred:</p>
<?php foreach ($errors as $error) : ?>
    <?php echo $error?><br />
<?php endforeach; ?>
<?php endif;?>

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

<?php if (count($countries) > 0) : ?>
<table>
    <tr>
        <th>Flag</th>
        <th>Country name</th>
        <th>Dialing code</th>
        <th>Region</th>
        <th>Capital</th>
        <th>Timezones</th>
        <th>Currencies</th>
    </tr>

    <?php foreach ($countries as $countryModel) : ?>
        <tr>
            <td><?php echo $countryModel->flagUrl != '' ? '<img src="' . $countryModel->flagUrl .'" width="50" />' : ''?>
            <td><?php echo $countryModel->countryName?></td>
            <td><?php echo $countryModel->internationalDialingCode?></td>
            <td><?php echo $countryModel->region?></td>
            <td><?php echo $countryModel->capitalCity?></td>
            <td><?php echo implode(', ', $countryModel->timezones)?></td>
            <td><?php echo implode(', ', $countryModel->currencies)?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
