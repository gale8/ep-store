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
        <a class="nav" href="<?= BASE_URL . "stranke/pregled/" . $_SESSION["user_id"] ?>">Pregled preteklih naročil</a>
        <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
        <a class="nav" href="<?= BASE_URL . "kosara" ?>">Košarica</a>
              
    <!--Za neprijavljene-->
    <?php } else {?>    

        <a class="nav" href="<?= BASE_URL . "stranke/registracija" ?>">Registracija</a>

        <a class="nav" href="<?= BASE_URL . "stranke/vpis" ?>">Vstop za stranke</a>

        <a class="nav" href="<?= BASE_URL . "/view/cert/employee-formCert.php" ?>">Vstop za zaposlene</a>
    
    <?php }?>
    
    
    <!-- IZBRISI ZGORNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
</p>

<?php 
    session_name('cart');
    $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    $url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
    $validationRules = ['do' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            "regexp" => "/^(add_into_cart)$/"
        ]
    ],
    'id' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ],
    'kolicina' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ]
];
    $data = filter_input_array(INPUT_POST, $validationRules);

switch ($data["do"]) {
    case "add_into_cart":
        try {
        
            $knjiga = NarociloDB::getOne($data["id"]);

            if (isset($_SESSION["cart"][$knjiga->id_artikla])) {
                $_SESSION["cart"][$knjiga->id_artikla] ++;
            } else {
                $_SESSION["cart"][$knjiga->id_artikla] = 1;
            }
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
        break;
    default:
        break;
}
    ?>

<?php foreach ($artikli as $artikel): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id" value="<?= $artikel["id_artikla"] ?>" />
                    <a title="Ime: <?=$artikel["ime_artikla"]?>&#013;Cena: <?=$artikel["cena"]?>€&#013;Opis: <?=$artikel["opis_artikla"]?>" href="<?= BASE_URL . "artikli/" . $artikel["id_artikla"] ?>">
                        <b><span style="text-transform: uppercase"><?php echo strlen($artikel["ime_artikla"]) < 10 ? $artikel["ime_artikla"] : substr($artikel["ime_artikla"], 0, 7) . "...";?></span></b>
                        <br>cena: <?= $artikel["cena"] ?> € </a>
                         <br/>
                        <?php if(isset($_SESSION["user_id"]) && !isset($_SESSION["user_level"])): ?>
                        <button class="dodaj" type="submit">Dodaj!</button>
                        <?php                            endif;?>
                </form>
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

