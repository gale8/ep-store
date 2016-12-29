<?php

session_start();

require_once("controller/ItemController.php");
require_once("controller/UserController.php");
require_once("controller/EmployeeController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "/static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "/static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^artikli\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            ItemController::index();
            
        } else {
            ItemController::get($id);
        }
    },
            
    "/^artikli\/dodaj/" => function () {
        ItemController::add();
    },
            
    "/^artikli\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemController::edit($id);
        } else {
            ItemController::editForm($id);
        }
    },
            
    "/^stranke\/registracija\/?(\d+)?$/" => function () {
        UserController::add();
    },
              
            
    "/^stranke\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            UserController::index();
        } else {
            UserController::get($id);
        }
    },
            
    "/^stranke\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            UserController::edit($id);
        } else {
            UserController::editForm($id);
        }
    },
            
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
            
    "/^zaposlenci\/uredi\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            EmployeeController::edit($id);
        } else {
            EmployeeController::editForm($id);
        }
    },
            
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "artikli");
    }
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
