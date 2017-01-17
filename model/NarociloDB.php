<?php

require_once 'model/AbstractDB.php';

class NarociloDB extends AbstractDB {
    
    
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
                        . "ORDER BY id_artikla ASC", $prefix);
    }
    
    
    //Naredil Rok, za iskanje 1 elementa iz objekta Artikel
    public static function getOne($id) {
        foreach (self::narediObjekt() as $artikel) {
            if ($id == $artikel->id_artikla) {
                return $artikel;
            }
        }

        throw new InvalidArgumentException("Artikel z id = $id ne obstaja.");
    }
    
    //kreairanje objekta po katerem bo pole artikel se iskalo v sesnu
    //in nam vrne array vseh artiklov
    public static function narediObjekt() {
        $artikli = array();
        $id = 1;
        foreach(self::getAll() as $artikel) {
            $artikli[$id] = new Artikel($artikel['id_artikla'], $artikel['ime_artikla'], $artikel['cena']);
            $id = $id+1;
        };
        return $artikli;
    }
    //generira novo narocilo
    public static function dodajNarocilo($id_stranke) {
       parent::modify("INSERT INTO narocilo (id_stranke) "
                        . " VALUES ($id_stranke)");
    }
    
    //pridobitev zadnje id_narocila
    public static function getIDnarocila() {
        return parent::query("SELECT id_narocila FROM narocilo ORDER BY id_narocila DESC LIMIT 1");
    }
    
    //za dodajanje posameznega narocila artikla v narocilo_artikel
    //querry gre cez foreach loop
    public static function dodajArtikelNarocilo($id_narocila, $id_artikla, $kolicina) {
        parent::modify("INSERT INTO narocilo_artikel (id_narocila, id_artikla, kolicina) "
                . " VALUES ($id_narocila, $id_artikla, $kolicina)");
    }
    
}

