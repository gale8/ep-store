<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/Select.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';
require_once 'HTML/QuickForm2/Element/InputPassword.php';


abstract class EmployeesAbstractForm extends HTML_QuickForm2 {

    public $email_zaposlenca;
    public $ime_zaposlenca;
    public $priimek_zaposlenca;
    public $geslo_zaposlenca;
    public $geslo_zaposlenca2;
    public $zaposlenec_aktiviran;
    public $je_admin;
    public $button;

    public function __construct($id_zaposlenca) {
        parent::__construct($id_zaposlenca);

        
        $this->ime_zaposlenca = new HTML_QuickForm2_Element_InputText('ime_zaposlenca');
        $this->ime_zaposlenca->setAttribute('size', 45);
        $this->ime_zaposlenca->addRule('maxlength', 'Ime je predolgo (do 45 znakov).', 45);
        $this->ime_zaposlenca->setLabel('Ime');
        $this->ime_zaposlenca->addRule('required', 'Vpišite ime.');
        $this->ime_zaposlenca->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->ime_zaposlenca);
        
        $this->priimek_zaposlenca = new HTML_QuickForm2_Element_InputText('priimek_zaposlenca');
        $this->priimek_zaposlenca->setAttribute('size', 45);
        $this->priimek_zaposlenca->addRule('maxlength', 'Priimek je predolg (do 45 znakov).', 45);
        $this->priimek_zaposlenca->setLabel('Priimek');
        $this->priimek_zaposlenca->addRule('required', 'Vpišite priimek.');
        $this->priimek_zaposlenca->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->priimek_zaposlenca);

        $this->email_zaposlenca = new HTML_QuickForm2_Element_InputText('email_zaposlenca');
        $this->email_zaposlenca->setAttribute('size', 45);
        $this->email_zaposlenca->setLabel('Elektronski naslov:');
        $this->email_zaposlenca->addRule('maxlength', 'Email je predolg (do 45 znakov).', 45);
        $this->email_zaposlenca->addRule('required', 'Vpišite email.');
        $this->email_zaposlenca->addRule('callback', 'Vnesite veljaven elektronski naslov.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_EMAIL])
        );
        $this->addElement($this->email_zaposlenca);
        
        $this->geslo_zaposlenca = new HTML_QuickForm2_Element_InputPassword('geslo_zaposlenca');
        $this->geslo_zaposlenca->setAttribute('size', 15);
        $this->geslo_zaposlenca->setLabel('Vnesite geslo:');
        $this->geslo_zaposlenca->addRule('maxlength', 'Geslo je predolgo (do 45 znakov).', 45);
        $this->geslo_zaposlenca->addRule('required', 'Vnesite geslo.');
        $this->geslo_zaposlenca->addRule('minlength', 'Geslo naj vsebuje vsaj 6 znakov.', 6);
        $this->geslo_zaposlenca->addRule('regex', 'V geslu uporabite vsaj 1 številko.', '/[0-9]+/');
        $this->geslo_zaposlenca->addRule('regex', 'V geslu uporabite vsaj 1 veliko črko.', '/[A-Z]+/');
        $this->geslo_zaposlenca->addRule('regex', 'V geslu uporabite vsaj 1 malo črko.', '/[a-z]+/');
        $this->addElement($this->geslo_zaposlenca);
        
        $this->geslo_zaposlenca2 = new HTML_QuickForm2_Element_InputPassword('geslo_zaposlenca2');
        $this->geslo_zaposlenca2->setLabel('Ponovite geslo:');
        $this->geslo_zaposlenca2->setAttribute('size', 15);
        $this->geslo_zaposlenca2->addRule('required', 'Ponovno vpišite izbrano geslo.');
        $this->geslo_zaposlenca2->addRule('eq', 'Gesli nista enaki.', $this->geslo_zaposlenca);
        $this->addElement($this->geslo_zaposlenca2);
       


            $this->zaposlenec_aktiviran = new HTML_QuickForm2_Element_InputText('zaposlenec_aktiviran');
            $this->zaposlenec_aktiviran->setAttribute('size', 1);                        
            $this->zaposlenec_aktiviran->addRule('gte', 'Številka mora biti => 0.', 0);
            $this->zaposlenec_aktiviran->addRule('lte', 'Številka mora biti <=1.', 1);
            $this->zaposlenec_aktiviran->addRule('regex', 'Samo 0 ali 1!', '/^(0|1)$/');
        
//        Onemogoci zaposlenemu aktivacijo profila na strani za urejanje            
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 1){   
            $this->zaposlenec_aktiviran->setLabel('Status profila (1:aktiviran  0:neaktiviran)');
            $this->zaposlenec_aktiviran->addRule('required', 'Vpišite 0 ali 1.');
//          Ce lahko ureja profil je aktiviran  
        } else {            
            $this->zaposlenec_aktiviran->setAttribute('hidden');
            $this->zaposlenec_aktiviran->setAttribute('value', "1");           
        }
        $this->addElement($this->zaposlenec_aktiviran);
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class EmployeesInsertForm extends EmployeesAbstractForm {
    public function __construct($id_zaposlenca) {
        parent::__construct($id_zaposlenca);

        $this->button->setAttribute('value', 'Registriraj se');
    }

}

class EmployeesEditForm extends EmployeesAbstractForm {
    public $id_zaposlenca;

    public function __construct($id_zaposlenca) {
        parent::__construct($id_zaposlenca);

        $this->button->setAttribute('value', 'Uredi profil');
        $this->id_zaposlenca = new HTML_QuickForm2_Element_InputHidden("id_zaposlenca");
        $this->addElement($this->id_zaposlenca);
    }
}

