<?php

require_once 'model/AbstractDB.php';

class UserDB extends AbstractDB {
    
   #getAll vrne samo aktivirane artikle (pogled za kupce) IZBRIŠI OR artikel_aktiviran = 2 (sam za test)
    public static function getAll() {
        return parent::query("SELECT email_stranke, ime_stranke, priimek_stranke, geslo_stranke, stranka_aktivirana, id_stranke, naslov_stevilka, id_poste, tel_st"
                        . " FROM stranka"
                        . " ORDER BY id_stranke ASC");
    }
    
    
    
    public static function insert(array $params) {
        
        $params = self::hashPassword($params);
        
        return parent::modify("INSERT INTO stranka (email_stranke, ime_stranke, priimek_stranke, geslo_stranke, naslov_stevilka, id_poste, stranka_aktivirana, tel_st) "
                        . " VALUES (:email_stranke, :ime_stranke, :priimek_stranke, :geslo_stranke, :naslov_stevilka, :id_poste, :stranka_aktivirana, :tel_st)", $params);
    }
    
    public static function hashPassword(array $params) {
        #echo("<script>console.log('PHP: ".json_encode($params)."');</script>");
        #za hashiranje gesla - preverjanje se izvaja s funkcijo password_verify($password, $hash)
        $geslo = $params["geslo_stranke"];
        $hash = password_hash($geslo, PASSWORD_DEFAULT);
        $params["geslo_stranke"] = $hash;
        return $params;
    }
    
    
    public static function update(array $params) {
        
        $params = self::hashPassword($params);
        
        return parent::modify("UPDATE stranka SET ime_stranke = :ime_stranke, priimek_stranke = :priimek_stranke, "
                        . "geslo_stranke = :geslo_stranke, naslov_stevilka = :naslov_stevilka, id_poste = :id_poste, "
                        . "stranka_aktivirana = :stranka_aktivirana, tel_st = :tel_st"
                        . " WHERE id_stranke = :id_stranke", $params);
    }


    public static function get(array $id) {
        
        $stranke = parent::query("SELECT email_stranke, ime_stranke, priimek_stranke, geslo_stranke, stranka_aktivirana, id_stranke, naslov_stevilka, id_poste, tel_st"
                        . " FROM stranka"
                        . " WHERE id_stranke = :id_stranke", $id);
        if (count($stranke) == 1) {
            return $stranke[0];
        } else {
            throw new InvalidArgumentException("Stranka ne obstaja!");
        }
    } 
    
        public static function login(array $params) {                    
        
        $stranke = parent::query("SELECT email_stranke, geslo_stranke, stranka_aktivirana, id_stranke"
                        . " FROM stranka"
                        . " WHERE email_stranke = :email_stranke", $params);        
        
        if (count($stranke) == 1) {
            $data = $stranke[0];
            if(password_verify($params['geslo_stranke'], $data['geslo_stranke']) && $data['stranka_aktivirana'] == 1){
                $_SESSION["user_id"] = $data['id_stranke'];
            } else {
                echo 'Se ne ujema';
            }
            
        } else {
            throw new InvalidArgumentException("Stranka ne obstaja!");
        }
    } 
    
}