<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Pregled artikla</title>

<h1>Artikel: <?= $ime_artikla ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a><!-- IZBRISI SPODNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
    <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    <a class="nav" href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a>
</p>

<p>
    
        Ime artikla: <b><?= $ime_artikla ?></b><br>
        Cena: <b><?= $cena ?> €</b><br>
        Opis artikla: <b><?= $opis_artikla ?></b><br>
        <!-- zakomentiraj spodnjo vrstico !!
        To vrstico se doda v pregled-artikla-zaposleni.php -->
        Artikel aktiviran? <i><?= $artikel_aktiviran==1 ? 'DA' : 'NE'?></i><br>
    
    
</p>


<!--
p>[ <a href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a> |
    <a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a> ]</p>
-->