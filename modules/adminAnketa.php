<?php
header("Content-type: application/json");
$code = 404;
$data = null;

//UNOS PITANJA


if(isset($_POST['insertPitanje'])&&$_POST['insertPitanje']=="da"){
    include "connection.php";
    include "../models/Pitanje.php";
    $p = new Pitanje();
    $pitanje = $_POST['pitanje'];
    $rezultat = $p->insertQuestion($pitanje,$conn);
    switch ($rezultat){
        case 201:
            $questions = $p->dohvatiPitanja($conn);
            if(is_array($questions)){
                $code = 201;
                $data = $questions;
            }else{
                $code = 500;
                $data = "Uspesno uneto pitanje, ali greska pri dohvatanju pitanja";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom unošenja pitanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom unošenja pitanja";
            break;
    }
}

//BRISANJE PRITANJA


if(isset($_POST['deleteQuestion'])&&$_POST['deleteQuestion']=="da"){
    include "connection.php";
    include "../models/Pitanje.php";
    $p = new Pitanje();
    $idPitanja = $_POST['idPitanja'];
    $rezultat = $p->deleteQuestion($idPitanja,$conn);
    switch ($rezultat){
        case 201:
            $questions = $p->dohvatiPitanja($conn);
            if(is_array($questions)){
                $code = 201;
                $data = $questions;
            }else{
                $code = 500;
                $data = "Uspesno izbrisano pitanje, ali greska pri dohvatanju pitanja";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom brisanja pitanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom brisanja pitanja";
            break;
    }
}


//DOHVATANJE ODGOVORA NA PITANJE


if(isset($_POST['getAnswersByID'])&&$_POST['getAnswersByID']=="da"){
    include "connection.php";
    include "../models/Odgovor.php";
    $o = new Odgovor();
    $idPitanja = $_POST['idPitanja'];
    $odgovori = $o->getAnswersByID($idPitanja,$conn);
    if(is_array($odgovori)){
        $code = 201;
        $data = $odgovori;
    }else{
        $code = 500;
        $data = "SERVERSKA GRESKA";
    }
}


//UNOŠENJE ODGOVORA NA PITANJE


if(isset($_POST['insertAnswer'])&&$_POST['insertAnswer']=="da"){
    include "connection.php";
    include "../models/Odgovor.php";
    $o = new Odgovor();
    $odgovor = $_POST['odgovor'];
    $idPitanja = $_POST['idPitanja'];
    $rezultat = $o->insertAnswer($odgovor,$idPitanja,$conn);
    switch ($rezultat){
        case 201:
            $questions = $o->getAnswersByID($idPitanja,$conn);
            if(is_array($questions)){
                $code = 201;
                $data = $questions;
            }else{
                $code = 500;
                $data = "Uspesno izbrisano pitanje, ali greska pri dohvatanju pitanja";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom brisanja pitanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom brisanja pitanja";
            break;
    }
}

//BRISANJE ODGOVORA

if(isset($_POST['deleteAnswer'])&&$_POST['deleteAnswer']=="da"){
    include "connection.php";
    include "../models/Odgovor.php";
    $o = new Odgovor();
    $idOdg = $_POST['idOdg'];
    $idPitanja = $_POST['idPitanja'];
    $rezultat = $o->deleteAnwer($idOdg,$conn);
    switch ($rezultat){
        case 201:
            $questions = $o->getAnswersByID($idPitanja,$conn);
            if(is_array($questions)){
                $code = 201;
                $data = $questions;
            }else{
                $code = 500;
                $data = "Uspesno izbrisano pitanje, ali greska pri dohvatanju pitanja";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom brisanja pitanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom brisanja pitanja";
            break;
    }
}

if(isset($_POST['getQuestions'])&&$_POST['getQuestions']=="da"){
    include "connection.php";
    include "../models/Pitanje.php";
    $p = new Pitanje();
    $pitanja = $p->dohvatiPitanja($conn);
    if(is_array($pitanja)){
        $code = 201;
        $data = $pitanja;
    }else{
        $code=500;
        $data = "Nema pitanja";
    }
}

http_response_code($code);
echo json_encode($data);