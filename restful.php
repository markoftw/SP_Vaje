<?php

include 'baza.php';
include 'class.php';

$k = new uporabnik();

if(isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD'])){
    
    $metoda = $_SERVER['REQUEST_METHOD'];
    
    switch ($metoda) {
        case 'POST':
            if(isset($_POST['USER'], $_POST['ID'], $_POST['Message'])){
                $k->Oddaj_Komentar($_POST['USER'], $_POST['ID'], $_POST['Message']);
            }elseif(isset($_POST['Komentar'], $_POST['UrediID'])){
                $k->Uredi_Komentar($_POST['Komentar'], $_POST['UrediID']);
            }
            break;
        case 'GET':
            header('Content-Type: application/json');
            if(isset($_GET['komentar'])){
                $k->Get_Komentar($_GET['komentar']);
            } elseif(isset($_GET['komentarji'])){
                $k->Komentarji($_GET['komentarji']);
            }  
            break;
        case 'DELETE':
            parse_str(file_get_contents("php://input"),$vars);
            $k->Odstrani_Komentar($vars['id']);
            break;
    }
    
} else {
    die();
}

?>