<?php

function checkParent($id, $n){
    include "baza.php";
    if($n == 1) {
        $req = $mysqli->prepare("SELECT * FROM kategorije WHERE podkategorija = :id");
        $req->execute(array('id' => $id));
    } else {
        $req = $mysqli->prepare("SELECT * FROM oglasi JOIN kategorije ON oglasi.kategorija_id=kategorije.id WHERE oglasi.kategorija_id = :id");
        $req->execute(array('id' => $id));
    }
    if($req->rowCount() > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}

function Kategorije(&$izpis, $disable=0, $parent=0, $al=""){
    include "baza.php";
    $req = $mysqli->prepare("SELECT * FROM kategorije WHERE podkategorija = :id");
    $req->execute(array('id' => $parent));
    while($c = $req->fetch()){
        if($disable == 0){
        $d = checkParent($c["id"], 1) ? "disabled " : "";
        } elseif($disable == 1) { $d = checkParent($c["id"], 0) ? "disabled " : ""; }
        else { $d = ""; }
        $izpis .= "<option ". $d ."value='" . $c["id"] . "'>" . $al . $c["kategorija"] . "</option>";
        if($c["id"] != $parent){
            Kategorije($izpis, $disable, $c["id"], $al . "--");
        }
    }
}

function z_kat($id){
    include "baza.php";
    $req = $mysqli->prepare("SELECT * FROM kategorije WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));
    while ($r = $req->fetch()) {
        $k = str_replace($r['id'],$r['kategorija'],$id);
        return $k;
    }
}
function z_upo($id){
    include "baza.php";
    $req = $mysqli->prepare("SELECT * FROM uporabniki WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));
    while ($r = $req->fetch()) {
        $u = str_replace($r['id'],$r['uporabnisko_ime'],$id);
        return $u;
    }
}
function z_mail($id){
    include "baza.php";
    $req = $mysqli->prepare("SELECT * FROM uporabniki WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));
    while ($r = $req->fetch()) {
        $m = str_replace($r['id'],$r['mail'],$id);
        return $m;
    }
}
function dodaj_ogled($id){
    include "baza.php";
    $req = $mysqli->prepare("SELECT ogledi FROM oglasi WHERE id = :id");
    $req->execute(array(
        'id' => $id
    ));
    while ($r = $req->fetch()) {
        $up = $mysqli->prepare("UPDATE oglasi SET ogledi = :ogledi WHERE id = :id");
        $up->execute(array(
            'id' => $id,
            'ogledi' => $r['ogledi']+1
        ));
    }
}

class uporabnik{
    
    /* Obvezna polja */
    private $ID,$Uporabnik,$Geslo,$Mail,$Ime,$Priimek;
    /* Neobvezna polja */
    private $Naslov,$Posta,$Telefon,$Spol,$Starost;
    /* Oglasi */
    private $ONaslov,$Opis,$Cena,$Zaloga,$Kategorija;
    
    public function getID(){
        return $this->ID;
    }
    public function setID($ID){
        $this->ID = $ID;
    }
    public function getUporabnik(){
        return $this->Uporabnik;
    }
    public function setUporabnik($Uporabnik){
        $this->Uporabnik = $Uporabnik;
    }
    public function getGeslo(){
        return $this->Geslo;
    }
    public function setGeslo($Geslo){
        $this->Geslo = $Geslo;
    }
    public function getMail(){
        return $this->Mail;
    }
    public function setMail($Mail){
        $this->Mail = $Mail;
    }
    public function getIme(){
        return $this->Ime;
    }
    public function setIme($Ime){
        $this->Ime = $Ime;
    }    
    public function getPriimek(){
        return $this->Priimek;
    }
    public function setPriimek($Priimek){
        $this->Priimek = $Priimek;
    }
    public function getNaslov(){
        return $this->Naslov;
    }
    public function setNaslov($Naslov){
        $this->Naslov = $Naslov;
    }
    public function getPosta(){
        return $this->Posta;
    }
    public function setPosta($Posta){
        $this->Posta = $Posta;
    }
    public function getTelefon(){
        return $this->Telefon;
    }
    public function setTelefon($Telefon){
        $this->Telefon = $Telefon;
    }
    public function getSpol(){
        return $this->Spol;
    }
    public function setSpol($Spol){
        $this->Spol = $Spol;
    }
    public function getStarost(){
        return $this->Starost;
    }
    public function setStarost($Starost){
        $this->Starost = $Starost;
    }
    public function getONaslov(){
        return $this->ONaslov;
    }
    public function setONaslov($ONaslov){
        $this->ONaslov = $ONaslov;
    }    
    public function getOpis(){
        return $this->Opis;
    }
    public function setOpis($Opis){
        $this->Opis = $Opis;
    }
    public function getCena(){
        return $this->Cena;
    }
    public function setCena($Cena){
        $this->Cena = $Cena;
    }
    public function getZaloga(){
        return $this->Zaloga;
    }
    public function setZaloga($Zaloga){
        $this->Zaloga = $Zaloga;
    }
    public function getKategorija(){
        return $this->Kategorija;
    }
    public function setKategorija($Kategorija){
        $this->Kategorija = $Kategorija;
    }
    
    public function checkUser(){
        include "baza.php";
        $req = $mysqli->prepare("SELECT * FROM uporabniki WHERE uporabnisko_ime=:User");
        $req->execute(array(
            'User' => $this->getUporabnik(),
            ));
        if ($req->rowCount() >= 1) {
            return TRUE; // does exist
        } else {
            return FALSE;
        }
    }
    public function checkEmail(){
        include "baza.php";
        $req = $mysqli->prepare("SELECT * FROM uporabniki WHERE mail=:Email");
        $req->execute(array(
            'Email' => $this->getMail(),
            ));
        if ($req->rowCount() >= 1) {
            return TRUE; // does exist
        } else {
            return FALSE;
        }
    }
    
    public function Registracija(){
        if($this->checkUser() == FALSE && $this->checkEmail() == FALSE){
            include "baza.php";
            $req = $mysqli->prepare("INSERT INTO uporabniki(uporabnisko_ime,geslo,mail,ime,priimek,naslov,posta,telefon,spol,starost) VALUES (:uporabnik,:geslo,:mail,:ime,:priimek,:naslov,:posta,:telefon,:spol,:starost)");
            $req->execute(array(
                'uporabnik' => $this->getUporabnik(),
                'geslo'     => $this->getGeslo(),
                'mail'      => $this->getMail(),
                'ime'       => $this->getIme(),
                'priimek'   => $this->getPriimek(),
                'naslov'    => $this->getNaslov(),
                'posta'     => $this->getPosta(),
                'telefon'   => $this->getTelefon(),
                'spol'      => $this->getSpol(),
                'starost'   => $this->getStarost()
                ));
            
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    public function Prijava(){
        include "baza.php";
        $req = $mysqli->prepare("SELECT * FROM uporabniki WHERE uporabnisko_ime=:user AND geslo=:password");
        $req->execute(array(
            'user'      => $this->getUporabnik(),
            'password'  => $this->getGeslo()
            ));

        if ($req->rowCount() == 0) {
            //header("Location: ../index.php?error=1");
            return FALSE;
        } else {
            while ($data = $req->fetch()) {
                $this->setID($data['id']);
                $this->setUporabnik($data['uporabnisko_ime']);
                $this->setMail($data['mail']);
                $this->setIme($data['ime']);
                $this->setPriimek($data['priimek']);
                return TRUE;
            }
        }
    }
    
    public function Oddaj($k){
        include "baza.php";
        $req = $mysqli->prepare("INSERT INTO oglasi(uporabnik_id,kategorija_id,naslov,opis,ustvarjeno,zapadlost,cena,zaloga) VALUES (:uporabnik,:kategorija,:naslov,:opis,NOW(),DATE_ADD(NOW(), INTERVAL 30 DAY),:cena,:zaloga)");
        $req->execute(array(
            'uporabnik'         => $this->getID(),
            'kategorija'        => $k,
            'naslov'            => $this->getONaslov(),
            'opis'              => $this->getOpis(),
            'cena'              => $this->getCena(),
            'zaloga'            => $this->getZaloga()
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function Oglasi($id){
        include "baza.php";
        if($id != NULL) {
            $req = $mysqli->prepare("SELECT * FROM oglasi WHERE zapadlost >= NOW() AND kategorija_id = :id ORDER BY zapadlost DESC");
            $req->execute(array(
                'id' => $id
            ));
        } else {
            $req = $mysqli->prepare("SELECT * FROM oglasi WHERE zapadlost >= NOW() ORDER BY zapadlost DESC");
            $req->execute();
        }
        if($req->rowCount() > 0){      
            while($r = $req->fetch()){
                $novidatumura = explode(" ", $r['ustvarjeno']);
                $datum = str_replace('-', '.', $novidatumura[0]);
                $ura = date('H:i',strtotime($novidatumura[1]));

                $datumexpl = explode(".", $datum);
                
                echo "<div class='naslov'><a href='index.php?stran=oglas&id=". $r['id'] ."'>" . $r['naslov'] . "</a></div>";
                echo "<div class=\"objavil\">Kategorija: ".z_kat($r['kategorija_id']). ", objavil: " . z_upo($r['uporabnik_id']) . ", dne: " . $datumexpl[2] . " " . date("M",strtotime($datumexpl[1])) . " " . $datumexpl[0] . " ob " . $ura . "<br>Cena: ".$r['cena']."€, Ocena: ".($r['ocena'] > 0 ? round(($r['ocena']/$r['st_ocen']),2) : '0.00')."</div>";
                echo nl2br($r['opis']) ."<br/><br/>";
            }
        } else { echo "Kategorija je brez oglasov!"; }
    }
    
    public function Oglasi_uporabnika($u, $filter){
        include 'baza.php';
        if($filter == TRUE){
            $req = $mysqli->prepare("SELECT * FROM oglasi WHERE uporabnik_id = :u");
        } else {
            $req = $mysqli->prepare("SELECT * FROM oglasi WHERE uporabnik_id = :u AND zapadlost >= NOW()");
        }
        $req->execute(array(
            "u" => $u
        ));
        if($req->rowCount() > 0) {
            echo "<form class='filter' name='filtoglas' action='index.php?stran=uredi' method='POST'><input type='hidden' name='filt' value='zapadli'><input type='submit' name='FiltOglas' value='Skrij zapadle oglase'/></form>";
            echo "<form class='filter' name='filtoglas' action='index.php?stran=uredi' method='POST'><input type='hidden' name='filt' value='vsi'><input type='submit' name='FiltOglas' value='Prikaži zapadle oglase'/></form>";
            echo "Izberite oglas, ki ga želite urediti:<br/>";
            while($r = $req->fetch()){
                echo "<hr/><a class=\"x\" href=\"index.php?stran=uredi&amp;id=" . $r['id'] . "&amp;action=izbris \"><img src='x.png' title='Izbriši' alt='Izbriši'/></a><a href=\"index.php?stran=uredi&amp;id=" . $r['id'] . "&amp;action=edit \">" . $r['naslov'] . "</a><form name='oglas' action='index.php?stran=uredi' method='POST'><input type='hidden' name='oglas' value='" . $r['id'] . "'><input type='submit' name='BumpOglas' value='Podaljšaj oglas'/></form>";
            }
        } else {
            echo "Nimate objavljenih oglasov!";
        }
    }
    
    public function Izbris_Oglasa($id, $u){
        include 'baza.php';
        $req = $mysqli->prepare("DELETE FROM oglasi WHERE id = :id AND uporabnik_id = :u");
        $req->execute(array(
            "id"    => $id,
            "u"     => $u
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function Uredi_Oglas($id, $u) {
        include 'baza.php';
        $req = $mysqli->prepare("SELECT * FROM oglasi WHERE id = :id AND uporabnik_id = :u");
        $req->execute(array(
            "id"    => $id,
            "u"     => $u
        ));
        if($req->rowCount() > 0) {
            while($r = $req->fetch()){
                echo '<form name="oglas" action="index.php?stran=uredi" method="POST">';
                    echo 'Naslov oglasa: <br/><input type="text" name="ONaslov" required class="besedilo" value="'.$r['naslov'].'"/><br/>';
                    echo 'Opis oglasa:<br/><textarea name="Opis" required rows="20" cols="70">'.$r['opis'].'</textarea><br/>';
                    echo '<select name="Kategorija" required><option value=""disabled="" selected="">Izberi</option><option value="0">Nova kategorija (brez pod)</option>';
                    Kategorije($seznam, 0);
                    echo $seznam;
                    echo '</select><br/>';
                    echo '<input type="hidden" name="oglas" value="'. $r['id'] .'">';
                    echo '<input type="submit" name="UrediOglas" value="Pošlji"/>';
                echo '</form>';
            }
        } else {
            echo "Napaka: dostop zavrnjen!";
        }     
    }
    public function Post_Oglas($o) {
        include 'baza.php';
        $req = $mysqli->prepare("UPDATE oglasi SET naslov = :naslov, opis = :opis, kategorija_id = :kat WHERE id = :o AND uporabnik_id = :id");
        $req->execute(array(
            "o"         => $o,
            "id"        => $this->getID(),
            "naslov"    => $this->getONaslov(),
            "opis"      => $this->getOpis(),
            "kat"       => $this->getKategorija()
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    public function Bump_Oglas($o, $id) {
        include 'baza.php';
        $req = $mysqli->prepare("UPDATE oglasi SET zapadlost = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE id = :o AND uporabnik_id = :id");
        $req->execute(array(
            "o"     => $o,
            "id"    => $id
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }  
    }
        
    public function Oglas($id){
        include 'baza.php';
        $req = $mysqli->prepare("SELECT * FROM oglasi WHERE id = :id");
        $req->execute(array(
            "id" => $id
        ));
        if($req->rowCount() > 0) {
            while($r = $req->fetch()){
                dodaj_ogled($r['id']);
                $stevilo = $r['ogledi'] + 1;
                echo "<h2 class='naslov'>" . $r['naslov'] . "</h2>";
                echo nl2br($r['opis']) ."<br/><br/>";
                echo "<div style='color:#505050'>Cena: ". $r['cena'] ."€<br/>Zaloga: ". $r['zaloga'] ."<br/><br/>Kontakt:<br/> Objavil: " . z_upo($r['uporabnik_id']) . "<br/> Email: ". z_mail($r['uporabnik_id']) ."<br/>Število ogledov: ". $stevilo ."<br/>Ocena oglasa: ". ($r['ocena'] > 0 ? round(($r['ocena']/$r['st_ocen']),2) : '0.00') ."</div>";
            }
        } else {
            echo "Napaka: oglas ne obstaja!";
        }  
    }
    
    public function Iskanje_Oglasa($niz) {
        include 'baza.php';
        $req = $mysqli->prepare("SELECT * FROM oglasi WHERE zapadlost >= NOW() AND (naslov LIKE :niz OR opis LIKE :niz) ORDER BY zapadlost DESC");
        $req->execute(array(
            "niz" => "%".$niz."%"
        ));
        while($r = $req->fetch()){
            $novidatumura = explode(" ", $r['ustvarjeno']);
            $datum = str_replace('-', '.', $novidatumura[0]);
            $ura = date('H:i',strtotime($novidatumura[1]));

            $datumexpl = explode(".", $datum);
            echo "<div class='naslov'><a href='index.php?stran=oglas&id=". $r['id'] ."'>" . $r['naslov'] . "</a></div>";
            echo "<div class=\"objavil\">Kategorija: ".z_kat($r['kategorija_id']). ", objavil: " . z_upo($r['uporabnik_id']) . ", dne: " . $datumexpl[2] . " " . date("M",strtotime($datumexpl[1])) . " " . $datumexpl[0] . " ob " . $ura . "<br>Cena: ".$r['cena']."€, Ocena: ".($r['ocena'] > 0 ? round(($r['ocena']/$r['st_ocen']),2) : '0.00')."</div>";
            echo nl2br($r['opis']) ."<br/><br/>";
        }
    }
    
    public function Oddaj_Kategorijo($kat, $pod){
        include "baza.php";
        $req = $mysqli->prepare("INSERT INTO kategorije(kategorija,podkategorija) VALUES (:kategorija,:podkategorija)");
        $req->execute(array(
            'kategorija'        => $pod,
            'podkategorija'     => $kat,
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function Komentarji($id){
        include 'baza.php';
        $req = $mysqli->prepare("SELECT * FROM komentarji WHERE oglas_id = :id");
        $req->execute(array(
            "id" => $id
        ));
        $data = array();
        while($r = $req->fetch()){
            /*if($r['uporabnik_id'] == $u){
                echo '<div style="color:cyan;font-size:1em;">'. z_upo($r['uporabnik_id']) .' - <span style="color:black;">Ocena: '. ($r["ocena"] > 0 ? round(($r["ocena"]/$r["st_ocen"]),2) : "0.00") .'</span> <button id="odstrani" value="'.$r['id'].'">Odstrani</button><button id="uredi" value="'.$r['id'].'">Uredi</button></div>';
                echo '<form name="oceniKomentar" action="index.php?stran=oglas&id='.$id.'" method="POST">
                        <input type="radio" name="ocena1" value="1">1
                        <input type="radio" name="ocena1" value="2">2
                        <input type="radio" name="ocena1" value="3" checked>3
                        <input type="radio" name="ocena1" value="4">4
                        <input type="radio" name="ocena1" value="5">5
                        <input type="hidden" name="komentar" value="'. $r['id'] .'">
                        <input type="submit" name="OceniKomentar" value="Oceni">
                    </form>';
            } else {
                echo "<div style='color:cyan;font-size:1em;'>". z_upo($r['uporabnik_id']) ."  - <span style='color:black;'>Ocena: ". ($r['ocena'] > 0 ? round(($r['ocena']/$r['st_ocen']),2) : '0.00') ."</span></div>";
                echo '<form name="oceniKomentar" action="index.php?stran=oglas&id='.$id.'" method="POST">
                        <input type="radio" name="ocena1" value="1">1
                        <input type="radio" name="ocena1" value="2">2
                        <input type="radio" name="ocena1" value="3" checked>3
                        <input type="radio" name="ocena1" value="4">4
                        <input type="radio" name="ocena1" value="5">5
                        <input type="hidden" name="komentar" value="'. $r['id'] .'">
                        <input type="submit" name="OceniKomentar" value="Oceni">
                    </form>';
            }
            echo "<br/>". nl2br($r['komentar']) ."<br/><hr>";*/
            
            $newData = array("id" => $r['id'], "uporabnik_id" => z_upo($r['uporabnik_id']), "oglas_id" => $r['oglas_id'], "komentar" => $r['komentar'], "ocena" => $r['ocena'], "st_ocen" => $r['st_ocen']);
            array_push($data, $newData);
        }
        echo json_encode($data);
    }
    
    public function Oddaj_Komentar($id, $oglas, $komentar){
        include "baza.php";
        $req = $mysqli->prepare("INSERT INTO komentarji(uporabnik_id,oglas_id,komentar) VALUES (:id,:oglas,:komentar)");
        $req->execute(array(
            'id'        => $id,
            'oglas'     => $oglas,
            'komentar'  => $komentar
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function Oceni_Oglas($id, $ocena) {
        include 'baza.php';
        $req = $mysqli->prepare("UPDATE oglasi SET ocena = ocena+:ocena, st_ocen = st_ocen+1 WHERE id = :id");
        $req->execute(array(
            "id"    => $id,
            "ocena" => $ocena
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        } 
    }
    
    public function Oceni_Komentar($id, $ocena) {
        include 'baza.php';
        $req = $mysqli->prepare("UPDATE komentarji SET ocena = ocena+:ocena, st_ocen = st_ocen+1 WHERE id = :id");
        $req->execute(array(
            "id"    => $id,
            "ocena" => $ocena
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        } 
    }
    
    public function Odstrani_Komentar($id) {
        include 'baza.php';
        $req = $mysqli->prepare("DELETE FROM komentarji WHERE id = :id");
        $req->execute(array(
            "id"    => $id
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    public function Get_Komentar($id) {
        include 'baza.php';
        $req = $mysqli->prepare("SELECT * FROM komentarji WHERE id = :id");
        $req->execute(array(
            "id"    => $id
        ));
        while($r = $req->fetch()){
            echo json_encode($r);
        }
    }
    
    public function Uredi_Komentar($komentar, $id){
        include 'baza.php';
        $req = $mysqli->prepare("UPDATE komentarji SET komentar = :komentar WHERE id = :id");
        $req->execute(array(
            "komentar" => $komentar,
            "id"        => $id
        ));
        if($req->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }  
    }
    
    public function Filtriraj_po($a) {
        include 'baza.php';
        if($a == 1){
            $req = $mysqli->prepare("SELECT * FROM oglasi ORDER BY cena DESC");
        } elseif($a == 0){
            $req = $mysqli->prepare("SELECT * FROM oglasi ORDER BY ocena/st_ocen DESC");
        }
        $req->execute();
        while($r = $req->fetch()){
            $novidatumura = explode(" ", $r['ustvarjeno']);
            $datum = str_replace('-', '.', $novidatumura[0]);
            $ura = date('H:i',strtotime($novidatumura[1]));

            $datumexpl = explode(".", $datum);
            echo "<div class='naslov'><a href='index.php?stran=oglas&id=". $r['id'] ."'>" . $r['naslov'] . "</a></div>";
            echo "<div class=\"objavil\">Kategorija: ".z_kat($r['kategorija_id']). ", objavil: " . z_upo($r['uporabnik_id']) . ", dne: " . $datumexpl[2] . " " . date("M",strtotime($datumexpl[1])) . " " . $datumexpl[0] . " ob " . $ura . "<br>Cena: ".$r['cena']."€, Ocena: ".($r['ocena'] > 0 ? round(($r['ocena']/$r['st_ocen']),2) : '0.00')."</div>";
            echo nl2br($r['opis']) ."<br/><br/>";
        }
    }
    
}

?>