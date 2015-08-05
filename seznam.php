<div class="filter">
    <form name="iskanje" action="index.php" method="POST">
        Iskanje po oglasih:
        <input type="text" value="<?php echo isset($_POST['IskalniNiz']) ? $_POST['IskalniNiz'] : ''; ?>" name="IskalniNiz" required/>
    </form>
</div>
<h1>Seznam oglasov</h1>
<form class="filter" name='filtoglas' action='index.php' method='POST'><input type='hidden' name='filt' value='cena'><input type='submit' name='FiltOglase' value='Uredi po ceni'/></form>
<form class="filter" name='filtoglas' action='index.php' method='POST'><input type='hidden' name='filt' value='ocena'><input type='submit' name='FiltOglase' value='Uredi po oceni'/></form>
<div class="filter">
    <form name="oglas" action="index.php" method="POST">
        Kategorije:  
        <select name='Kategorija' required>
            <option value='' disabled="" selected="">Izberi</option>
            <?php 
            include 'class.php';
            Kategorije($seznam, 2);
            echo $seznam
            ?>             
        </select>
        <input type="submit" name="Filtriraj" value="Potrdi"/>
    </form>
</div>
<?php
    $s = new uporabnik();
    
    if(isset($_POST['Filtriraj'], $_POST['Kategorija'])){
        $s->Oglasi($_POST['Kategorija']);
    } else if(isset($_POST['IskalniNiz'])){
        $s->Iskanje_Oglasa($_POST['IskalniNiz']);
    } else if(isset($_POST['FiltOglase'])){
        if($_POST['filt'] == "cena"){
            $s->Filtriraj_po(1);
        }elseif($_POST['filt'] == "ocena"){
            $s->Filtriraj_po(0);
        }
    } else {
        $s->Oglasi(NULL);
    }

?>