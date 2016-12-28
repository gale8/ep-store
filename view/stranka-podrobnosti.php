<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Ogled stranke</title>

<h1>Stranka: <?= $ime_stranke ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Nazaj na artikle</a><!-- IZBRISI SPODNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
    <a class="nav" href="<?= BASE_URL . "stranka/uredi/" . $id_stranke ?>">Uredi profil</a>
</p>

<p>
    
        Ime: <b><?= $ime_stranke ?></b><br>
        Priimek: <b><?= $priimek_stranke ?></b><br>
</p>

