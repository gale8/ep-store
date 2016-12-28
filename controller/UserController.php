<?php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("forms/UsersForm.php");

class UserController {
    
    public static function index() {
        echo ViewHelper::render("view/zacetna.php", [
           "artikli" => UserDB::getAll() 
        ]);
    }
    /*
    public static function addForm($values = [
        "email_stranke" => "",
        "ime_stranke" => "",
        "priimek_stranke" => "",
        "geslo_stranke" => ""
    ]) {
        echo ViewHelper::render("view/user-form.php", $values);
    }
    */
    public static function add() {
        $form = new UsersInsertForm("add_form");
        
        if ($form->validate()) {
            $id = UserDB::insert($form->getValue());
            ViewHelper::redirect(BASE_URL . "stranka/" . $id);
        } else {
            echo ViewHelper::render("view/user-form.php", [
                "title" => "Registracija",
                "form" => $form
            ]);
        }
    }
    
    
    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
    
    public static function getRules() {
        return [
            'ime_artikla' => FILTER_SANITIZE_SPECIAL_CHARS,
            'cena' => FILTER_SANITIZE_SPECIAL_CHARS,
            'opis_artikla' => FILTER_SANITIZE_SPECIAL_CHARS,
            'artikel_aktiviran' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
    
    
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
    
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
    
     */
}
