<?php

require_once("ViewHelper.php");
require_once("model/EmployeeDB.php");
require_once("forms/EmployeesForm.php");
require_once("forms/LoginFormAdmin.php");

class EmployeeController {
    
    public static function index() {
        echo ViewHelper::render("view/vsi-zaposlenci.php", [
           "zaposlenci" => EmployeeDB::getAll() 
        ]);
        #ViewHelper::redirect(BASE_URL . "artikli");
    }

    public static function add() {
        $form = new EmployeesInsertForm("add_form");
        
        if ($form->validate()) {
            $id = EmployeeDB::insert($form->getValue());
            ViewHelper::redirect(BASE_URL . "zaposlenci/" . $id);
        } else {
            echo ViewHelper::render("view/employee-form.php", [
                "title" => "Registracija prodajalca",
                "form" => $form
            ]);
        }
    }
    
    public static function get($id) {
        echo ViewHelper::render("view/zaposlenec-podrobnosti.php", EmployeeDB::get(["id_zaposlenca" => $id]));
    }
    
    
    public static function edit() {
        
        $editForm = new EmployeesEditForm("edit_form");

        if ($editForm->isSubmitted()) {
            if ($editForm->validate()) {
                $data = $editForm->getValue();
                EmployeeDB::update($data);
                ViewHelper::redirect(BASE_URL . "zaposlenci/" . $data["id_zaposlenca"]);
            } else {
                echo ViewHelper::render("view/employee-form.php", [
                    "title" => "Urejanje profila prodajalca",
                    "form" => $editForm
                ]);
            }
        }
    }
    
    public static function editForm($params) {
        $zaposlenec = EmployeeDB::get(["id_zaposlenca" => $params]);
        $editForm = new EmployeesEditForm("edit_form");
        
        $dataSource = new HTML_QuickForm2_DataSource_Array($zaposlenec);
        
        $editForm->addDataSource($dataSource);
        
        echo ViewHelper::render("view/employee-form.php", [
                    "title" => "Urejanje profila zaposlenca",
                    "form" => $editForm
  
        ]);
    }
    
     public static function login() {
         
         if (EmployeeDB::certData() == "null" ){
            ViewHelper::redirect(BASE_URL . "stranke/vpis");    
         }
         
        $form = new LoginInsertFormAdmin("add_form");
        
        if ($form->validate()) {
            $data = $form->getValue();
            EmployeeDB::login($data);
            if(isset($_SESSION['user_id'])){
                ViewHelper::redirect(BASE_URL . "artikli");
            } else {
                echo ViewHelper::render("view/login-form.php", [
                "title" => "Prijava zaposlenca",
                "form" => $form
                ]);            
            }   
                      
        } else {

            echo ViewHelper::render("view/login-form.php", [
                    "title" => "Prijava zaposlenca",
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
