<?php $uptil = isset($ptil) ? ucfirst($ptil) : SITE::AUTHOR ?>
<!DOCTYPE html>
<html lang="<?= SITE::LANGUAGE ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?= SITE::DESCRIPTION ?>">
    <link rel="stylesheet" href="<?= CSS::BOOTSTRAP ?>">
    <link rel="stylesheet" href="<?= CSS::STYLE ?>">
    <title><?= $uptil . ' | ' . SITE::TITLE ?></title>
    <link rel="shortcut icon" href="<?= $SITE::LOGO ?>" type="image/x-icon">
</head>
<?php include("./src/modals/login_modal.php") ?>