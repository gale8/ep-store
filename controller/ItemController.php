<?php

require_once("ViewHelper.php");
require_once("model/ItemDB.php");
require_once("forms/ItemsForm.php");
require_once("model/NarociloDB.php");

class ItemController {
    
    public static function index() {
        echo ViewHelper::render("view/zacetna.php", [
           "artikli" => ItemDB::getAll() 
        ]);
    }
    
    public static function indexInactive() {
        echo ViewHelper::render("view/neaktivirani-artikli.php", [
           "artikli" => ItemDB::getAllInactive() 
        ]);
    }
    
    #public static function addForm($values = [
    #    "ime_artikla" => "",
    #    "cena" => "",
    #    "opis_artikla" => ""
    #]) {
    #    echo ViewHelper::render("view/dodaj-artikel.php", $values);
    #}

    public static function add() {
        $form = new ItemsInsertForm("add_form");

        if ($form->validate()) {
            $id = ItemDB::insert($form->getValue());
            
            EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 7,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
            
            ViewHelper::redirect(BASE_URL . "artikli/" . $id);
        } else {
            echo ViewHelper::render("view/artikel-form.php", [
                "title" => "Dodaj artikel",
                "form" => $form
            ]);
        }
    }
    
    public static function get($id) {
        echo ViewHelper::render("view/pregled-artikla-kupec.php", ItemDB::get(["id_artikla" => $id]));
    }
    
    
    public static function edit() {
        
        $editForm = new ItemsEditForm("edit_form");

        if ($editForm->isSubmitted()) {
            if ($editForm->validate()) {
                $data = $editForm->getValue();
                ItemDB::update($data);
                
                EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 8,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
                
                ViewHelper::redirect(BASE_URL . "artikli/" . $data["id_artikla"]);
            } else {
                echo ViewHelper::render("view/artikel-form.php", [
                    "title" => "Uredi artikel",
                    "form" => $editForm
                ]);
            }
        }
    }
    
    public static function editForm($params) {
        $artikel = ItemDB::get(["id_artikla" => $params]);
        $editForm = new ItemsEditForm("edit_form");
        
        $dataSource = new HTML_QuickForm2_DataSource_Array($artikel);
        
        $editForm->addDataSource($dataSource);
        
        echo ViewHelper::render("view/artikel-form.php", [
                    "title" => "Uredi artikel",
                    "form" => $editForm
  
        ]);
    }
    

    
    #public static function delete($id) {
    #    $data = filter_input_array(INPUT_POST, [
    #        'delete_confirmation' => FILTER_REQUIRE_SCALAR
    #    ]);
    #    var_dump($data);

    #       if (self::checkValues($data)) {
    #       ItemDB::delete(["id_artikla" => $id]);
    #        $url = BASE_URL . "artikli";
    #    } else {
    #        $url = BASE_URL . "artikli/uredi/" . $id;
    #    }

    #       ViewHelper::redirect($url);
    #}
    
    
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
    */
    /**
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