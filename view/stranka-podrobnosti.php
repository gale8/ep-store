<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Ogled stranke</title>

<h1>Stranka: <?= $ime_stranke ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a><!-- IZBRISI SPODNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
    <a class="nav" href="<?= BASE_URL . "stranke/uredi/" . $id_stranke ?>">Uredi profil</a>
</p>

<p>
    
        Ime: <b><?= $ime_stranke ?></b><br>
        Priimek: <b><?= $priimek_stranke ?></b><br>
        Email: <b><?= $email_stranke ?></b><br>
        Geslo: <b><?= $geslo_stranke ?></b><br>
        Ulica in hišna številka: <b><?= $naslov_stevilka ?></b><br>
        Telefonska številka: <b><?= $tel_st ?></b><br>
        ID pošte: <b><?= $id_poste ?></b><br>
        
</p>

