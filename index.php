<?php
spl_autoload_register(function ($className) {
    include 'class/' . $className . '.php';
});
//Variablen Empfang
//Null Coalacing Operator (??)
$action = ($_REQUEST['action'] ?? 'showList'); // Startseite
//$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'showList'; //Ternärer Operator also dieser Doppelpuinkt
$id = ($_REQUEST['id'] ?? '');
$vorname = ($_POST['vorname'] ?? '');
$nachname = ($_POST['nachname'] ?? '');

if ($action === 'showList') {
    $m = new Mitarbeiter();
    $mArr = $m->getAllMitarbeiterAsObjects();
    include 'view/liste.php';
} elseif ($action === 'showInsert') {
    include 'view/decide.php';
} elseif ($action === 'insertMitarbeiter') {
    $m = new Mitarbeiter();
    $mitarbeiter = $m->createMitarbeiter($vorname, $nachname);
    $mArr = $m->getAllMitarbeiterAsObjects();
    include "view/liste.php";
} elseif ($action === 'showUpdate') {
    $m = new Mitarbeiter();
    $mitarbeiter = $m->getMitarbeiterById($id);
    include 'view/decide.php';
} elseif ($action === 'updateMitarbeiter') {
    $m = new Mitarbeiter($id, $vorname, $nachname);
    $m->updateMitarbeiter();
    $mArr = $m->getAllMitarbeiterAsObjects();
    include 'view/liste.php';
} elseif ($action === 'delete') {
    $m = new Mitarbeiter();
    $m->deleteMitarbeiter($id);
    $mArr = $m->getAllMitarbeiterAsObjects();
    DBConn::fixId();
    include "view/liste.php";
} else {
    $message = 'Datei nicht gefunden : 404';
    include 'view/error.php';
}