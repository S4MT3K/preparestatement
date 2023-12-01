<!doctype html>
<html lang="de">
<head>
    <style>
        body {
            background-color: #878787;
        }
        a {
            text-decoration: none;
        }
        a:visited{
            text-decoration: none;
            color: inherit;
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
<h2>
    <?php
    echo($area === 'mitarbeiter' ? 'Mitarbeiter Liste' : 'Abteilungsliste');
    ?>
</h2>
        <?php
        if ($area === 'mitarbeiter') {
        ?>
        <a href="index.php?action=showInsert&area=mitarbeiter">
            <button style="border-radius: 5px">Neuer Mitarbeiter</button>
        </a>
        <span style="margin: 5px"></span>
        <a href="index.php?action=showList&area=abteilung">
            <button style="border-radius: 5px">Zeige Abteilungen</button>
        </a>
        <br>
        <div style="padding-top: 15px; display: table; width: fit-content">
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
            <a href="index.php?action=showInsert&area=abteilung">
                <button style="border-radius: 5px">Neue Abteilung</button>
            </a>
            <span style="margin: 5px"></span>
            <a href="index.php?action=showList&area=mitarbeiter">
                <button style="border-radius: 5px">Zeige Mitarbeiter</button>
            </a>
            <br>
            <br>
            <div style="display: table; width: fit-content">
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
<?php
//echo $area;
?>
</body>
</html>