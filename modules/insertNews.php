<?php
session_start();
if(isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->naziv=="admin"){
    require "../models/Vest.php";
    $v = new Vest();
    include "connection.php";
    $greske = [];
    $idKor = $_POST['korisnik'];
    $naslov = $_POST['tbNaslov'];
    if($naslov==""){
        array_push($greske,"Morate uneti naslov");
    }
    $tekst = $_POST['taText'];
    if($tekst==""){
        array_push($greske,"Morate uneti tekst vesti!");
    }
    $datum = time();
    $idKat = $_POST['ddlKat'];
    if($idKat==0){
        array_push($greske,"Vest mora pripadati odredjenoj kategoriji!");
    }
    if(isset($_POST['idVest'])){
        $idVest = $_POST['idVest'];
    }


    //PREMESTANJE SLIKE I POSTAVLJANJE NOVOG IMENA SLIKE

    function premestiSliku($slika){
        global $greske;
        $maxVelicinaSlike = (2 *1024) *1024;

        if($slika['size']>$maxVelicinaSlike){
            array_push($greske,"Slika je veca od 2MB");
            return ;
        }
        else{
            $staroMesto = $slika['tmp_name'];
            $novoMesto = "../images/news/";
            $staroIme = $slika['name'];
            $novoIme = time().$staroIme;
            $novoMesto = $novoMesto.$novoIme;
            $dali = move_uploaded_file($staroMesto,$novoMesto);
            if(!$dali){
                array_push($greske,"Neuspesno premestanje slike");
            }
            return $novoIme;
        }

    }

//ISPITIVANJE DA LI SE UNOS SLIKE RADI SA

    $slika1 = "";
    $bezSlika = '';
    if($_FILES['slika']['name']!=""){
        $slika1 = $_FILES['slika'];
        $imeSlike1 = premestiSliku($slika1);
    }else{
        $bezSlika=1;
    }


    if(count($greske)==0){
        if(isset($_POST['btnInsertNews'])){
            $dali = $v->insertNews($naslov,$tekst,$idKor,$datum,$idKat,$imeSlike1,$conn);
            if($dali){
                $_SESSION['vest'] = "Uspesno uneta vest";
                header("Location: ../admin.php?page=news");
            }else{
                $_SESSION['greske'] = "Neuspesan unos slike u bazu";
                header("Location: ../admin.php?page=news");
            }
        }
        elseif (isset($_POST['btnIzmeni'])){
            if($bezSlika==1){
                $dali = $v->updateNews($naslov, $tekst, $datum, $idKor, $idKat, $idVest,0, $conn);
                if($dali){
                    $_SESSION['vest'] = "Uspesno izmenjena vest bez slike!";
                    header("Location: ../admin.php?page=news");
                }else{
                    $_SESSION['greske'] = "Nije uspeo update vesti bez slike";
                    header("Location: ../admin.php?page=news");
                }
            }else{
                $dali = $v->updateNews($naslov,$tekst,$datum,$idKor,$idKat, $idVest, $imeSlike1, $conn);
                if($dali){
                    $_SESSION['vest'] = "Uspesno izmenjena vest sa slikom!";
                    header("Location: ../admin.php?page=news");
                }else{
                    $_SESSION['greske'] = "Nije uspeo update vesti sa slikom";
                    header("Location: ../admin.php?page=news");
                }
            }
        }else{
            $_SESSION['greske'] = "Podaci nisu poslati na odgovarajuci nacin";
            header("Location: ../admin.php?page=news");
        }
    }
    else{
        var_dump($greske);
        $_SESSION['greske']=$greske;
        header("Location: ../admin.php?page=news");
    }

}else{
    header("Location: ../index.php?page=home&pg=1");
}
