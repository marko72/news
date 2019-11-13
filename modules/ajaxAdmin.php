<?php
header("Content-type: application/json");
$code = 404;
$data = null;
require "../models/Korisnik.php";
require "connection.php";
$k = new Korisnik();
if(isset($_POST['updateUsr'])&&$_POST['updateUsr']=="da"){
    $idKor = $_POST['idKor'];
    $aktivan  = $_POST['aktivan'];
    $uloga  = $_POST['uloga'];
    $rezultat = $k->updateAdmin($aktivan, $uloga,$idKor,$conn);
    switch ($rezultat){
        case 201:
            $code=201;
            $data = "Uspesno izmenjen korisnik";
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska";
            break;
        case 409:
            $code = 409;
            $data = "Conflict";
            return;
    }
}
if(isset($_POST['deleteUsr'])&&$_POST['deleteUsr']=="da"){
    $idKor = $_POST['idKor'];
    $obrisan = $k->deleteUser($idKor,$conn);
    switch ($obrisan){
        case 201:
            $code = 201;
            $data = $k->getUsers($conn);
            foreach ($data as $d) {
                $d->datum_reg = date("d.m.Y",$d->datum_reg);
            }
            break;
        case 409:
            $code = 409;
            $data = "Konflikt";
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska";
            break;
    }
}
http_response_code($code);
echo json_encode($data);