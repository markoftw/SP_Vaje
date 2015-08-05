<h1>Urejanje kategorij</h1>
<form name="oglas" action="index.php?stran=kategorije" method="POST">
    Podkategorija: <br/><input type="text" name="Podkategorija" class="besedilo" required value="<?php echo isset($_POST['Podkategorija'])? $_POST['Podkategorija'] : '' ?>"/><br/>
    Kategorija:    
    <select name='Kategorija' required>
        <option value='' disabled="" selected="">Izberi</option>
        <option value='0'>Nova kategorija (brez pod)</option>
        <?php
        include 'class.php';
        Kategorije($seznam, 1);
        echo $seznam
        ?>             
    </select><br/>
    <input type="submit" name="OddajKategorijo" value="Dodaj"/>
</form>
<?php
if (!isset($_SESSION['Uporabnik'])){
    header("Location: index.php");
} else {
    if(isset($_POST['OddajKategorijo'])){
        if(isset($_POST['Podkategorija'], $_POST['Kategorija'])){
            $req = new uporabnik();
            if($req->Oddaj_Kategorijo($_POST['Kategorija'], $_POST['Podkategorija'])){
                echo "Nova (pod)kategorija dodana!";
            } else {
                echo "Napaka!";
            }
        }
    }
}

?>