<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Ogled zaposlenca</title>

<h1>Zaposleni: <?= $ime_zaposlenca ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "zaposlenci/uredi/" . $id_zaposlenca ?>">Uredi profil</a>
</p>

<p>
    
        Ime: <b><?= $ime_zaposlenca ?></b><br>
        Priimek: <b><?= $priimek_zaposlenca ?></b><br>
        Email: <b><?= $email_zaposlenca ?></b><br>
        Geslo: <b><?= $geslo_zaposlenca ?></b><br>
        Profil aktiviran? <b><?= $zaposlenec_aktiviran == 1 ? 'DA' : 'NE' ?></b><br>
        Je administrator? <b><?= $je_admin == 1 ? 'DA' : 'NE' ?></b><br>
        
</p>

