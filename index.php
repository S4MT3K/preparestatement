<?php
spl_autoload_register(function ($className) {
    include 'class/' . $className . '.php';
});
//Variablen Empfang
//Null Coalacing Operator (??)
$action = ($_REQUEST['action'] ?? 'showList'); // Startseite
//$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'showList'; //Ternärer Operator also dieser Doppelpuinkt
$id = ($_REQUEST['id'] ?? '');
$area = ($_REQUEST['area'] ?? 'mitarbeiter');
$vorname = ($_POST['vorname'] ?? '');
$nachname = ($_POST['nachname'] ?? '');
$name = ($_POST['name'] ?? '');
$abtid = ($_POST['abteilungsid'] ?? '');

if ($action === 'showList')
{
    if ($area === 'mitarbeiter' ? $var = new Mitarbeiter() : $var = new Abteilung())
    {
        $vArr = $var->getAllAsObjects();
    }
    include 'view/liste.php';
}

elseif ($action === 'showInsert')
{
    $a = new Abteilung();
    $vArr = $a->getAllAsObjects();
    include 'view/decide.php';
}

elseif ($action === 'insertMitarbeiter')
{
    $m = new Mitarbeiter();
    $mitarbeiter = $m->createObject($vorname, $nachname, $abtid);
    $vArr = $m->getAllAsObjects();
    include "view/liste.php";
}

elseif ($action === 'insertAbteilung')
{
    $a = new Abteilung();
    $abteilung = $a->createObject($name);
    $vArr = $a->getAllAsObjects();
    include "view/liste.php";
}

elseif ($action === 'showUpdate')
{
    if ($area === 'mitarbeiter' ? $var = new Mitarbeiter() : $var = new Abteilung())
    {
        if ($area === 'mitarbeiter')
        {
            $mitarbeiter = $var->getObjectById($id);
            $a = new Abteilung(); //DROPDOWNMENU ABTEILUNGEN
            $vArr = $a->getAllAsObjects();
        }
        else
        {
            $abteilung = $var->getObjectById($id);
        }
        include 'view/decide.php';
    }
}

elseif ($action === 'updateObject')
{
    if ($area === 'mitarbeiter' ? $var = new Mitarbeiter($id, $vorname, $nachname, $abtid) : $var = new Abteilung($id, $name)) {
        $var->updateObject();
        $vArr = $var->getAllAsObjects();
        include 'view/liste.php';
    }
}

elseif ($action === 'delete')
{
    if ($area === 'mitarbeiter' ? $var = new Mitarbeiter() : $var = new Abteilung()) {
        $var->deleteObject($id);
        $vArr = $var->getAllAsObjects();
        DBConn::fixId(get_class($var), $area);
        include "view/liste.php";
    }
}

else
{
    $message = 'Datei nicht gefunden : 404';
    include 'view/error.php';
}