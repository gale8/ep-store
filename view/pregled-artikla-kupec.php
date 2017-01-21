<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css?version=51" ?>">
<meta charset="UTF-8" />
<title>Pregled artikla</title>

<h1>Artikel: <?= $ime_artikla ?></h1>

<p>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
    
    <!--Za zaposlene-->
    <?php if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){?>
    
        <a class="nav" href="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>">Uredi</a>
    
    <?php }?>
    
</p>

<?php 
    
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
       // echo("<script>console.log('PHP: ".json_encode("deluje")."');</script>");
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

<p>
    
    Ime artikla: <b><?= $ime_artikla ?></b><br>
    Cena: <b><?= $cena ?> €</b><br>
    Opis artikla: <b><?= $opis_artikla ?></b><br>    
        
    <?php if(isset($_SESSION["user_level"])){?>
    
        Artikel aktiviran? <i><?= $artikel_aktiviran==1 ? 'DA' : 'NE'?></i><br>
    
    <?php }?>
        
<form action="<?= $url ?>" method="post">
    <input type="hidden" name="do" value="add_into_cart" />
    <input type="hidden" name="id" value="<?= $id_artikla ?>" />
    <?php if(isset($_SESSION["user_id"]) && !isset($_SESSION["user_level"])){?>
    <button class="dodaj" type="submit">Dodaj!</button>
    <?php }?>
</form>
    
    
</p>