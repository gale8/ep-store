<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title>Spletna trgovina</title>

<h1>EP-Store</h1>
<?php if(isset($_SESSION["user_id"])){?> <h2 class="pozdrav">Pozdravljen/a <?php if(isset($_SESSION["ime"])){ echo $_SESSION["ime"];}?>! <?php if(isset($_SESSION["user_level"])){ echo $_SESSION["user_level"] == 1 ? "(Status: Administrator)" : "(Status: Prodajalec)";}?></h2><?php }?>

<p>
    <!--Za urejanje lastnega profila-->
    <?php $profil = "stranke/uredi/";?>
    
    <!--Za prijavljene-->
    <?php if(isset($_SESSION["user_id"])){?>
    
    <!--Za vse zaposlene-->
    <?php if(isset($_SESSION["user_level"])){?>
    
    <!--Prikaz za prodajalce-->
    <?php if($_SESSION["user_level"] == 0){?>  
    
        <a class="nav" href="<?= BASE_URL . "stranke" ?>">Pregled strank</a>        

        <a class="nav" href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
        
        <a class="nav" href="<?= BASE_URL . "artikli/neaktivni" ?>">Neaktivirani artikli</a>
    <?php }?>    

                      
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
                    
                    <a title="Ime: <?=$artikel["ime_artikla"]?>&#013;Cena: <?=$artikel["cena"]?>€&#013;Opis: <?=$artikel["opis_artikla"]?>" href="<?= BASE_URL . "artikli/" . $artikel["id_artikla"] ?>">
                        <b><span style="text-transform: uppercase"><?php echo strlen($artikel["ime_artikla"]) < 10 ? $artikel["ime_artikla"] : substr($artikel["ime_artikla"], 0, 7) . "...";?></span></b>
                        <br>cena: <?= $artikel["cena"] ?> € </a>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

