<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title><?= $title ?></title>

<h1><?= $title ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>     
</p>
<?php 
    switch ($status) {

        case 1:
            $temp_status = "Potrjeno";
            break;
        case 2:
            $temp_status = "Preklicano";
            break;
        case 3:
            $temp_status = "Stornirano";
            break;
        default:
            $temp_status = "Nepotrjeno";
            break;
    }
?>
<p>
    ID naročila: <b><?= $narocilo["id_narocila"] ?></b><br/>
    ID stranke: <b><?= $narocilo["id_stranke"] ?></b><br/>
    Trenutni status naročila: <b><?= $temp_status ?></b><br/>
    
</p>
<?php $form ?>

