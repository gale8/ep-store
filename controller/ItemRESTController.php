<?php

require_once("ViewHelper.php");
require_once("model/ItemDB.php");
require_once("controller/ItemController.php");

class ItemRESTController {
    
    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(ItemDB::get(["id_artikla" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }
    
    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"] . "/";
        echo ViewHelper::renderJSON(ItemDB::getAllwithURI(["prefix" => $prefix]));
    }
 
}
