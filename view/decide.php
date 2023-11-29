<!doctype html>
<html lang="en">
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
        echo $action === 'showInsert' ? 'Neuer Mitarbeiter' : 'Daten ändern';
        ?>
    </title>
</head>
<body>
<h2>
    <?php
    echo $action === 'showInsert' ? 'Neuen Mitarbeiter Erstellen' : 'Mitarbeiter ändern';
    ?>
</h2>
<form action="index.php" method="post">
    <!-- IF ELSE? -->
    <?php if ($action === 'showUpdate'){ ?>
    <input type="hidden" name="id" value="<?php echo $mitarbeiter->getMitarbeiterId()?>">
    <?php } ?>
    <input type="hidden" name="action" value="<?php echo $action === 'showUpdate' ? 'updateMitarbeiter' : 'insertMitarbeiter' ?>">
    <table>
        <tr>
            <td><label for ="vorname"><?php echo $action === 'showUpdate' ? 'Neuer Vorname' : 'Vorname' ?></label></td>
            <td> <input type="text" name="vorname" id="vorname" value="<?php echo $action === 'showUpdate' ? $mitarbeiter->getVorname() : '' ?>"></td> <!-- $mitarbeiter wird gefunden, da wir diese seite als html inject in die index "injezieren" und doirt ist diese variable bekannt!" -->
        </tr>
        <tr>
            <td><label for ="nachname"><?php echo $action === 'showUpdate' ? 'Neuer Nachname' : 'Nachname' ?></label></td>
            <td> <input type="text" name="nachname" id="nachname" value="<?php echo $action === 'showUpdate' ? $mitarbeiter->getNachname() : '' ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" value="<?php echo $action === 'showUpdate' ? 'Ändern' : 'Erstellen' ?>"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>
