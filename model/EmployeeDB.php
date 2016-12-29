<?php

require_once 'model/AbstractDB.php';

class EmployeeDB extends AbstractDB {
    
   #getAll vrne samo aktivirane artikle (pogled za kupce) IZBRIŠI OR artikel_aktiviran = 2 (sam za test)
    public static function getAll() {
        return parent::query("SELECT email_zaposlenca, ime_zaposlenca, priimek_zaposlenca, geslo_zaposlenca, id_zaposlenca, je_admin, zaposlenec_aktiviran"
                        . " FROM zaposlenec"
                        . " ORDER BY id_zaposlenca ASC");
    }
    
    
    
    public static function insert(array $params) {
        
        $params = self::hashPassword($params);
        
        return parent::modify("INSERT INTO zaposlenec (email_zaposlenca, ime_zaposlenca, priimek_zaposlenca, geslo_zaposlenca) "
                        . " VALUES (:email_zaposlenca, :ime_zaposlenca, :priimek_zaposlenca, :geslo_zaposlenca)", $params);
    }
    
    public static function hashPassword(array $params) {
        #echo("<script>console.log('PHP: ".json_encode($params)."');</script>");
        #za hashiranje gesla - preverjanje se izvaja s funkcijo password_verify($password, $hash)
        $geslo = $params["geslo_zaposlenca"];
        $hash = password_hash($geslo, PASSWORD_DEFAULT);
        $params["geslo_zaposlenca"] = $hash;
        return $params;
    }
    
    
    public static function update(array $params) {
        
        $params = self::hashPassword($params);
        
        return parent::modify("UPDATE zaposlenec SET ime_zaposlenca = :ime_zaposlenca, priimek_zaposlenca = :priimek_zaposlenca, "
                        . "geslo_zaposlenca = :geslo_zaposlenca, zaposlenec_aktiviran = :zaposlenec_aktiviran"
                        . " WHERE id_zaposlenca = :id_zaposlenca", $params);
    }

    public static function get(array $id) {
        
        $zaposlenca = parent::query("SELECT email_zaposlenca, ime_zaposlenca, priimek_zaposlenca, geslo_zaposlenca, id_zaposlenca, je_admin, zaposlenec_aktiviran"
                        . " FROM zaposlenec"
                        . " WHERE id_zaposlenca = :id_zaposlenca", $id);
        if (count($zaposlenca) == 1) {
            return $zaposlenca[0];
        } else {
            throw new InvalidArgumentException("Zaposlenec ne obstaja!");
        }
    } 
    
}