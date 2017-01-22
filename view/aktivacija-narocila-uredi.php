<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title><?= $title ?></title>

<h1><?= $title ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "narocila" ?>">Pregled narocil</a>
</p>
<b> Stranka: <?= $ime ?> <?= $priimek?></b><br/>
<?php foreach($nakup as $n) :?>
<p> Ime izdelka: <b><?= $n["ime_artikla"] ?></b>, Količina: <b><?= $n["kolicina"] ?></b> </p>
<?php endforeach; ?>
Trenutni status naročila: <b> <?= $n_status ?></b><br/>
<?= $form ?>
