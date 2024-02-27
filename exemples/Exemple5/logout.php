<?php
    session_start();

    $_SESSION["role"] = null;

    header("Location: index.php");
