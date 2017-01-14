<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Spletna trgovina</title>

<h1>Spletna trgovina</h1>

<p>
    <a class="nav" href="<?= BASE_URL . "zaposlenci/stranke/registracija" ?>">Registracija prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "stranke/vpis" ?>">Vpis stranke</a>
    <a class="nav" href="<?= BASE_URL . "vpisProdajalca" ?>">Vpis prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "vpisAdministratorja" ?>">Vpis administratorja</a>
    <a class="nav" href="<?= BASE_URL . "stranke" ?>">Vse stranke</a>
    <a class="nav" href="<?= BASE_URL . "zaposlenci" ?>">Vsi zaposlenci</a>
    <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    
    <!-- IZBRISI ZGORNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
</p>


<?php foreach ($artikli as $artikel): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "artikli/" . $artikel["id_artikla"] ?>"> <b><span style="text-transform: uppercase"><?= $artikel["ime_artikla"] ?></span></b>
                        <br>cena: <?= $artikel["cena"] ?> € </a>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

