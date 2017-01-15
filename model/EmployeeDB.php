<?php

require_once 'model/AbstractDB.php';

class EmployeeDB extends AbstractDB {
    
   #getAll vrne samo aktivirane artikle (pogled za kupce) IZBRIŠI OR artikel_aktiviran = 2 (sam za test)
    public static function getAll() {
        return parent::query("SELECT email_zaposlenca, ime_zaposlenca, priimek_zaposlenca, geslo_zaposlenca, id_zaposlenca, je_admin, zaposlenec_aktiviran"
                        . " FROM zaposlenec"
                        . " WHERE je_admin = 0"
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
    
        public static function certData() {
            $user = 'null';
                        
            #echo("<script>console.log('PHP1: ".json_encode($user)."');</script>");
            
            $authorized_users = ["Osebje", "Administrator", "Prodajalec"];
            $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_S_DN_CN");

            if ($client_cert == null) {                
                return $user;
            }
            
            if (in_array($client_cert, $authorized_users)) {
                $user = filter_input(INPUT_SERVER, "SSL_CLIENT_S_DN_Email");
                return $user;
            } else {
                return $user;
            }
                        
    }
    
        public static function login(array $params) { 
            
        $err = 'Vpisani podatki se ne ujemajo ali pa še niste aktivirani.';
        $stranke = parent::query("SELECT ime_zaposlenca, email_zaposlenca, geslo_zaposlenca, zaposlenec_aktiviran, id_zaposlenca, je_admin"
                        . " FROM zaposlenec"
                        . " WHERE email_zaposlenca = :email_zaposlenca", $params);        
        
        if (count($stranke) == 1) {
            $data = $stranke[0];

            if(password_verify($params['geslo_zaposlenca'], $data['geslo_zaposlenca']) && $data['zaposlenec_aktiviran'] == 1){
                $_SESSION["user_id"] = $data['id_zaposlenca'];
                $_SESSION["ime"] = $data['ime_zaposlenca'];
                $_SESSION["user_level"] = $data['je_admin'];
            } else {
                echo $err;
            }
            
        } else {            
            echo $err;
        }
    }
    
    public static function exists(array $params){
        $obstaja = false;
        
        $zaposlenec = parent::query("SELECT email_zaposlenca, geslo_zaposlenca, zaposlenec_aktiviran, id_zaposlenca"
                        . " FROM zaposlenec"
                        . " WHERE email_zaposlenca = :email_zaposlenca", $params); 
        
        if (count($zaposlenec) != 0) {
            $obstaja = true;
        }
        echo "Zaposlenec s tem e-naslovom že obstaja!";
        return $obstaja;
        
    }
    
}