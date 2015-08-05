<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="slog.css" />
        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="funkcije.js"></script>
        <title>Oglasi</title>
        <?php
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            session_start();
            if (isset($_COOKIE['prijavljen'])){
                $_SESSION['Uporabnik'] = $_COOKIE['prijavljen'];
            }
        ?>
    </head>
    <body>
        <header>
           Oddaja spletnih oglasov
        </header>
        <section>
            <div class="ikona"><a href="index.php"><img src='home.png' title='Domov' alt='Domov'/></a></div>
            <?php if (isset($_SESSION['Uporabnik'])){ echo "<a href='index.php?stran=oddaj'>Oddaj oglas</a><br/>"; } ?>
            <?php if (isset($_SESSION['Uporabnik'])){ echo "<a href='index.php?stran=uredi'>Urejanje oglasov</a><br/>"; } ?>
            <?php if (isset($_SESSION['Uporabnik'])){ echo "<a href='index.php?stran=kategorije'>Urejanje kategorij</a><br/>"; } ?>
            <?php if (!isset($_SESSION['Uporabnik'])){ 
                echo "<a href='index.php?stran=registracija'>Registracija</a><br/>"; 
                echo "<a href='index.php?stran=prijava'>Prijava</a>";
            } 
            ?>
            <?php if (isset($_SESSION['Uporabnik'])){ 
                echo "<a href='index.php?stran=odjava'>Odjava</a>";
                echo "<br/><br/>Prijavljeni ste kot:<br/><b id='uporIme'>" . $_SESSION['Uporabnik'] . "</b> (".$_SESSION['Ime']." ".$_SESSION['Priimek'].")<br/>";
                echo "Vaš IP je:<br/>";
                echo $_SERVER['REMOTE_ADDR'];
            } 
            ?> 
        </section>
        <aside>
            <div class="novice">
            <?php
                if(isset($_GET['stran'])){
                    if($_GET['stran'] == 'registracija'){
                        include 'registracija.php';
                    } elseif ($_GET['stran'] == 'prijava') {
                        include 'prijava.php';
                    } elseif ($_GET['stran'] == 'oddaj') {
                        include 'oddaj.php';
                    } elseif ($_GET['stran'] == 'uredi') {
                        include 'uredi.php';
                    } elseif ($_GET['stran'] == 'kategorije') {
                        include 'kategorije.php';
                    } elseif ($_GET['stran'] == 'odjava') {
                        include 'odjava.php';
                    } elseif ($_GET['stran'] == 'oglas' && isset($_GET['id'])) {
                        include 'oglas.php';
                    } else { 
                        header("Location: index.php");
                    }
                } else {
                    include "seznam.php";
                }
            ?>
            </div>
        </aside>
    </body>
</html>
