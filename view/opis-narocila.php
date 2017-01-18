<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title>Pregled artikla</title>


<?php $profil = "stranke/uredi/"; ?>
<p>
    <a class="nav" href="<?= BASE_URL . $profil . $_SESSION["user_id"] ?>">Uredi profil</a>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "stranke/pregled/" . $_SESSION["user_id"] ?>">Pregled preteklih naročil</a>
    <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
    <a class="nav" href="<?= BASE_URL . "kosara" ?>">Košarica</a>
    
    <!--Za zaposlene-->
    <?php if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){?>
    
        <a class="nav" href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a>
        <a class="nav" href="<?= BASE_URL . "stranke/pregled/" . $_SESSION["user_id"] ?>">Pregled preteklih naročil</a>
    
    <?php } $skupna_cena = 0;?>
    
</p>

<p>
    <?php foreach($narocilo as $izdelek):
        $skupna_cena += $izdelek["cena"]?>
    
    Id artikla: <b><?= $izdelek["id_artikla"]?></b>, Ime artikla: <b><?= ucfirst($izdelek["ime_artikla"]) ?></b>, Količina: <b><?= $izdelek["kolicina"]?></b>, Cena plačana za artikel: <b><?= number_format($izdelek["cena"], 2) ?></b><br>
    
     <?php endforeach; ?>
    <br/>
    Skupna cena: <b><?= number_format($skupna_cena, 2) ?> EUR</b>

</p>