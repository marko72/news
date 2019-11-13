<?php
header("Content-type: application/json");
$code = 404;
$data = null;
if(isset($_POST['poslato'])&&$_POST['poslato']=="da"){
    include "connection.php";
    require "../models/Anketa.php";
    require "../models/Odgovor.php";
    $a = new Anketa();
    $o = new Odgovor();
    $idKor = $_POST['idKor'];
    $odgovor = $_POST['odgovor'];

    $idPitanja = $o->getQuestionID($odgovor,$conn);
    $pitanjaKorisnika = $a->getUsersQuestionByAnswer($idKor, $conn);
    $pitanjaKorisnika = array_column($pitanjaKorisnika, "id_pitanje");
    if(in_array($idPitanja->id_pitanje,$pitanjaKorisnika)){
        $code = 409;
        $data = "Korisnik je vec odgovorio na ovo pitanje";
    }else{
        $rez = $a->insertUserAnswer($idKor,$odgovor,$conn);
        switch ($rez){
            case 201:
                $code = 201;
                $data = "uspesno";
                break;
            case 409:
                $code = 409;
                $data = "konflikt";
                break;
            case 500:
                $code = 500;
                $data = "Serverska greska";
                break;
        }
    }
}
echo json_encode($data);
http_response_code($code);