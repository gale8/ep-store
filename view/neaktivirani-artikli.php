<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Neaktivirani artikli</title>

<h1>Neaktivirani artikli</h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
</p>


<?php foreach ($artikli as $artikel):?>
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

