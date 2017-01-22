<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/Select.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';
require_once 'HTML/QuickForm2/Element/InputPassword.php';

require_once 'model/NarociloDB.php';

abstract class NarociloAbstractFormStor extends HTML_QuickForm2 {

    public $status;
    public $id_narocila;

    public function __construct($id_narocila) {
        parent::__construct($id_narocila);
       
        $this->id_narocila = $id_narocila;
        
       
              
        $this->status = new HTML_QuickForm2_Element_InputText('status');
        $this->status->setAttribute('size', 1);                
       // $this->status->addRule('gte', 'Številka mora biti => 0.', 0);
       // $this->status->addRule('lte', 'Številka mora biti <=1.', 1);       
            
//        Onemogoci stranki urejanje s statusom profila
        if(isset($_SESSION["user_level"]) && $_SESSION["user_level"] == 0){
            $this->status->setLabel('Status naročila (1:potrjeno, 3:stornirano)');
            $this->status->addRule('required', 'Vpišite 1 ali 3.');
            $this->status->addRule('regex', 'Samo 1 ali 3!', '/^(1|3)$/');
            

       }
        

        $this->addElement($this->status);
        
                
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class NarociloInsertFormStor extends NarociloAbstractFormStor {
    public function __construct($id_narocila) {
        parent::__construct($id_narocila);

        $this->button->setAttribute('value', 'Potrdi');
    }

}

class NarociloEditFormStor extends NarociloAbstractFormStor {
    public $id_narocila;

    public function __construct($id_narocila) {
        parent::__construct($id_narocila);

        $this->button->setAttribute('value', 'Uredi artikel');
        $this->id_narocila = new HTML_QuickForm2_Element_InputHidden("id_narocila");
        $this->addElement($this->id_narocila);
    }


}
