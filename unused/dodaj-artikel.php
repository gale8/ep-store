<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodaj artikel</title>

<h1>Dodaj nov artikel</h1>

<p>
<a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a> 
<a href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
</p>

<form action="<?= BASE_URL . "artikli/dodaj" ?>" method="post">
    <p><label>Ime artikla: <input type="text" name="ime_artikla" value="<?= $ime_artikla ?>" autofocus /></label></p>
    <p><label>Cena: <input type="number" step="0.01" min="0" name="cena" value="<?= $cena ?>" /></label></p>
    <p><label>Opis artikla: <br/><textarea name="opis_artikla" cols="70" rows="10"><?= $opis_artikla ?></textarea></label></p>
    <input type="hidden" name="artikel_aktiviran" value="2"/>
    <p><label>Aktiviram artikel? <input type="checkbox" name="artikel_aktiviran" value="1"/></label>
    <p><button>Dodaj</button></p>
</form>