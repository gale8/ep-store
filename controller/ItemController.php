<?php

require_once("ViewHelper.php");
require_once("model/ItemDB.php");

class ItemController {
    
    public static function index() {
        echo ViewHelper::render("view/seznam-artiklov-kupec.php", [
           "artikli" => ItemDB::getAll() 
        ]);
    }
    
    public static function addForm($values = [
        "ime_artikla" => "",
        "cena" => "",
        "opis_artikla" => ""
    ]) {
        echo ViewHelper::render("view/dodaj-artikel.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());
        #var_dump(INPUT_POST);
        #var_dump($data);
        if (self::checkValues($data)) {
            $id = ItemDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "artikli/" . $id);
        } else {
            self::addForm($data);
        }
    }
    
    public static function get($id) {
        echo ViewHelper::render("view/pregled-artikla-kupec.php", ItemDB::get(["id_artikla" => $id]));
    }
    
    
    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $data["id_artikla"] = $id;
            ItemDB::update($data);
            ViewHelper::redirect(BASE_URL . "artikli/" . $data["id_artikla"]);
        } else {
            self::editForm($data);
        }
    }
    
    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = ItemDB::get(["id_artikla" => $params]);
        } else {
            throw new InvalidArgumentException("Obrazca za urejanje artikla ni mogoce prikazati.");
        }

        echo ViewHelper::render("view/uredi-artikel.php", $values);
    }
    
    
    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'ime_artikla' => FILTER_SANITIZE_SPECIAL_CHARS,
            'cena' => FILTER_SANITIZE_SPECIAL_CHARS,
            'opis_artikla' => FILTER_SANITIZE_SPECIAL_CHARS,
            'artikel_aktiviran' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
    
    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }
            
 
}