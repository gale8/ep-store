<?php

require_once("ViewHelper.php");
require_once("model/EmployeeDB.php");
require_once("forms/EmployeesForm.php");
require_once("forms/LoginFormAdmin.php");
require_once("forms/NarociloForm.php");

class NarociloController {
        public static function edit() {
        
        $narociloForm = new NarociloEditForm("narocilo_form");

        if ($narociloForm->isSubmitted()) {
            if ($narociloForm->validate()) {
                $data = $narociloForm->getValue();
                NarociloDB::update($data);
                
                EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 8,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
                
                ViewHelper::redirect(BASE_URL . "artikli/" . $data["id_artikla"]);
            } else {
                echo ViewHelper::render("view/aktivacija-narocila-uredi.php", [
                    "title" => "Uredi status naročila",
                    "form" => $narociloForm,
                    
                ]);
            }
        }
    }
        //edit form za izpis in urejanje narocilo
    // Nepotrjeno = 0
    // // Potrjeno = 1
    // Preklicano = 2
    //Stornirano = 3
    public static function narociloForm($id) {
        $narocilo = NarociloDB::izpisiStatusNarocila(["id_narocila" => $id])[0];
        
        $narociloForm = new NarociloEditForm("narocilo_form");
        if($narocilo["narocilo_potrjeno"] == 1) {
            $status = 1;
        }
        if($narocilo["narocilo_preklicano"] == 1){
            $status = 2;
        }
        if($narocilo["narocilo_stornirano"] == 1) {
            $status = 3;
        }
        else {
            $status = 0;
        }
        $new_ar = array("status" => $status);
        $narocilo = array_merge($narocilo,$new_ar);
        
        $dataSource = new HTML_QuickForm2_DataSource_Array($narocilo);
        $narociloForm->addDataSource($dataSource);
        
        echo ViewHelper::render("view/aktivacija-narocila-uredi.php", ["title" => "Uredi status naročila", "form" => $narociloForm, "narocilo"=>$narocilo, "status" => $status]);
    }
    
        //za izpis vseh narocila prodajalca, da jih lahko ureja
    public static function urediNarocila() {
        echo ViewHelper::render("view/aktivacija-narocila.php", ["title" => "Uredi naročila", "narocila" => NarociloDB::getAllIzpisNarocil()]);
    }
    
}