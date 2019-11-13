<?php
session_start();
if($_SESSION['korisnik']){
    unset($_SESSION['korisnik']);
}else{
    header("Location: index.php?page=home");
}
session_destroy();
header("Location: ../index.php?page=home&pg=1");