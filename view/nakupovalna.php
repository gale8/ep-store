<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Nakupovalna košarica</title>
<?php require_once 'Artikel.php'; ?>
<h1>Nakupovalna košarica</h1>
<?php $profil = "zaposlenci/uredi/"; ?>
<p>
    <a class="nav" href="<?= BASE_URL . $profil . $_SESSION["user_id"] ?>">Uredi profil</a>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    <a class="nav" href="<?= BASE_URL . "izpis" ?>">Izpis</a>
    <a class="nav" href="<?= BASE_URL . "kosara" ?>">Košarica</a>
    
    <!-- IZBRISI ZGORNJO VRSTICO!! | to vrstico se doda v pregled-artikla-zaposleni.php -->
</p>
<?php 
    session_name('cart');
    $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    $url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
    $validationRules = ['do' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            "regexp" => "/^(add_into_cart|update_cart|send_cart|purge_cart)$/"
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
    case "update_cart":
        
        if (isset($_SESSION["cart"][$data["id"]])) {
             if(isset($_POST["pop"])) {
                $data["kolicina"] = 0; 
            }
            if ($data["kolicina"] > 0) {
                $_SESSION["cart"][$data["id"]] = $data["kolicina"];
            } 
            
            else {
                unset($_SESSION["cart"][$data["id"]]);
            }
        }
        break;
    case "send_cart":
        if(isset($_SESSION["cart"])) {
            //dodamo narocilo, da potem lahko dobimo ID Narocila vn
            $temp_idStranke = $_SESSION["user_id"];
            NarociloDB::dodajNarocilo($temp_idStranke);
            
            //iz baze prebremo zadnji ID narocilo
            $temp_idNarocila = NarociloDB::getIDnarocila();
            $var_temp = $temp_idNarocila[0];
            $bla = $var_temp["id_narocila"];
            
             echo("<script>console.log('PHP: ".json_encode($var_temp["id_narocila"])."');</script>");
           foreach ($_SESSION["cart"] as $id => $kolicina) {
                $knjiga = NarociloDB::getOne($id); //pridobi $id artikla;
                //INSERT INTO artikel_narocilo
                $temp_idArtikla = $knjiga->id_artikla;
                $temp_kolicinaArtikla = (string)$kolicina;
                
                NarociloDB::dodajArtikelNarocilo($bla, $temp_idArtikla, $temp_kolicinaArtikla);
                
               
            }
            unset($_SESSION["cart"]);
            echo $_SESSION["ime"] . " zahvaljujemo se vam za vaš nakup!";
           
        
            
        }  
        break;
    
    case "purge_cart":
        unset($_SESSION["cart"]);
        break;
    default:
        break;
}
    ?>
<div class="cart">
    <div class="buyer_cart">
        <?php if(isset($_SESSION["user_id"])) : ?>
    <h3>Nakupovalna košara:</h3>

    <?php
        $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
            if ($kosara):
                
                $znesek = 0;

                foreach ($kosara as $id => $kolicina):
                    $knjiga = NarociloDB::getOne($id);
                    $znesek += $knjiga->cena * $kolicina;
                    ?>
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="update_cart" />
                        <input type="hidden" name="id" value="<?= $knjiga->id_artikla ?>" />
                        <input type="number" name="kolicina" value="<?= $kolicina ?>"
                               class="short_input" />
                        &times; <?= ucfirst($knjiga->ime_artikla) ?> 
                        <button class="dodaj" type="submit">Posodobi</button> 
                        <input  class="dodaj" type="submit" name="pop" value="Odstrani" />
                    </form>
                   
    
                <?php endforeach; ?>

                <p>Skupna cena: <b><?= number_format($znesek, 2) ?> EUR</b></p>
                

                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="purge_cart" />
                    <input class="dodaj" type="submit" value="Izprazni košarico" />
                </form>
                <br/>
                
                <a class="dodaj" href="<?= BASE_URL . "oddaja-narocila" ?>">Povzetek naročila</a>
                
            <?php else: ?>
                Nakupovalna košara je prazna.                
            <?php endif; ?>
        <?php endif;?>
    </div>
</div> 