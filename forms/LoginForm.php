<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputPassword.php';

abstract class LoginAbstractForm extends HTML_QuickForm2 {

    public $email_stranke;
    public $button;

    public function __construct($id_stranke) {
        parent::__construct($id_stranke);            
        
        $this->email_stranke = new HTML_QuickForm2_Element_InputText('email_stranke');
        $this->email_stranke->setAttribute('size', 45);
        $this->email_stranke->setLabel('Elektronski naslov:');
        $this->email_stranke->addRule('maxlength', 'Email je predolg (do 45 znakov).', 45);
        $this->email_stranke->addRule('required', 'Vpišite email.');
        $this->email_stranke->addRule('callback', 'Vnesite veljaven elektronski naslov.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_EMAIL])
        );
        $this->addElement($this->email_stranke);
        
        $this->geslo_stranke = new HTML_QuickForm2_Element_InputPassword('geslo_stranke');       
        $this->geslo_stranke->setLabel('Vnesite geslo:');
        $this->geslo_stranke->addRule('required', 'Vnesite geslo.');

        $this->addElement($this->geslo_stranke);             
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class LoginInsertForm extends LoginAbstractForm {
    public function __construct($id_stranke) {
        parent::__construct($id_stranke);

        $this->button->setAttribute('value', 'Vpiši se');
    }

}

