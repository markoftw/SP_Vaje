<?php
if (isset($_SESSION['ID'])){
    header("Location: index.php");
} else {
    if (isset($_POST['prijavi'])) {
        
        include 'class.php';
        
        $p = new uporabnik();
        $p->setUporabnik($_POST['Uporabnik']);
        $p->setGeslo(sha1(trim($_POST['Geslo'])));
        
        if($p->Prijava() == TRUE){
            $_SESSION['ID']         = $p->getID();
            $_SESSION['Uporabnik']  = $p->getUporabnik();
            $_SESSION['Mail']       = $p->getMail();
            $_SESSION['Ime']        = $p->getIme();
            $_SESSION['Priimek']    = $p->getPriimek();
            if (isset($_POST['chkbox'])){
                setcookie("prijavljen", $p->getUporabnik(), time()+86400);
            }
            header('Location: index.php');
        } else {
            echo "Napačno uporabniško ime ali geslo!";
        }
    }
}


?>

<h1>Prijava na spletno stran</h1>
<form name="prijava" action="index.php?stran=prijava" method="POST">
    Uporabniško ime: <br/><input type="text" value="<?php echo isset($_POST['Uporabnik']) ? $_POST['Uporabnik'] : ''; ?>" name="Uporabnik" required=""/><br/>
    Geslo:<br/><input type="password" name="Geslo" required=""/><br/>
    <!--<input type="checkbox" name="chkbox" value="chkbox"/> zapomni si geslo<br/>-->
    <input type="submit" name="prijavi" value="Prijava"/>
</form>