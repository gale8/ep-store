<?php

/**
 * Razred Knjiga
 */
class Artikel {

    /**
     * Naslov knjige
     * @var type String
     */
    public $ime_artikla = null;

    /**
     * Avtor knjige
     * @var type String
     */
    

    /**
     * Identifikator knjige
     * @var type int
     */
    public $id_artikla = 0;

    /**
     * Cena knjige
     * @var type Double
     */
    public $cena = 0;

    /**
     * Kreira novo instanco s podanim naslovom, avtorjem, 
     * identifikatorjem in ceno.
     * @param type $naslov
     * @param type $avtor
     * @param type $id
     * @param type $cena 
     */
    public function __construct($id_artikla, $ime_artikla, $cena) {
        $this->id_artikla = $id_artikla;
        $this->ime_artikla = $ime_artikla;
        $this->cena = $cena;
    }

    /**
     * Vrne predstavitev knige v nizu.
     * @return type String
     */
    public function __toString() {
        return $this->ime_artikla . ' ('
                . number_format($this->cena, 2, ',', '.') . ' €)';
    }

}
