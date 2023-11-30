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
    <title>
        <?php
        //ternär operator (?:)
        //Null Coalacing operator (??)
        //Null-Kohorten-Operation( (? (?:) : (?:))
        echo($area === 'mitarbeiter' ? 'Mitarbeiter Liste' : 'Abteilungsliste');
        ?>
    </title>
</head>
<body>
<a href="index.php?action=showInsert&area=mitarbeiter">
    <button style="border-radius: 5px">Neuer Mitarbeiter</button>
</a>
<a href="index.php?action=showInsert&area=abteilung">
    <button style="border-radius: 5px">Neue Abteilung</button>
</a>

<h2>
    <?php
    echo($area === 'mitarbeiter' ? 'Mitarbeiter Liste' : 'Abteilungsliste');
    ?>
</h2>
<div style="display: table; width: fit-content">
        <?php
        if ($area === 'mitarbeiter') {
        ?>
            <div style="display: table-row">
                <div style="display: table-cell; padding: 5px"><u><b>id</b></u></div>
                <div style="display: table-cell; padding: 5px"><u><b>Vorname</b></u></div>
                <div style="display: table-cell; padding: 5px"><u><b>Nachname</b></u></div>
                <div style="display: table-cell; padding: 5px"><u><b>Abteilung</b></u></div>
            </div>
            <?php for ($i = 0; $i < count($vArr); $i++) { ?>
                <div style="display: table-row">
                    <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getMitarbeiterId() ?></div>
                    <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getVorname() ?></div>
                    <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getNachname() ?></div>
                    <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getAbteilungAsString() ?></div>
                    <div style="display: table-cell; padding: 5px"><a href="index.php?action=delete&area=mitarbeiter&id=<?php echo $vArr[$i]->getMitarbeiterId() ?>"><button style="border-radius: 5px">Löschen</button></a></div>
                    <div style="display: table-cell; padding: 5px"><a href="index.php?action=showUpdate&area=mitarbeiter&id=<?php echo $vArr[$i]->getMitarbeiterId() ?>"> <button style="border-radius: 5px">Ändern</button></a></div>
                </div>
        <?php }
        }
        else
        { ?>
            <div style="display: table-row">
                <div style="display: table-cell; padding: 5px"><u><b>id</b></u></div>
                <div style="display: table-cell; padding: 5px"><u><b>Name</b></u></div>
            </div>
        <?php for ($i = 0; $i < count($vArr); $i++) { ?>
        <div style="display: table-row">
            <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getId() ?></div>
            <div style="display: table-cell; padding: 5px"><?php echo $vArr[$i]->getName() ?></div>
            <div style="display: table-cell; padding: 5px"><a href="index.php?action=delete&area=abteilung&id=<?php echo $vArr[$i]->getId() ?>"><button style="border-radius: 5px">Löschen</button></a></div>
            <div style="display: table-cell; padding: 5px"><a href="index.php?action=showUpdate&area=abteilung&id=<?php echo $vArr[$i]->getId() ?>"> <button style="border-radius: 5px">Ändern</button></a></div>
        </div>
        <?php }
        } ?>
    </div>
</div>
<?php
//echo $area;
?>
</body>
</html>