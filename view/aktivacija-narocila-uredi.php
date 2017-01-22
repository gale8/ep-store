<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title><?= $title ?></title>

<h1><?= $title ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>     
</p>
<?php 
    switch ($status) {

<?= $form ?>
