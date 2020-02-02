<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-header">
                Search for country
            </div>
            <div class="card-body">
                <?php if (count($errors) > 0) : ?>
                <div class="alert alert-danger" role="alert">
                <p>The following errors have occurred:</p>
                <?php foreach ($errors as $error) : ?>
                    <?php echo $error?><br />
                <?php endforeach; ?>
                </div>
                <?php endif;?>


                <form action="/" method="post">
                    <div>
                        <div class="form-group">
                            <label for="country_name">Country name</label>
                                <input type="text" class="form-control" name="country_name" id="country_name" value="<?php echo $countrySearchModel->countryName ?? ''?>" />
                        </div>

                        <div class="form-group">
                            <label for="country_code">Country code</label>
                                <input type="text" class="form-control" name="country_code" id="country_code" value="<?php echo $countrySearchModel->countryCode ?? ''?>" />
                        </div>

                        <div class="form-group">
                            <label for="capital_city">Capital city</label>
                                <input type="text" class="form-control" name="capital_city" id="capital_city" value="<?php echo $countrySearchModel->capitalCity ?? ''?>" />
                        </div>

                        <div class="form-group">
                            <label for="currency_code">Currency code</label>
                                <input type="text" class="form-control" name="currency_code" id="currency_code" value="<?php echo $countrySearchModel->currencyCode ?? ''?>" />
                        </div>

                        <div class="form-group">
                            <label for="language">Language</label>
                                <input type="text" class="form-control" name="language" id="language" value="<?php echo $countrySearchModel->language ?? ''?>" />
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Retrieve data" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
    <?php if (count($countries) > 0) : ?>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Flag</th>
                <th>Country name</th>
                <th>Dialing code</th>
                <th>Region</th>
                <th>Capital</th>
                <th>Timezones</th>
                <th>Currencies</th>
            </tr>
        </thead>

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
    </div>
</div>
