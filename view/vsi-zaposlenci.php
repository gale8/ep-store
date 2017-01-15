<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Vsi zaposlenci</title>

<h1>Vsi zaposlenci</h1>

<p>
    <a class="nav" href="<?= BASE_URL . "zaposlenci/registracija" ?>">Registracija prodajalca</a>
    <a class="nav" href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>        
</p>


<?php foreach ($zaposlenci as $zaposlenec): ?>
    <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    
                    <a href="<?= BASE_URL . "zaposlenci/" . $zaposlenec["id_zaposlenca"] ?>"> <b><span style="text-transform: uppercase"><?= $zaposlenec["email_zaposlenca"] ?></span></b>
                        <br>Ime in priimek: <br><?= $zaposlenec["ime_zaposlenca"] . ' ' . $zaposlenec["priimek_zaposlenca"]?> 
                        <br><?= $zaposlenec["je_admin"] == 1 ? 'ADMIN' : 'PRODAJALEC' ?></a>
                    
                </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

