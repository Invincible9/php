<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
</html>

<h2>Register Form</h2>

<?php /** @var \App\Data\ErrorDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">

    <div>
        <input type="radio" id="individual" name="drone">
        <label for="individual">Physical face</label>
    </div>

    <div>
        <input type="radio" id="legal" name="drone">
        <label for="legal">Legal entity</label>
    </div>

    <div id="pf">
    </div>

    <div id="le">
    </div>

    <div id="all">
    </div>
</form>

<a href="index.php">back</a>

<script>
    let all = `<hr/>
        <label>
            Username: <input type="text" name="username" value="<?= $data != null ? $data->getUsername() : $data ?>"/> <br/>
        </label>
        <label>
            Password: <input type="password" name="password"/> <br/>
        </label>
        <label>
            Confirm Password: <input type="password" name="confirm_password"/> <br/>
        </label>
        <input type="submit" name="register" value="Register"/> <br/>`;

    $('#individual').click(function () {
        $('#le').empty();
        $('#pf').empty();
        $('#pf').append(`<br /><hr/><label>
            Name: <input type="text" name="name" value="<?= $data != null ? $data->getName() : $data ?>"/> <br />
        </label>
        <label>
            Middle Name: <input type="text" name="middle_name" value="<?= $data != null ? $data->getMiddleName() : $data ?>"/> <br />
        </label>

        <label>
            Last Name: <input type="text" name="last_name" value="<?= $data != null ? $data->getLastName() : $data ?>"/> <br />
        </label>

        <label>
            EGN: <input type="text" name="egn" value="<?= $data != null ? $data->getEgn() : $data ?>" /> <br />
        </label>
        <input type="hidden" name="type" value="1" />
        `);
        $('#pf').append(all);
    });

    $('#legal').click(function () {
        $('#le').empty();
        $('#pf').empty();
        $('#le').append(`<br /><hr/><label>
            Company Name: <input type="text" name="company_name" value="<?= $data != null ? $data->getCompanyName() : $data ?>"/> <br />
        </label>
        <label>
            Tax ID / Bulstat: <input type="text" name="tax_id" value="<?= $data != null ? $data->getTaxId() : $data ?>" /> <br />
        </label>
        <input type="hidden" name="type" value="2" />
        `);
        $('#le').append(all);
    });

    if ('<?= $_SESSION['type'] == 1 ?>') {
        $('#individual').trigger('click');
    } else {
        $('#legal').trigger('click');
    }

</script>

