<?php

require_once 'model/AbstractDB.php';

class UserDB extends AbstractDB {
    
   #getAll vrne samo aktivirane artikle (pogled za kupce) IZBRIŠI OR artikel_aktiviran = 2 (sam za test)
    public static function getAll() {
        return parent::query("SELECT email_stranke, id_naslova, ime_stranke, priimek_stranke, geslo_stranke, stranka_aktivirana, id_stranke"
                        . " FROM stranka"
                        . " ORDER BY id_stanke ASC");
    }
    
    
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO stranka (email_stranke, ime_stranke, priimek_stranke, geslo_stranke) "
                        . " VALUES (:email_stranke, :ime_stranke, :priimek_stranke, :geslo_stranke)", $params);
    }
    
    
    public static function update(array $params) {
        return parent::modify("UPDATE artikel SET ime_artikla = :ime_artikla, cena = :cena, "
                        . "opis_artikla = :opis_artikla, artikel_aktiviran = :artikel_aktiviran"
                        . " WHERE id_artikla = :id_artikla", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM artikel WHERE id_artikla = :id_artikla", $id);
    }

    public static function get(array $id) {
        $stranke = parent::query("SELECT email_stranke, id_naslova, ime_stranke, priimek_stranke, geslo_stranke, stranka_aktivirana, id_stranke"
                        . " FROM stranka"
                        . " WHERE id_stranke = :id_stranke", $id);
        if (count($stranke) == 1) {
            return $stranke[0];
        } else {
            throw new InvalidArgumentException("Stranka ne obstaja!");
        }
    } 
    
}