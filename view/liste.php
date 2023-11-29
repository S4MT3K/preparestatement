<!doctype html>
<html lang="de">
<head>
    <style>
        body {
            background-color: #878787;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mitarbeiter Liste</title>
</head>
<a href="index.php?action=showInsert">
    <button style="border-radius: 5px">Neuer Mitarbeiter</button>
</a>
<h2>Mitarbeiter Liste</h2>
<div style="display: table; width: fit-content">
    <div style="display: table-row">
        <div style="display: table-cell; padding: 5px"><u><b>id</b></u></div>
        <div style="display: table-cell; padding: 5px"><u><b>Vorname</b></u></div>
        <div style="display: table-cell; padding: 5px"><u><b>Nachname</b></u></div>
    </div>
    <?php for ($i = 0; $i < count($mArr); $i++) { ?>
        <div style="display: table-row">
            <div style="display: table-cell; padding: 5px"><?php echo $mArr[$i]->getMitarbeiterId() ?></div>
            <div style="display: table-cell; padding: 5px"><?php echo $mArr[$i]->getVorname() ?></div>
            <div style="display: table-cell; padding: 5px"><?php echo $mArr[$i]->getNachname() ?></div>
            <div style="display: table-cell; padding: 5px"><a href="index.php?action=delete&id=<?php echo $mArr[$i]->getMitarbeiterId() ?>"><button style="border-radius: 5px">Löschen</button></a></div>
            <div style="display: table-cell; padding: 5px"><a href="index.php?action=showUpdate&id=<?php echo $mArr[$i]->getMitarbeiterId() ?>"> <button style="border-radius: 5px">Ändern</button></a></div>
        </div>
    <?php } ?>
</div>
<?php

?>
</body>
</html>