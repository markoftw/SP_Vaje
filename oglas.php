<?php
    include 'class.php';
    $s = new uporabnik();
    if(isset($_POST['Oceni'], $_POST['ocena'])){
        if($s->Oceni_Oglas($_GET['id'], $_POST['ocena'])){
            echo "Ocena oglasa oddana!";
        } else {
            echo "Napaka!";
        }
        $s->Oglas($_GET['id']);
    } elseif(isset($_POST['OceniKomentar'], $_POST['ocena1'])){
        if($s->Oceni_Komentar($_POST['komentar'], $_POST['ocena1'])){
            echo "Ocena komentarja oddana!";
        } else {
            echo "Napaka!";
        }
        $s->Oglas($_GET['id']);
    }else {
        $s->Oglas($_GET['id']);
    }
?>
<form name='oceniIzdelek' action="index.php?stran=oglas&id=<?php echo $_GET['id']; ?>" method="POST">
    <input type="radio" name="ocena" value="1">1
    <input type="radio" name="ocena" value="2">2
    <input type="radio" name="ocena" value="3" checked>3
    <input type="radio" name="ocena" value="4">4
    <input type="radio" name="ocena" value="5">5
    <input type="submit" name="Oceni" value="Oceni">
</form>
<h3>Komentarji</h3>
<div id="urejanje"></div>
<div id="VsiKomentarji"></div>
<?php if(isset($_SESSION['Uporabnik'])){ ?>
<input id="user" type="hidden" value="<?php echo $_SESSION['ID']; ?>">
<textarea rows="7" cols="70" id="komentar"></textarea><br/>
<button id="komentiraj">Objavi</button>
<?php 
} else {
    echo "Komentiranje je samo za registrirane uporabnike!";
}
?>