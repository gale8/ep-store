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
            
    #STRANKE  
    "/^stranke\/registracija\/?(\d+)?$/" => function () {
        UserController::add();
    },
            
    "/^stranke\/vpis\/?(\d+)?$/" => function () {      
        UserController::login();
        
    },
                  
    "/^stranke\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            UserController::edit($id);
        } else {
            UserController::editForm($id);
        }
    },
            
            
    #PRODAJALCI 
    "/^artikli\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemController::edit($id);
        } else {
            ItemController::editForm($id);
        }
    },
            
    "/^artikli\/dodaj/" => function () {
        ItemController::add();
    },
              
            
    "/^stranke\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            UserController::index();
        } else {
            UserController::get($id);
        }
    },
            
    
    #ADMINI 
    "/^zaposlenci\/registracija\/?(\d+)?$/" => function () {
        EmployeeController::add();
    },
            
    "/^zaposlenci\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            EmployeeController::index();
        } else {
            EmployeeController::get($id);
        }
    },
                     

    "/^vpisAdministratorja\/?(\d+)?$/" => function () {      
        EmployeeController::login();
        
    },   
            
    "/^zaposlenci\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            EmployeeController::edit($id);
        } else {
            EmployeeController::editForm($id);
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
