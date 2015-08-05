<h1>Urejanje oglasov</h1>
<?php
if (!isset($_SESSION['Uporabnik'])){
    header("Location: index.php");
} else {
    include 'class.php';
    $u = new uporabnik();
    
    if (isset($_POST['UrediOglas'], $_GET['stran']) && $_GET['stran'] == "uredi") {
        if(isset($_POST['ONaslov'], $_POST['Opis'])) {
            $u->setID($_SESSION['ID']);
            $u->setONaslov($_POST['ONaslov']);
            $u->setOpis($_POST['Opis']);
            $u->setKategorija($_POST['Kategorija']);
            
            if($u->Post_Oglas($_POST['oglas'])){
                echo "Oglas je bil uspešno posodobljen!";
            } else {
                echo "Napaka!";
            }
        }
    } else if (isset($_POST['BumpOglas'], $_GET['stran']) && $_GET['stran'] == "uredi") {
        if(isset($_POST['oglas'])) {
            if($u->Bump_Oglas($_POST['oglas'], $_SESSION['ID'])){
                echo "Oglas je bil uspešno podaljšan!";
            } else {
                echo "Napaka!";
            }
        }
    } else if (isset($_POST['FiltOglas'], $_GET['stran']) && $_GET['stran'] == "uredi") {
        if(isset($_POST['filt'])) {
            if($_POST['filt'] == "vsi"){
                $u->Oglasi_uporabnika($_SESSION['ID'], TRUE);
            } else {
                $u->Oglasi_uporabnika($_SESSION['ID'], FALSE);
            }
        }
    } else if(isset($_GET['id']) && $_GET['action'] == 'izbris') {
        if($u->Izbris_Oglasa($_GET['id'], $_SESSION['ID'])) {
            echo "Oglas z ID številko " . $_GET['id'] . " uspešno izbrisan!";
        } else {
            echo "Napaka: dostop zavrnjen!";
        }
    } else if(isset($_GET['id']) && $_GET['action'] == 'edit') {
        echo "Izbrali ste oglas z ID številko " . $_GET['id'] . ".<br/><br/>";   
        $u->Uredi_Oglas($_GET['id'], $_SESSION['ID']);
    } else { 
        $u->Oglasi_uporabnika($_SESSION['ID'], FALSE);
    }
}    
?>