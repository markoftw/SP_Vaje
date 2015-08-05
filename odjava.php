<?php
    setcookie("prijavljen", $_SESSION['Uporabnik'], time()-86400);
    session_destroy();
    header("Location: index.php");
?>