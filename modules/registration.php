<?php
header("Content-Type: application/json");
$code = 404;
$data = null;
if(isset($_POST['poslato'])&&$_POST['poslato']=="da"){
    include "connection.php";
    include "../models/Korisnik.php";
    $k = new Korisnik();
    $paternImePrezime = "/^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/";
    $paternPasswd = "/[\w\S]{5,}[\d]{1,10}/";
    $paternUser = "/^[A-z]{3,12}[0-9]{0,8}(((\_|\.|\-)|\_{0,3})([A-z]{1,12}|[0-9]{1,8}){1,2}){0,2}$/";

    $greske = [];

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    if(!preg_match($paternImePrezime,$ime)){
        array_push($greske,"Ime nije u skladu sa pravilima");
    }
    if(!preg_match($paternImePrezime,$prezime)){
        array_push($greske,"Prezime nije u skladu sa pravilima");
    }
    if(!preg_match($paternUser,$username)){
        array_push($greske,"Username nije u skladu sa pravilima");
    }
    if(!isset($_POST['izmena'])){
        $passwd = $_POST['passwd'];
        if(!preg_match($paternPasswd,$passwd)){
            array_push($greske,"Lozinka nije u odgovarajucem formatu");
        }
    }else{
        $currPass = $_POST['currPass'];
        if(!preg_match($paternPasswd,$currPass)){
            array_push($greske,"Lozinka nije u odgovarajucem formatu");
        }
        $currPass = md5($_POST['currPass']);
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($greske,"Email nije u skladu sa pravilima");
    }
    if(count($greske)==0){
        if(isset($_POST['izmena'])){
            $idKor = $_POST['idKor'];
            $rezultat = $k->updateUser($ime,$prezime,$username,$email,$idKor,$currPass,$conn);
            if($rezultat==200){
                $code=200;
                $data = "Uspesno izmenjen korisnik";
            }elseif($rezultat==409){
                $code=409;
                $data="Korisnik sa tim podacima vec postoji";
            }else{
                $code = 500;
                $data = "Serverska greska";
            }
        }else{
            $passwd = md5($passwd);
            $kod = time().md5($email);
            $rezultat = $k->insertUser($ime,$prezime,$username,$passwd,$email,$kod,$conn);
            if($rezultat==201){
                $code=201;
                $data = "Uspesno unet korisnik";
            }elseif($rezultat==409){
                $code=409;
                $data="Korisnik sa tim podacima vec postoji";
            }else{
                $code = 500;
                $data = "Serverska greska";
            }
        }
    }else{
        $code=422;
        $data = $greske;
    }
}
echo json_encode($data);
http_response_code($code);