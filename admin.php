<?php
session_start();
if(isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->naziv=="admin"){
    include "modules/connection.php";
    include "views/admin/head.php";
    include "views/admin/header.php";
    require "models/Korisnik.php";
    require "models/Vest.php";
    require "models/Pitanje.php";
    require "models/Odgovor.php";
    require "models/Kategorija.php";
    require "models/Anketa.php";
    $a = new Anketa();
    $v = new Vest();
    $k = new Korisnik();
    $p = new Pitanje();
    $o = new Odgovor();
    $kat = new Kategorija();

    $korisnici = $k->getUsers($conn);
    if(isset($_GET['page'])){
        switch ($_GET['page']){
            case "users":
                $korisnici;
                include "views/admin/users.php";
                break;
            case "ostalo":
                $pitanja = $p->dohvatiPitanja($conn);
                $odgovori = $o->getAnswers($conn);
                $kategorije = $kat->getCategories($conn);
                include "views/admin/category.php";
                break;
            case "news":
                $kategorije = $kat->getCategories($conn);
                $vesti = $v->getNews($conn);
                include "views/admin/news.php";
                break;
            case "pregled":
                $najviseOdgovora = $a->getMostPopAnswers($conn);
                $najviseKomentara = $v->getMostComment(7,$conn);
                include "views/admin/pregled.php";
                break;
            default:
                $korisnici;
                include "views/admin/users.php";
                break;
        }
    }else{
        $korisnici;
        include "views/admin/users.php";
    }
    include "views/admin/footer.php";
}else {
    header("Location: index.php?page=home&pg=1");
}