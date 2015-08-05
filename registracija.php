<?php
if (isset($_SESSION['ID'])){
    header("Location: index.php");
} else {
    include 'class.php';
    if(isset($_POST['registriraj'])){
        if(isset($_POST['Uporabnik'], $_POST['Geslo'], $_POST['Geslo2'], $_POST['Mail'], $_POST['Ime'], $_POST['Priimek'])){
            if($_POST['Geslo'] == $_POST['Geslo2']){ /* Preverimo če se gesli ujemata */

                $r = new uporabnik();
                $r->setUporabnik(trim($_POST['Uporabnik']));
                $r->setGeslo(sha1(trim($_POST['Geslo'])));
                $r->setMail(trim($_POST['Mail']));
                $r->setIme($_POST['Ime']);
                $r->setPriimek($_POST['Priimek']);
                $r->setNaslov(isset($_POST['Naslov']) ? $_POST['Naslov'] : NULL);
                $r->setPosta(isset($_POST['Posta']) ? $_POST['Posta'] : NULL);
                $r->setTelefon(isset($_POST['Telefon']) ? $_POST['Telefon'] : NULL);
                $r->setSpol(isset($_POST['Spol']) ? $_POST['Spol'] : NULL);
                $r->setStarost(isset($_POST['Starost']) ? $_POST['Starost'] : NULL);

                if($r->Registracija() == TRUE){ /* Če še uporabniško ime in email ni v uporabi */
                    $_SESSION['ID']         = $r->getID();
                    $_SESSION['Uporabnik']  = $r->getUporabnik();
                    $_SESSION['Mail']       = $r->getMail();
                    $_SESSION['Ime']        = $r->getIme();
                    $_SESSION['Priimek']    = $r->getPriimek();
                    header("Location: index.php");
                    //echo "Registracija uspešna!";
                } else {
                    echo "Napaka pri registraciji! Uporabniško ime ali email sta že v uporabi!";
                }
            } else {
                echo "Gesli se ne ujemata!";
            }
        }
    }
}
    
?>
<h1>Registracija</h1>
<small>* Obvezna polja</small>
<form name="registracija" action="index.php?stran=registracija" method="POST">
    Uporabniško ime *: <br/><input type="text" name="Uporabnik" required="" placeholder="Uporabnik"/><br/>
    Geslo *:<br/><input type="password" name="Geslo" required=""/><br/>
    Ponovite geslo *:<br/><input type="password" name="Geslo2" required=""/><br/>
    E-poštni naslov *:<br/><input type="email" name="Mail" required="" placeholder="ime.priimek@domena.tld"/><br/>
    Ime *:<br/><input type="text" name="Ime" required="" placeholder="Ime"/><br/>
    Priimek *:<br/><input type="text" name="Priimek" required="" placeholder="Priimek"/><br/>
    Naslov *:<br/><input type="text" name="Naslov" placeholder="Prešernov trg 1" required/><br/>
    Pošta *:<br/><input type="text" name="Posta" placeholder="1000" required/><br/>
    Telefon:<br/><input type="text" name="Telefon" placeholder="031031031"/><br/>
    Spol:<br/>
    <select name='Spol'>
        <option value='0' disabled="" selected="">Izberi</option>
        <option value='1'>Moški</option>               
        <option value='2'>Ženska</option>               
    </select><br/>
    Starost:<br/><input type="text" name="Starost" placeholder="18"/><br/>
    <input type="submit" name="registriraj" value="Registracija"/>
</form>
