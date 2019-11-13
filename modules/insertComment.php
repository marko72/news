<?php
header("Content-type: application/json");
$code = 404;
$data = null;
if(isset($_POST['insertComm'])&&$_POST['insertComm']=="da"){
    include "connection.php";
    include "../models/Komentar.php";
    $k = new Komentar();
    $tekst = $_POST['tekst'];
    $idKor = $_POST['idKor'];
    $idVest = $_POST['idVest'];
    $date = time();
    $rez = $k->comment($idKor,$idVest,$tekst,$date,$conn);
    if($rez==201){
        $komentari = $k->getComments($idVest,$conn);
        if(is_array($komentari)){
            foreach ($komentari as $kom){
                $kom->date=date("d.m.y. i:h:s",$kom->date);
            }
            $code = 200;
            $data = $komentari;
        }else{
            if($komentari==500){
                $code = 500;
                $data = "Serverska greška prilikom komentarisanja";
            }elseif ($komentari ==409){
                $code = 409;
                $data = "Greška prilikom komentarisanja";
            }
        }
    }else{
        $code = 500;
        $data = $rez;
    }
}
http_response_code($code);
echo json_encode($data);