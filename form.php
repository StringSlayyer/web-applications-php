<?php
declare(strict_types=1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$email = '';
$firstname = '';
$surname = '';
$street = '';
$city = '';
$zip = '';
$region = '';
$gender = '';
$note = '';

$errors = [];
$isSuccess = false;


if (isset($_POST['submit'])) {

    $email = (string)($_POST['email'] ?? '');
    $firstname = (string)($_POST['firstname'] ?? '');
    $surname = (string)($_POST['surname'] ?? '');
    $street = (string)($_POST['street'] ?? '');
    $city = (string)($_POST['city'] ?? '');
    $zip = (string)($_POST['zip'] ?? '');
    $region = (string)($_POST['region'] ?? '');
    $gender = (string)($_POST['gender'] ?? '');
    $note = (string)($_POST['note'] ?? '');

    $password = (string)($_POST['password'] ?? '');
    $password2 = (string)($_POST['password2'] ?? '');


    if ($password !== $password2) {
        $errors[] = 'Zadaná hesla se neshodují!';
    }


    if (empty($errors)) {
        $isSuccess = true;
    }
}
?>

<html>
<head>
    <title>Registrační formulář</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="./bootstrap/css/bootstrap.css" />
</head>
<body>

<div class="container">

    <h1 class="my-4">Registrační formulář</h1>

    <?php
    if ($isSuccess) {

        echo '<div class="alert alert-success" role="alert">'."\n";
        echo '<p class="text-center">E-mail: '.htmlspecialchars($email).'</p>'."\n";
        echo '<p class="text-center">Heslo: '.htmlspecialchars($password).'</p>'."\n";
        echo '<p class="text-center">Potvrzení hesla: '.htmlspecialchars($password2).'</p>'."\n";
        echo '<p class="text-center">Jméno: '.htmlspecialchars($firstname).'</p>'."\n";
        echo '<p class="text-center">Příjmení: '.htmlspecialchars($surname).'</p>'."\n";
        echo '<p class="text-center">Ulice a č.p.: '.htmlspecialchars($street).'</p>'."\n";
        echo '<p class="text-center">Město: '.htmlspecialchars($city).'</p>'."\n";
        echo '<p class="text-center">PSČ: '.htmlspecialchars($zip).'</p>'."\n";
        echo '<p class="text-center">Kraj: '.htmlspecialchars($region).'</p>'."\n";
        echo '<p class="text-center">Pohlaví: '.htmlspecialchars($gender).'</p>'."\n";
        echo '<p class="text-center">Poznámka: '.nl2br(htmlspecialchars($note)).'</p>'."\n";
        echo '</div>'."\n";
    } else {

        if (!empty($errors)) {
            echo '<div class="alert alert-danger" role="alert">'."\n";
            foreach ($errors as $error) {
                echo '<p class="text-center mb-0">'.htmlspecialchars($error).'</p>'."\n";
            }
            echo '</div>'."\n";
        }
        ?>
        <form method="post" action="form.php">

            
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">E-mail</label>
                <div class="col-md-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label">Heslo</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="password2" class="col-md-2 col-form-label">Potvrzení hesla</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="firstname" class="col-md-2 col-form-label">Jméno</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="firstname" name="firstname" maxlength="50" value="<?= htmlspecialchars($firstname) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="surname" class="col-md-2 col-form-label">Příjmení</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="surname" name="surname" maxlength="50" value="<?= htmlspecialchars($surname) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="street" class="col-md-2 col-form-label">Ulice a č.p.</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="street" name="street" value="<?= htmlspecialchars($street) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="city" class="col-md-2 col-form-label">Město</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($city) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="zip" class="col-md-2 col-form-label">PSČ</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="zip" name="zip" value="<?= htmlspecialchars($zip) ?>" required>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="region" class="col-md-2 col-form-label">Kraj</label>
                <div class="col-md-10">
                    <select class="form-control" id="region" name="region" required>
                        <option value="" disabled <?= empty($region) ? 'selected' : '' ?>>Vyberte kraj...</option>
                        <?php
                        $kraje = [
                                'Hlavní město Praha', 'Středočeský kraj', 'Jihočeský kraj', 'Plzeňský kraj',
                                'Karlovarský kraj', 'Ústecký kraj', 'Liberecký kraj', 'Královéhradecký kraj',
                                'Pardubický kraj', 'Kraj Vysočina', 'Jihomoravský kraj', 'Olomoucký kraj',
                                'Zlínský kraj', 'Moravskoslezský kraj'
                        ];
                        foreach ($kraje as $kraj) {
                            $selected = ($region === $kraj) ? 'selected' : '';
                            echo '<option value="'.htmlspecialchars($kraj).'" '.$selected.'>'.htmlspecialchars($kraj).'</option>'."\n";
                        }
                        ?>
                    </select>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Pohlaví</label>
                <div class="col-md-10 pt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_muz" value="muz" <?= ($gender === 'muz') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="gender_muz">Muž</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_zena" value="zena" <?= ($gender === 'zena') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="gender_zena">Žena</label>
                    </div>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="note" class="col-md-2 col-form-label">Poznámka</label>
                <div class="col-md-10">
                    <textarea class="form-control" id="note" name="note" rows="3"><?= htmlspecialchars($note) ?></textarea>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-md-2 col-form-label">&nbsp;</label>
                <div class="col-md-10">
                    <input type="submit" class="btn btn-success" name="submit" value="Odeslat">
                </div>
            </div>
        </form>
        <?php
    }
    ?>

</div>
</body>
</html>