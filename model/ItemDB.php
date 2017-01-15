<?php

require_once 'model/AbstractDB.php';

class ItemDB extends AbstractDB {
    
    
    #getAll vrne samo aktivirane artikle (pogled za kupce) IZBRIŠI OR artikel_aktiviran = 2 (sam za test)
    public static function getAll() {
        return parent::query("SELECT id_artikla, ime_artikla, cena, opis_artikla, artikel_aktiviran"
                        . " FROM artikel"
                        . " WHERE artikel_aktiviran = 1 OR artikel_aktiviran = 0"
                        . " ORDER BY id_artikla ASC");
    }
    
    
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO artikel (ime_artikla, cena, opis_artikla, artikel_aktiviran) "
                        . " VALUES (:ime_artikla, :cena, :opis_artikla, :artikel_aktiviran)", $params);
    }
    
    
    public static function update(array $params) {
        return parent::modify("UPDATE artikel SET ime_artikla = :ime_artikla, cena = :cena, "
                        . "opis_artikla = :opis_artikla, artikel_aktiviran = :artikel_aktiviran"
                        . " WHERE id_artikla = :id_artikla", $params);
    }

    public static function get(array $id) {
        $artikli = parent::query("SELECT id_artikla, ime_artikla, cena, opis_artikla, artikel_aktiviran"
                        . " FROM artikel"
                        . " WHERE id_artikla = :id_artikla", $id);
        if (count($artikli) == 1) {
            return $artikli[0];
        } else {
            throw new InvalidArgumentException("Ni tega artikla!");
        }
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id_artikla, ime_artikla, cena, opis_artikla, "
                        . "          CONCAT(:prefix, id_artikla) as uri "
                        . "FROM artikel "
                        . "WHERE artikel_aktiviran = 1 "
                        . "ORDER BY id_artikla ASC", $prefix);
    }
    
}

