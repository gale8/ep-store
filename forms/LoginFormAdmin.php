<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputPassword.php';
require_once 'model/EmployeeDB.php';

abstract class LoginAbstractFormAdmin extends HTML_QuickForm2 {        

    public $email_stranke;
    public $button;

    public function __construct($id_stranke) {
        $email = EmployeeDB::certData();
        
        parent::__construct($id_stranke);            
        
        $this->email_stranke = new HTML_QuickForm2_Element_InputText('email_zaposlenca');
        $this->email_stranke->setAttribute('readonly');
        $this->email_stranke->setAttribute('value', $email);

        $this->addElement($this->email_stranke);
        
        $this->geslo_stranke = new HTML_QuickForm2_Element_InputPassword('geslo_zaposlenca');       
        $this->geslo_stranke->setLabel('Vnesite geslo:');
        $this->geslo_stranke->addRule('required', 'Vnesite geslo.');

        $this->addElement($this->geslo_stranke);             
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class LoginInsertFormAdmin extends LoginAbstractFormAdmin {
    public function __construct($id_stranke) {
        parent::__construct($id_stranke);

        $this->button->setAttribute('value', 'Vpiši se');
    }

}

