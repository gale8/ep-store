<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title>Pregled naročil</title>
<h1>Pregled naročil</h1>


<p>
    
      <?php $profil = "stranke/uredi/";?>
    
    <!--Za prijavljene-->
    <?php if(isset($_SESSION["user_id"])){?>
    
    <!--Za vse zaposlene-->
    <?php if(!(isset($_SESSION["user_level"]))){?>
     
        <!--Za vse prijavljene-->
        <a class="nav" href="<?= BASE_URL . $profil . $_SESSION["user_id"] ?>">Uredi profil</a>
         <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
        <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
        <a class="nav" href="<?= BASE_URL . "kosara" ?>">Košarica</a>
              
    <!--Za neprijavljene-->
    <?php } ?>
    <?php } ?>
</p>


<?php foreach ($narocila as $narocilo):
       if($narocilo["narocilo_potrjeno"] == 1) {
        $temp_status = "Potrjeno";
    }
    if($narocilo["narocilo_preklicano"] == 1) {
        $temp_status = "Preklicano";
    }
    if($narocilo["narocilo_stornirano"] == 1) {
        $temp_status = "Stornirano";
    }
    else {
        $temp_status = "Nepotrjeno";
    }?>
<?php if($_SESSION["user_id"] == $narocilo["id_stranke"]) :?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "stranke/pregled/narocilo/"  . $narocilo["id_narocila"] ?>"> Številka naročila:<b><?= $narocilo["id_narocila"] ?></b>
                        <br>Število izdelkov:<b> <?= $narocilo["kolicina"] ?></b><br/>
                        <b>Status narolila: <?= $temp_status ?> </b></a>
                    
                </div> 
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>

