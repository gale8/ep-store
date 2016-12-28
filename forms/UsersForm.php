<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';

abstract class UsersAbstractForm extends HTML_QuickForm2 {

    public $email_stranke;
    public $ime_stranke;
    public $priimek_stranke;
    public $geslo_stranke;
    public $naslov_stevilka;
    public $id_poste;
    #public $tel_st_stranke;
    public $stranka_aktivirana;
    public $button;

    public function __construct($id_stranke) {
        parent::__construct($id_stranke);

        $this->email_stranke = new HTML_QuickForm2_Element_InputText('email_stranke');
        $this->email_stranke->setAttribute('size', 45);
        $this->email_stranke->setLabel('Elektronski naslov:');
        $this->email_stranke->addRule('maxlength', 'Email je predolg (do 45 znakov).', 45);
        $this->email_stranke->addRule('required', 'Vpišite email.');
        $this->email_stranke->addRule('regex', 'Email ni veljaven.', '/^[a-z]+[@][a-z]+[.]+[a-z]+$/');
        $this->addElement($this->email_stranke);

        $this->ime_stranke = new HTML_QuickForm2_Element_InputText('ime_stranke');
        $this->ime_stranke->setAttribute('size', 45);
        $this->ime_stranke->addRule('maxlength', 'Ime je predolgo (do 45 znakov).', 45);
        $this->ime_stranke->setLabel('Ime');
        $this->ime_stranke->addRule('required', 'Vpišite ime.');
        $this->ime_stranke->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->ime_stranke);
        
        $this->priimek_stranke = new HTML_QuickForm2_Element_InputText('priimek_stranke');
        $this->priimek_stranke->setAttribute('size', 45);
        $this->priimek_stranke->addRule('maxlength', 'Priimek je predolg (do 45 znakov).', 45);
        $this->priimek_stranke->setLabel('Priimek');
        $this->priimek_stranke->addRule('required', 'Vpišite priimek.');
        $this->priimek_stranke->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->priimek_stranke);
        
        $this->naslov_stevilka = new HTML_QuickForm2_Element_InputText('naslov_stevilka');
        $this->naslov_stevilka->setAttribute('size', 45);
        $this->naslov_stevilka->addRule('maxlength', 'Naslov je predolg (do 45 znakov).', 45);
        $this->naslov_stevilka->setLabel('Naslov');
        $this->naslov_stevilka->addRule('required', 'Vpišite naslov.');
        $this->naslov_stevilka->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->naslov_stevilka);
        
        $this->geslo_stranke = new HTML_QuickForm2_Element_InputText('geslo_stranke');
        $this->geslo_stranke->setAttribute('size', 45);
        $this->geslo_stranke->addRule('maxlength', 'Geslo je predolgo (do 45 znakov).', 45);
        $this->geslo_stranke->setLabel('Geslo');
        $this->geslo_stranke->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->geslo_stranke->addRule('required', 'Vpišite geslo.');
        $this->addElement($this->geslo_stranke);
        
        /*
        $this->tel_st_stranke = new HTML_QuickForm2_Element_InputText('tel_st_stranke');
        $this->tel_st_stranke->setAttribute('size', 30);
        $this->tel_st_stranke->addRule('maxlength', 'Opis je predolg (do 45 znakov).', 45);
        $this->tel_st_stranke->setLabel('Tel_st');
        $this->tel_st_stranke->addRule('required', 'Vpišite opis artikla.');
        $this->addElement($this->tel_st_stranke);
        */
        
        $this->id_poste = new HTML_QuickForm2_Element_InputText('id_poste');
        $this->id_poste->setAttribute('size', 4);
        $this->id_poste->setLabel('Vpišite id poste');
        $this->id_poste->addRule('required', 'Vpišite id poste.');
        $this->id_poste->addRule('callback', 'Vpišite številčno vrednost.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_INT]
                )
        );
        $this->addElement($this->id_poste);
        
        $this->stranka_aktivirana = new HTML_QuickForm2_Element_InputText('stranka_aktivirana');
        $this->stranka_aktivirana->setAttribute('size', 1);
        $this->stranka_aktivirana->setLabel('Aktiviram profil? (1:aktiviran  0:neaktiviran)');
        $this->stranka_aktivirana->addRule('required', 'Vpišite 0 ali 1.');
        $this->stranka_aktivirana->addRule('gte', 'Številka mora biti => 0.', 0);
        $this->stranka_aktivirana->addRule('lte', 'Številka mora biti <=1.', 1);
        $this->stranka_aktivirana->addRule('callback', 'Vpišite številčno vrednost.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_INT]
                )
        );
        $this->addElement($this->stranka_aktivirana);
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class UsersInsertForm extends UsersAbstractForm {
    public function __construct($id_stranke) {
        parent::__construct($id_stranke);

        $this->button->setAttribute('value', 'Registriraj se');
    }

}

class UsersEditForm extends UsersAbstractForm {
    public $id_artikla;

    public function __construct($id_artikla) {
        parent::__construct($id_artikla);

        $this->button->setAttribute('value', 'Uredi artikel');
        $this->id_artikla = new HTML_QuickForm2_Element_InputHidden("id_artikla");
        $this->addElement($this->id_artikla);
    }
}

