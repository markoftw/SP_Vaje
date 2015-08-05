<?php
include 'class.php';
$k = new uporabnik();
if(isset($_POST['Message'], $_POST['ID'])){
    $k->Oddaj_Komentar($_POST['USER'], $_POST['ID'], $_POST['Message']);
    
} elseif(isset($_POST['OdstraniID'])){
    $k->Odstrani_Komentar($_POST['OdstraniID']);
} elseif(isset($_POST['PridobiID'])){
    $k->Get_Komentar($_POST['PridobiID']);
} elseif(isset($_POST['Komentar'], $_POST['UrediID'])){
    $k->Uredi_Komentar($_POST['Komentar'], $_POST['UrediID']);
} else {
    $k->Komentarji($_GET['id'], $_GET['user']);
}
?>