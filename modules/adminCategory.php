<?php
header("Content-type: application/json");
$code = 404;
$data = null;
if(isset($_POST['insertCat'])&&$_POST['insertCat']=="da"){
    include "connection.php";
    include "../models/Kategorija.php";
    $kat = new Kategorija();
    $naziv = $_POST['nazivKat'];
    $rezultat = $kat->insertCategory($naziv,$conn);
    switch ($rezultat){
        case 201:
            $categories = $kat->getCategories($conn);
            if(is_array($categories)){
                $code = 201;
                $data = $categories;
            }else{
                $code = 500;
                $data = "Uspesno unet komentar, ali greska pri dohvatanju komentara";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom komentarisanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom komentarisanja";
            break;
    }
}
if(isset($_POST['delCat'])&&$_POST['delCat']=="da"){
    include "connection.php";
    include "../models/Kategorija.php";
    $kat = new Kategorija();
    $idKat = $_POST['idKat'];
    $rezultat = $kat->deleteCategory($idKat,$conn);
    switch ($rezultat){
        case 201:
            $categories = $kat->getCategories($conn);
            if(is_array($categories)){
                $code = 201;
                $data = $categories;
            }else{
                $code = 500;
                $data = "Uspesno unet komentar, ali greska pri dohvatanju komentara";
            }
            break;
        case 500:
            $code = 500;
            $data = "Serverska greska prilikom komentarisanja";
            break;
        case 409:
            $code = 409;
            $data = "Greska prilikom komentarisanja";
            break;
    }
}
http_response_code($code);
echo json_encode($data);