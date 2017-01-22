<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title><?= $title ?></title>
<h1><?= $title ?></h1>


<p>
    
    
    <!--Za prijavljene-->
    
    <!--Za vse zaposlene-->
    <?php if((isset($_SESSION["user_level"]))){?>
     
        <!--Za vse prijavljene-->
      
         <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
        <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
      
              
    <!--Za neprijavljene-->
    
    <?php } ?>
</p>

<?php
    $temp_status = "";
    foreach($narocila as $narocilo) :
    
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
    }
    ?>
        <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "narocila/uredi/"  . $narocilo["id_narocila"] ?>"> Številka naročila:<b><?= $narocilo["id_narocila"] ?></b>
                        <br>Status naročila :<b> <?= $temp_status ?></b> </a>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

