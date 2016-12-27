<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Urejanje artikla</title>

<h1>Uredi artikel</h1>

<p>
    <a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a> 
    <a href="<?= BASE_URL . "artikli/dodaj" ?>">Dodaj nov artikel</a>
    </p>


<form action="<?= BASE_URL . "artikli/uredi/" . $id_artikla ?>" method="post">
    <input type="hidden" name="id" value="<?= $id_artikla ?>"  />
    <p><label>Ime artikla: <input type="text" name="ime_artikla" value="<?= $ime_artikla ?>" autofocus /></label></p>
    <p><label>Cena: <input type="number" name="cena" value="<?= $cena ?>" /></label></p>
    <p><label>Opis artikla: <br/><textarea name="opis_artikla" cols="70" rows="10"><?= $opis_artikla ?></textarea></label></p>
    <input type="hidden" name="artikel_aktiviran" value="2"/>
    <p><label>Aktiviram artikel? <input type="checkbox" name="artikel_aktiviran" <?= $artikel_aktiviran==1 ? 'checked' : '';?> value="1"/></label>
    <p><button>Uredi</button></p>
</form>


<form action="<?= BASE_URL . "artikli/izbrisi/" . $id_artikla ?>" method="post">
    <p><label>Izbrišem? <input type="checkbox" name="delete_confirmation" /></label></p>
    <p><button type="submit" class="important">Izbriši artikel</button></p>
</form>



