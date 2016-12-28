<?php

require_once("ViewHelper.php");
require_once("model/UserDB.php");

class UserController {
    
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
