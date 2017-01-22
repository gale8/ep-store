<?php

require_once("ViewHelper.php");
require_once("model/NarociloDB.php");
require_once("forms/NarociloForm.php");

class NarociloController {
        public static function edit($id) {
       
        $narociloForm = new NarociloEditForm("narocilo_form");

        if ($narociloForm->isSubmitted()) {
            if ($narociloForm->validate()) {
                $data = $narociloForm->getValue();
                if($data["status"] == 1 ){
                    $narocilo_potrjeno = 1;
                    $narocilo_preklicano = 0;
                    $narocilo_stornirano = 0;
                }
                elseif($data["status"] == 2 ){
                    $narocilo_potrjeno = 0;
                    $narocilo_preklicano = 1;
                    $narocilo_stornirano = 0;
                }
                elseif($data["status"] == 3 ){
                    $narocilo_potrjeno = 0;
                    $narocilo_preklicano = 0;
                    $narocilo_stornirano = 1;
                }
                
                $ar = array("potrjeno"=>$narocilo_potrjeno,"preklicano"=>$narocilo_preklicano,"stornirano"=>$narocilo_stornirano, "id_narocila"=>$id);
                
                NarociloDB::update($ar);
               
                EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 8,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
                
                ViewHelper::redirect(BASE_URL . "narocila");
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
            $narocilo['status'] = 1;
        }
        if($narocilo["narocilo_preklicano"] == 1){
            $narocilo['status'] = 2;
        }
        if($narocilo["narocilo_stornirano"] == 1) {
            $narocilo['status'] = 3;
        }
        else {
            $narocilo['status'] = 0;
        }
        
        
        $dataSource = new HTML_QuickForm2_DataSource_Array($narocilo);
        $narociloForm->addDataSource($dataSource);
        
        echo ViewHelper::render("view/aktivacija-narocila-uredi.php", [
                                    "title" => "Uredi status naročila", 
                                    "form" => $narociloForm
        ]);
        
    }
    
        //za izpis vseh narocila prodajalca, da jih lahko ureja
    public static function urediNarocila() {
        echo ViewHelper::render("view/aktivacija-narocila.php", ["title" => "Uredi naročila", "narocila" => NarociloDB::getAllIzpisNarocil()]);
    }
    
}
        
