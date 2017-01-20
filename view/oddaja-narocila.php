<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Nakupovalna košarica</title>
<?php require_once 'Artikel.php'; ?>
<h1>Nakupovalna košarica</h1>

<?php 
    
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
    case "send_cart":
        if(isset($_SESSION["cart"])) {
            //dodamo narocilo, da potem lahko dobimo ID Narocila vn
            $temp_idStranke = $_SESSION["user_id"];
            echo("<script>console.log('PHP: ".json_encode(array($temp_idStranke))."');</script>");
            NarociloDB::dodajNarocilo(["id_stranke"=>$temp_idStranke]);
            
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
                
                NarociloDB::dodajArtikelNarocilo(["id_narocila"=>$bla, "id_artikla"=>$temp_idArtikla, "kolicina"=>$temp_kolicinaArtikla]);
                
               
            }
            unset($_SESSION["cart"]);
            echo "Spoštovani/a gospod/gospa " . $_SESSION["ime"] . ", zahvaljujemo se vam za vaš nakup!";
            echo " V 5 sekundah boste preusmerjeni na začetno stran...";
            $location =  BASE_URL . "artikli" ;
            header("Refresh: 5; URL=".$location); 
  
        }  
        break;
    
    
    default:
        break;
}
    ?>           

<div class="cart">
    <div class="buyer_cart">
        <?php if(isset($_SESSION["user_id"])) : ?>
        
   
        <h3>Naročnikovi podatki:</h3>
        Ime in priimek: <b><?= $stranka[0]["ime_stranke"] . " " . $stranka[0]["priimek_stranke"] ?> </b><br/>
        Telefonska številka: <b><?= $stranka[0]["tel_st"] ?> </b><br/>
            Naslov: <b><?= $stranka[0]["naslov_stevilka"] ?> </b><br/>
            Pošta: <b><?= $stranka[0]["postna_st"] . " " . $stranka[0]["ime_poste"] ?> </b><br/>
        
        <?php if(isset($_SESSION["cart"])) :?>
    <h3>Vaš predračun:</h3>

    <?php
        $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
            if ($kosara):
                
                $znesek = 0;

                foreach ($kosara as $id => $kolicina):
                    $knjiga = NarociloDB::getOne($id);
                    $znesek += $knjiga->cena * $kolicina;
                    echo "<p>" . ucfirst($knjiga->ime_artikla) ." (". $knjiga->cena ."EUR): ". $kolicina ."x => ". $knjiga->cena*$kolicina ."EUR</p>";
                    ?>
                    
                   
                
                <?php endforeach; ?>
                <p>Skupna cena: <b><?= number_format($znesek, 2) ?> EUR</b></p>
                <a class="dodaj" href="<?= BASE_URL . "kosara" ?>">Uredi nakup</a>
                <br/>
                <br/>
                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="send_cart" />
                    <input class="dodaj"  type="submit" value="Oddaj naročilo" />
                </form>
                 <?php endif; ?>
    <?php endif; ?>
                <?php                                endif;?>
    </div>
</div>