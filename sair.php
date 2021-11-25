<?php
    session_start();
    session_destroy();
    header("location: vitrine-busca.php?inicial=1");
?>