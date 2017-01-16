<?php

session_start();

require_once("controller/ItemController.php");
require_once("controller/UserController.php");
require_once("controller/EmployeeController.php");
require_once("controller/ItemRESTController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "/static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "/static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    #ANONIMNI UPORABNIKI
    "/^artikli\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            ItemController::index();
            
        } else {
            ItemController::get($id);
        }
    },                
            
    "/^verifyReg.*/" => function () { 
   
     UserController::activate();
        
    },
            
    "/^stranke\/vpis\/?(\d+)?$/" => function () {      
        UserController::login();
        
    },

    "/^zaposlenci\/vpis\/?(\d+)?$/" => function () {      
        EmployeeController::login();
        
    },
            
    "/^stranke\/registracija\/?(\d+)?$/" => function () {
        UserController::add();
    },             
            
    #STRANKE - preveri če je nastavljen user_level za prodajalca ali pa ce je nastavljen user_id in se ujema s trenutnim v session
    "/^stranke\/uredi\/(\d+)$/" => function ($method, $id) {
        if((isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0) || (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $id)){
            if ($method == "POST") {
                UserController::edit($id);
            } else {
                UserController::editForm($id);
            }
        } else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
            
            
    #PRODAJALCI - za vse naslove gleda če je nastavljen user_level na prodajalca
    "/^artikli\/uredi\/(\d+)$/" => function ($method, $id) {
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){
            if ($method == "POST") {
                ItemController::edit($id);
            } else {
                ItemController::editForm($id);
            }
        }else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
            
            "/^artikli\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            ItemController::index();
            
        } else {
            ItemController::get($id);
        }
    },
            
    "/^artikli\/neaktivni\/?(\d+)?$/" => function ($method, $id = null) {
        if($id == null && isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){
            ItemController::indexInactive();
        }else {
            ItemController::get($id);
        }
    },
            
    "/^artikli\/dodaj/" => function () {
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){
            ItemController::add();
        }else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
              
            
    "/^stranke\/?(\d+)?$/" => function ($method, $id = null) {
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){
            if ($id == null) {
                UserController::index();
            } else {
                UserController::get($id);
            }
        }else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
            
    
    #ADMINI - preveri ce je nastavljen user_level in je enak 1(admin)
    "/^zaposlenci\/registracija\/?(\d+)?$/" => function () {
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 1){
            EmployeeController::add();
        } else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
            
    "/^zaposlenci\/?(\d+)?$/" => function ($method, $id = null) {
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 1){
            if ($id == null) {
                EmployeeController::index();
            } else {
                EmployeeController::get($id);
            }
        } else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },                      
    
    #Admini lahko urejajo podatke vseh in vsak zaposleni zase
    "/^zaposlenci\/uredi\/(\d+)$/" => function ($method, $id) {
        if(isset($_SESSION["user_level"]) && ($_SESSION["user_id"] == $id || $_SESSION["user_level"] == 1)){            
            if ($method == "POST") {
                EmployeeController::edit($id);
            } else {
                EmployeeController::editForm($id);
            }
        } else {
            ViewHelper::redirect(BASE_URL . "artikli");
        }
    },
           
      
    #VSI REGISTRIRANI
    "/^izpis\/?(\d+)?$/" => function () {
        UserController::logout();
    },
    
    # REST API
    "/^api\/artikli\/(\d+)$/" => function ($method, $id) {
        ItemRESTController::get($id);
    },
            
    "/^api\/artikli$/" => function ($method, $id = null) {
        ItemRESTController::index();
    },
            
    
    #DEFAULT
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "artikli");
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}
