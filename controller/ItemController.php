<?php
#zblj1
require_once("ViewHelper.php");
require_once("model/ItemDB.php");

class ItemController {
    
    public static function index() {
        echo ViewHelper::render("view/item-list.php", [
           "items" => ItemDB::getAll() 
        ]);
    }
            
 
}