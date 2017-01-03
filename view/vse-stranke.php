<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Vse stranke</title>

<h1>Vse stranke</h1>

<p>
    <a class="nav" href="<?= BASE_URL . "stranke/registracija" ?>">Registracija</a>
    <a class="nav" href="<?= BASE_URL . "zaposlenci/registracija" ?>">Registracija prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "vpisStranke" ?>">Vpis stranke</a>
    <a class="nav" href="<?= BASE_URL . "vpisProdajalca" ?>">Vpis prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "vpisAdministratorja" ?>">Vpis administratorja</a>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "zaposlenci" ?>">Vsi zaposlenci</a>
    <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    
    <!-- IZBRISI ZGORNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
</p>


<?php foreach ($stranke as $stranka): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "stranke/" . $stranka["id_stranke"] ?>"> <b><span style="text-transform: uppercase"><?= $stranka["email_stranke"] ?></span></b>
                        <br>Ime in priimek: <br><?= $stranka["ime_stranke"] . ' ' . $stranka["priimek_stranke"]?> </a>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>
