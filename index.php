<?php
session_start();
include "modules/connection.php";
include "views/head.php";
include "views/header.php";
require "models/Vest.php";
require "models/Kategorija.php";
$k = new Kategorija();
$v = new Vest();
$page = 'home';
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
switch ($page){
    case "home":
        require "models/Odgovor.php";
        require "models/Pitanje.php";
        $p = new Pitanje();
        $o = new Odgovor();
        $kategorije = $k->getCategories($conn);
        $vesti = $v->getNews($conn);
        if(isset($_GET['pg'])){
            $ukupnoVesti = count($vesti);
            $brojVestiPoStrani = 3;
            $brojStrana = ceil($ukupnoVesti/$brojVestiPoStrani);
            $pg=$_GET['pg'];
            $prikaziOd= ($pg-1)*$brojVestiPoStrani;
            $vestiPG = $v->paginateNews($prikaziOd,3,$conn);
        }
        include "views/home.php";
        break;
    case "contact":
        include "views/contact.php";
        break;
    case "author":
        include "views/author.php";
        break;
    case "post":
        require "models/Komentar.php";
        $kom = new Komentar();
        $kategorije = $k->getCategories($conn);
        if(isset($_GET['id'])){
            $idVesit =$_GET['id'];
            $vest = $v->getNewsById($idVesit,$conn);
            $komentari = $kom->getNewsComments($idVesit,$conn);
        }
        include "views/single-post.php";
        break;
    case "all-posts":
        $vesti = $v->getNews($conn);
        $kategorije = $k->getCategories($conn);
        if(isset($_GET['id'])){
            $idKat = $_GET['id'];
            $vesti = $v->getNewsByCategory($idKat,$conn);
        }elseif(isset($_GET['pop'])){
            $vestiPOP = $v->getMostComment(5,$conn);
        }elseif (isset($_GET['pg'])){
            $ukupnoVesti = count($vesti);
            $brojVestiPoStrani = 5;
            $brojStrana = ceil($ukupnoVesti/$brojVestiPoStrani);
            $pg=$_GET['pg'];
            $prikaziOd= ($pg-1)*$brojVestiPoStrani;
            $vestiPG = $v->paginateNews($prikaziOd,$brojVestiPoStrani,$conn);
        }
        include "views/posts.php";
        break;
    case "about":
        include "views/about.php";
        break;
    case "registration":
        include "views/registration.php";
        break;
    default:
        include "views/home.php";
        break;
}
include "views/footer.php";