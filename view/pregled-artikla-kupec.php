<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Pregled artikla</title>

<h1>Artikel: <?= $ime_artikla ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    
    <!--Za zaposlene-->
    <?php if(isset($_SESSION["user_level"])){?>
    
        <a class="nav" href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a>
    
    <?php }?>
    
</p>

<p>
    
    Ime artikla: <b><?= $ime_artikla ?></b><br>
    Cena: <b><?= $cena ?> €</b><br>
    Opis artikla: <b><?= $opis_artikla ?></b><br>    
        
    <?php if(isset($_SESSION["user_level"])){?>
    
        Artikel aktiviran? <i><?= $artikel_aktiviran==1 ? 'DA' : 'NE'?></i><br>
    
    <?php }?>
    
    
</p>