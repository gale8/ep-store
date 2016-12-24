<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Vsi artikli</title>

<h1>Vsi artikli</h1>

<p>||
    <a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
||</p>

<ul>
    <?php foreach ($items as $item): ?>
    <li><a href="<?= BASE_URL . "artikli/" . $item["id_artikla"] ?>"><?= $item["ime_artikla"] ?>:
            <?= $item["cena"] ?> (<?= $item["opis_artikla"] ?>)<a/></li>
    <?php endforeach; ?>
</ul>
