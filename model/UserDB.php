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
        
        $to = $params["email_stranke"];
        $subject = "Potrditveni mail";
        $message = "Za uspešno registracijo prosimo sledite povezavi: https://localhost/netbeans/ep-store/verifyReg.php?mail=".$to."&hash=".$params["mailHash_stranke"];
        $header = "From: noreply@eptrgovina.com";                    
        
        parent::modify("INSERT INTO stranka (email_stranke, mailHash_stranke, ime_stranke, priimek_stranke, geslo_stranke, naslov_stevilka, id_poste, stranka_aktivirana, tel_st) "
                        . " VALUES (:email_stranke, :mailHash_stranke, :ime_stranke, :priimek_stranke, :geslo_stranke, :naslov_stevilka, :id_poste, :stranka_aktivirana, :tel_st)", $params);
    
        mail($to, $subject, $message, $header);
    }
    
    public static function hashPassword(array $params) {
        
        $mailHash = md5( rand(0,1000) );                
        $geslo = $params["geslo_stranke"];
        $hash = password_hash($geslo, PASSWORD_DEFAULT);
        $params["geslo_stranke"] = $hash;
        $params["mailHash_stranke"] = $mailHash;
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
        
        $err = 'Vpisani podatki se ne ujemajo ali pa še niste aktivirani.';
        
        $stranke = parent::query("SELECT ime_stranke, email_stranke, geslo_stranke, stranka_aktivirana, id_stranke"
                        . " FROM stranka"
                        . " WHERE email_stranke = :email_stranke", $params);        
        
        if (count($stranke) == 1) {
            $data = $stranke[0];

            if(password_verify($params['geslo_stranke'], $data['geslo_stranke']) && $data['stranka_aktivirana'] == 1){
                $_SESSION["user_id"] = $data['id_stranke'];
                $_SESSION["ime"] = $data['ime_stranke'];
            } else {
                echo $err;
            }
            
        } else {            
            echo $err;
        }
    }
    
    public static function exists(array $params){        
        $obstaja = false;
        
        $stranka = parent::query("SELECT email_stranke, geslo_stranke, stranka_aktivirana, id_stranke"
                        . " FROM stranka"
                        . " WHERE email_stranke = :email_stranke", $params); 
        
        if (count($stranka) != 0) {
            $obstaja = true;
        }      
        return $obstaja;        
    }
    
    public static function activate(){
        $msg= "Napačni podatki ali pa je račun že bil aktiviran";
        $msg2= "Neveljaven dostop. Prosimo uporabite mail, ki ste ga prejeli po E-mailu.";
        $params;
        
        if(isset($_GET['mail']) && !empty($_GET['mail']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
            $params = array("mail" => $_GET['mail'], "hash" => $_GET['hash']);            
        }  else {
            return $msg2;
        }
        
        $stranka = parent::query("SELECT email_stranke, mailHash_stranke, mailHash_porabljen, stranka_aktivirana"
                        . " FROM stranka"
                        . " WHERE email_stranke = :mail AND mailHash_stranke = :hash AND mailHash_porabljen = 0 AND stranka_aktivirana = 0", $params);
        
        if (count($stranka) == 1) {
            parent::modify("UPDATE stranka SET stranka_aktivirana = 1, mailHash_porabljen = 1"                        
                        . " WHERE email_stranke = :mail AND mailHash_stranke = :hash", $params);
            $msg = "Račun uspešno aktiviran";
        }
            return $msg;
                
    }
    
}