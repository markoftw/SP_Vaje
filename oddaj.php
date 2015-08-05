<?php
include 'class.php';
if (!isset($_SESSION['Uporabnik'])){
    header("Location: index.php");
} else {
    if (isset($_POST['OddajOglas'])) {
        if(isset($_POST['ONaslov'], $_POST['Opis'], $_POST['Kategorija'], $_POST['Cena'], $_POST['Zaloga'])){
            
            $o = new uporabnik();
            $o->setID($_SESSION['ID']);
            $o->setONaslov($_POST['ONaslov']);
            $o->setOpis($_POST['Opis']);
            $o->setCena($_POST['Cena']);
            $o->setZaloga($_POST['Zaloga']);
            
            if($o->Oddaj($_POST['Kategorija'])){
                echo "Oglas uspešno oddan!";
            } else {
                echo "Napaka pri oddaji oglasa!";
            }
            
        }
    }
}
?>
<h1>Oddajanje oglasa</h1>
<form name="oglas" action="index.php?stran=oddaj" method="POST" enctype="multipart/form-data">
    Naslov oglasa: <br/><input type="text" name="ONaslov" class="besedilo" required value="<?php echo isset($_POST['ONaslov'])? $_POST['ONaslov'] : '' ?>"/><br/>
    Opis oglasa:<br/><textarea name="Opis" required rows="20" cols="70"><?php echo isset($_POST['Opis'])? $_POST['Opis'] : '' ?></textarea><br/>
    Cena: <input type="number" name="Cena" required step="any"/><br/>
    Zaloga: <input type="number" name="Zaloga" required/><br/>
    Kategorija: 
    <select name='Kategorija' required>
        <option value='' disabled="" selected="">Izberi</option>
        <?php 
        Kategorije($seznam);
        echo $seznam
        ?>             
    </select><br/>
        Izberi sliko:
        <input name="slika" type="file" accept="image/*"/><br/>
    <input type="submit" name="OddajOglas" value="Oddaj"/>
</form>