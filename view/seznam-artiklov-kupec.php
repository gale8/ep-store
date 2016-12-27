<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Vsi artikli</title>

<h1>Vsi artikli</h1>

<p style="text-align: center;">
<!-- IZBRISI SPODNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
    <a href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
</p>


<?php foreach ($artikli as $atikel): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "artikli/" . $atikel["id_artikla"] ?>"> <b><span style="text-transform: uppercase"><?= $atikel["ime_artikla"] ?></span></b>
                        <br>cena: <?= $atikel["cena"] ?> <br> opis: <?= $atikel["opis_artikla"] ?><a/>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

