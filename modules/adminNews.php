<?php
header("Content-type: application/json");
$code = 404;
$data = null;
include "connection.php";
require "../models/Vest.php";
$v = new Vest();
//KUPLJENJE PODATAKA O PROIZVODU I ISPISIVANJE U FORMU ZA EDITOVANJE

if(isset($_POST['getNews'])&&$_POST['getNews']=="da"){
    $idNews = $_POST['idNews'];
    $vest  = $v->getOneNews($idNews,$conn);
    if(is_object($vest)){
        $code = 201;
        $data = $vest;
    }else{
        switch ($vest){
            case 500:
                $code = 500;
                $data = "Serverska greska";
                break;
            case 409:
                $code = 409;
                $data = "Greska pri dohvatanju vesti";
                break;
        }
    }
}


//BRISANJE PROIZVODA


if(isset($_POST['delNews'])&&$_POST['delNews']=="da"){
    $idVest = $_POST['idVest'];
    $dali = $v->deleteNews($idVest,$conn);
    switch ($dali){
        case 201:
            $code = 201;
            $vesti = $v->getNews($conn);
            if($vesti){
                $data = $vesti;
            }else{
                $data = "Uspesno obrisano, ali greska pri dohvatanju proizvoda";
            }
            break;
        case 500:
                $code = 500;
                $data = "Serverska greska";
                break;
            case 409:
                $code = 409;
                $data = "Greska pri dohvatanju vesti";
                break;
        }
    }




echo json_encode($data);
http_response_code($code);
