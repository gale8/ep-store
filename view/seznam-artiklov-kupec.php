<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Spletna trgovina</title>

<h1>Spletna trgovina</h1>

<p>
    <a class="nav" href="<?= BASE_URL . "registracija" ?>">Registracija</a>
    <a class="nav" href="<?= BASE_URL . "vpisStranke" ?>">Vpis stranke</a>
    <a class="nav" href="<?= BASE_URL . "vpisProdajalca" ?>">Vpis prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "vpisAdministratorja" ?>">Vpis administratorja</a>
    <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    <!-- IZBRISI ZGORNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
</p>


<?php foreach ($artikli as $atikel): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "artikli/" . $atikel["id_artikla"] ?>"> <b><span style="text-transform: uppercase"><?= $atikel["ime_artikla"] ?></span></b>
                        <br>cena: <?= $atikel["cena"] ?> EUR <br> opis: <?= $atikel["opis_artikla"] ?><a/>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

