<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Vsi artikli</title>

<h1>Vsi artikli</h1>


<ul>
    <?php foreach ($artikli as $atikel): ?>
    <li><a href="<?= BASE_URL . "artikli/" . $atikel["id_artikla"] ?>"><?= $atikel["ime_artikla"] ?>:
            <?= $atikel["cena"] ?> (<?= $atikel["opis_artikla"] ?>)<a/></li>
    <?php endforeach; ?>
</ul>
