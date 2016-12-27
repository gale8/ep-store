<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Pregled artikla</title>

<h1>Artikel: <?= $ime_artikla ?></h1>

<p>
    <a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a><!-- IZBRISI SPODNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
    <a href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    <a href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a>
</p>

<p>
    <ul>
        <li>Ime artikla: <b><?= $ime_artikla ?></b></li>
        <li>Cena: <b><?= $cena ?> EUR</b></li>
        <li>Opis artikla: <b><?= $opis_artikla ?></b></li>
        <!-- zakomentiraj spodnjo vrstico !!
        To vrstico se doda v pregled-artikla-zaposleni.php -->
        <li>Artikel aktiviran? <i><?= $artikel_aktiviran==1 ? 'DA' : 'NE'?></i></li>
    
    </ul>
</p>


<!--
p>[ <a href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a> |
    <a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a> ]</p>
-->