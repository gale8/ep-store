<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Spletna trgovina</title>

<h1>Spletna trgovina</h1>

<p>
    <!--Za urejanje lastnega profila-->
    <?php $profil = "stranke/uredi/"; ?>
    
    <!--Za prijavljene-->
    <?php if(isset($_SESSION["user_id"])){?>
    
    <!--Za vse zaposlene-->
    <?php if(isset($_SESSION["user_level"])){?>
        
        <a class="nav" href="<?= BASE_URL . "stranke" ?>">Pregled strank</a>        

        <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
                      
                <!--Za admine-->
        <?php if($_SESSION["user_level"] == 1){?>            

            <a class="nav" href="<?= BASE_URL . "zaposlenci" ?>">Pregled zaposlenih</a>

        <?php }?>
    
    <?php $profil = "zaposlenci/uredi/"; }?>
        <!--Za vse prijavljene-->
        <a class="nav" href="<?= BASE_URL . $profil . $_SESSION["user_id"] ?>">Uredi profil</a>
        <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
              
    <!--Za neprijavljene-->
    <?php } else {?>    

        <a class="nav" href="<?= BASE_URL . "stranke/registracija" ?>">Registracija</a>

        <a class="nav" href="<?= BASE_URL . "stranke/vpis" ?>">Vstop za stranke</a>

        <a class="nav" href="<?= BASE_URL . "/view/cert/employee-formCert.php" ?>">Vstop za zaposlene</a>
    
    <?php }?>
    
    
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

