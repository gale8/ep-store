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
            $data = $form->getValue();
            if(!EmployeeDB::exists($data)) {
                $id = EmployeeDB::insert($data);
                
                EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 3,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
                
                ViewHelper::redirect(BASE_URL . "zaposlenci/" . $id);
            } else {
                echo ViewHelper::render("view/employee-form.php", [
                    "title" => "Registracija prodajalca",
                    "form" => $form
                ]);
        }
            
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
                    if((isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $data["id_zaposlenca"]) || (isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 1 )){
                        
                        EmployeeDB::update($data);
                        
                        EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 5,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
                                                
                        ViewHelper::redirect(BASE_URL . "zaposlenci/" . $data["id_zaposlenca"]);
                    } else {
                        echo ViewHelper::render("view/employee-form.php", [
                        "title" => "Urejanje profila prodajalca",
                        "form" => $editForm
                        ]);
                    }

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
        #izbriše vrednost hashanega gesla, da se ta ne doda v form
        unset($zaposlenec["geslo_zaposlenca"]);
        $editForm = new EmployeesEditForm("edit_form");
        echo("<script>console.log('PHP: ".json_encode($zaposlenec)."');</script>");
        
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
            if(isset($_SESSION['user_level'])){
                EmployeeDB::dnevnik(["timestamp" => date('Y-m-d H:i:s', time()),
                        "dnevnik_id_aktivnosti" => 1,
                        "dnevnik_id_zaposlenca" => $_SESSION["user_id"]
                        ]);
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
    
    //za izpis vseh narocila prodajalca, da jih lahko ureja
    public static function urediNarocila() {
        echo ViewHelper::render("view/aktivacija-narocila.php", ["title" => "Uredi naročila"]);
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
