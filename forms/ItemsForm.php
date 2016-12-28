<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';

abstract class ItemsAbstractForm extends HTML_QuickForm2 {

    public $ime_artikla;
    public $cena;
    public $opis_artikla;
    public $artikel_aktiviran;
    public $button;

    public function __construct($id_artikla) {
        parent::__construct($id_artikla);

        $this->ime_artikla = new HTML_QuickForm2_Element_InputText('ime_artikla');
        $this->ime_artikla->setAttribute('size', 30);
        $this->ime_artikla->setLabel('Ime artikla');
        $this->ime_artikla->addRule('maxlength', 'Ime artikla je predolgo (do 20 znakov).', 20);
        $this->ime_artikla->addRule('required', 'Vpišite ime artikla.');
        $this->ime_artikla->addRule('regex', 'Samo črke.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->ime_artikla);

        $this->opis_artikla = new HTML_QuickForm2_Element_Textarea('opis_artikla');
        $this->opis_artikla->setAttribute('rows', 10);
        $this->opis_artikla->setAttribute('cols', 70);
        $this->opis_artikla->addRule('maxlength', 'Opis je predolg (do 45 znakov).', 45);
        $this->opis_artikla->setLabel('Opis artikla');
        $this->opis_artikla->addRule('required', 'Vpišite opis artikla.');
        $this->addElement($this->opis_artikla);

        $this->cena = new HTML_QuickForm2_Element_InputText('cena');
        $this->cena->setAttribute('size', 10);
        $this->cena->setLabel('Cena (€):');
        $this->cena->addRule('required', 'Vpišite ceno.');
        $this->cena->addRule('callback', 'Vpišite številčno vrednost.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_FLOAT]
                )
        );
        $this->addElement($this->cena);
        
        $this->artikel_aktiviran = new HTML_QuickForm2_Element_InputText('artikel_aktiviran');
        $this->artikel_aktiviran->setAttribute('size', 1);
        $this->artikel_aktiviran->setLabel('Aktiviram artikel? (1:aktiviran  0:neaktiviran)');
        $this->artikel_aktiviran->addRule('required', 'Vpišite 0 ali 1.');
        #$this->artikel_aktiviran->addRule('gte', 'Številka mora biti => 0.', 0);
        #$this->artikel_aktiviran->addRule('lte', 'Številka mora biti <=1.', 1);
        $this->artikel_aktiviran->addRule('regex', 'Vpišete lahko samo 0 ali 1.', '/^[01]{1}$/');
        $this->addElement($this->artikel_aktiviran);
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }
}

class ItemsInsertForm extends ItemsAbstractForm {
    public function __construct($id_artikla) {
        parent::__construct($id_artikla);

        $this->button->setAttribute('value', 'Dodaj artikel');
    }

}

class ItemsEditForm extends ItemsAbstractForm {
    public $id_artikla;

    public function __construct($id_artikla) {
        parent::__construct($id_artikla);

        $this->button->setAttribute('value', 'Uredi artikel');
        $this->id_artikla = new HTML_QuickForm2_Element_InputHidden("id_artikla");
        $this->addElement($this->id_artikla);
    }
}

/*
class ItemsDeleteForm extends HTML_QuickForm2 {
    public $id_artikla;

    public function __construct($id_artikla) {
        parent::__construct($id_artikla, "post", ["action" => BASE_URL . "artikli/izbrisi"]);

        $this->id_artikla = new HTML_QuickForm2_Element_InputHidden("id_artikla");
        $this->addElement($this->id_artikla);

        $this->confirmation = new HTML_QuickForm2_Element_InputCheckbox("confirmation");
        $this->confirmation->setLabel('Izbrišem?');
        $this->confirmation->addRule('required', 'Obkljukaj, če želiš res izbrisati artikel.');
        $this->addElement($this->confirmation);

        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->button->setAttribute('value', 'Delete book');
        $this->addElement($this->button);
    }
}
 */

