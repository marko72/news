<?php
session_start();
if (isset($_POST['btnLogin'])){
    include "connection.php";
    include "../models/Korisnik.php";
    $k = new Korisnik();
    $username = "";
    $passwd = "";
    $paternUser = "/[A-z]{3,12}[0-9]{0,8}(((\s|\_|\.|\-)|\_{1,3})([A-z]{1,12}|[0-9]{1,8}){1,2}){0,2}/";
    $paternPasswd = "/[\w\S]{5,}[\d]{1,10}/";
    $greske = [];
    if(isset($_POST['tbUser'])&&$_POST['tbUser']!=""){
        $username = $_POST['tbUser'];
    }else{
        array_push($username,"username nije posalt");
    }
    if(isset($_POST['tbPasswd'])&&$_POST['tbPasswd']!=""){
        $passwd = $_POST['tbPasswd'];
    }else{
        array_push($passwd,"Passwd nije poslan");
    }
    if(!preg_match($paternUser, $username)){
        array_push($greske, "Username nije u skladu sa paternom");
    }
    if(!preg_match($paternPasswd, $passwd)){
        array_push($greske, "Lozinka nije u obliku kakavom bi trebalo da bude");
    }
    if(count($greske)!=0){
        $_SESSION['greska']=$greske;
    }else{
        $user = $k->getUserLogin($username,$passwd,$conn);
        if(is_object($user)){
            $_SESSION['korisnik'] = $user;
        }
        switch ($user){
            case 500:
                $_SESSION['greska']="Serverska greska";
                break;
            case 409:
                $_SESSION['greska']="Nema korisnika u bazi";
                break;
        }
    }
header("Location: ../index.php?page=home&pg=1");
}
else{
    header("Location: ../index.php?page=home&pg=1");
}