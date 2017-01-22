<?php

require_once("ViewHelper.php");
require_once("model/EmployeeDB.php");
require_once("forms/EmployeesForm.php");
require_once("forms/LoginFormAdmin.php");
require_once("forms/NarociloForm.php");

class NarociloController {
        //edit form za izpis in urejanje narocilo
    // Potrjeno = 0
    // Preklicano = 1
    //Stornirano = 2
    public static function narociloForm($id) {
        $narocilo = NarociloDB::izpisiStatusNarocila(["id_narocila" => $id]);
        $narociloForm = new NarociloEditForm("narocilo_form");
        if($narocilo["narocilo_potrjeno"] == 1) {
            $status = 0;
        }
        if($narocilo["narocilo_preklicano"] == 1){
            $status = 1;
        }
        if($narocilo["narocilo_stornirano"] == 1) {
            $status = 2;
        }
        
        $dataSource = new HTML_QuickForm2_DataSource_Array([$status]);
        $narociloForm->addDataSource($dataSouce);
        
        echo ViewHelper::render("view/aktivacija-narocila-uredi.php", ["title" => "Uredi status naročila", "form" => $narociloForm]);
    }
    
        //za izpis vseh narocila prodajalca, da jih lahko ureja
    public static function urediNarocila() {
        echo ViewHelper::render("view/aktivacija-narocila.php", ["title" => "Uredi naročila", "narocila" => NarociloDB::getAllIzpisNarocil()]);
    }
    
}