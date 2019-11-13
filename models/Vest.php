<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/20/2019
 * Time: 8:47 PM
 */

class Vest
{
    function getNews($conn){
        $upit =
            "SELECT *, datum AS datum_vesti 
              FROM vest v 
              INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id 
              INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik 
              GROUP BY v.id_vest ";
        try{
            $rezultat = $conn->query($upit)->fetchAll();
            if($rezultat){
                return $rezultat;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function getOneNews($idNews,$conn){
        $upit =
            "SELECT * 
              FROM vest v              
              INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id 
              INNER JOIN kategorija ka ON v.kategorija_id=ka.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik 
              WHERE id_vest=:idNews";
        $priprema  = $conn->prepare($upit);
        $priprema->bindParam(":idNews",$idNews);
        try{
            $priprema->execute();
            $rezultat = $priprema->fetch();
            if($rezultat){
                return $rezultat;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }
    function deleteNews($idVest, $conn){
        $upit = "DELETE FROM slika_vest WHERE vest_id=:idVest";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idVest",$idVest);
        try{
            $conn->beginTransaction();
            $priprema->execute();
            if($priprema->rowCount()){
                $obrisiKomentare = "DELETE FROM komentar WHERE vest_id=:idVest";
                $brisanjeKomentara = $conn->prepare($obrisiKomentare);
                $brisanjeKomentara->bindParam(":idVest",$idVest);
                try{
                    $rez1 = $brisanjeKomentara->execute();
                    if($rez1){
                        $obrisiVest = "DELETE FROM vest WHERE id_vest=:idVest";
                        $brisanjeVesti = $conn->prepare($obrisiVest);
                        $brisanjeVesti->bindParam(":idVest",$idVest);
                        try{
                            $brisanjeVesti->execute();
                            if($brisanjeVesti->rowCount()){
                                $conn->commit();
                                return 201;
                                //Prebaciti izvan

                                //$data = getNews($conn);
                            }else{
                                $conn->rollBack();
                                return 500;
                                //$data = "Ne postoji ta vest";
                            }
                        }catch (PDOException $e){
                            $conn->rollBack();
                            return 409;
                            //$data = "Nema te vesti";
                        }
                    }else{
                        $conn->rollBack();
                        return 500;
                        //$data = "Serverska greska pri brisanju lajkova vesti";
                    }
                }catch (PDOException $e){
                    $conn->rollBack();
                    return 409;
                    //$data = "Nema te vesti (komentar)";
                }
            }else{
                $conn->rollBack();
                return 500;
                //$data = "Serverska greska prilikom brisanja slike vesti";
            }
        }catch (PDOException $e){
            $conn->rollBack();
            return 409;
            //$data = "Nema te vesti (slika)";
        }
    }

    function insertNews($naslov, $tekst, $idKor, $datum, $idKat, $imeSlike1, $conn){

        $unosVesti = "INSERT INTO vest SET naslov=:naslov, tekst=:tekst, korisnik_id=:korId, datum=:datum, kategorija_id=:idKat";
        $priprema = $conn->prepare($unosVesti);
        $priprema->bindParam(":naslov",$naslov);
        $priprema->bindParam(":tekst",$tekst);
        $priprema->bindParam(":korId",$idKor);
        $priprema->bindParam(":datum",$datum);
        $priprema->bindParam(":idKat",$idKat);
        try{
            $conn->beginTransaction();
            $priprema->execute();
            if($priprema->rowCount()==1){
                $idVesti = $conn->lastInsertId();
                $dali = $this->ubaciSlikuUBazu($imeSlike1,$idVesti,$naslov,0,$conn);
                if($dali!=false){
                    $conn->commit();
                    return true;
                    //$_SESSION['vest'] = "Uspesno uneta vest";
                    //header("Location: ../../../admin.php?page=news");
                }else{
                    $conn->rollBack();
                    return false;
                    //$_SESSION['greske'] = "Neuspesan unos slike u bazu";
                    //header("Location: ../../../admin.php?page=news");
                }
            }
            else{
                $conn->rollBack();
                return false;
                //$_SESSION['greske'] = "Serverska greska pri unosu vesti!";
                //header("Location: ../../../admin.php?page=news");
            }
        }catch (PDOException $e){
            $conn->rollBack();
            return false;
            //header("Location: ../../../admin.php?page=news");
        }
    }
    //RADNJA SA SLIKOM


    //PARAMETAR insertUpdate SLUZI DA SE UTVRDI DA LI SE VRSI UNOS ILI IZMENA SLIKE U BAZU, UKOLIKO JE ON JEDNAK 1 TADA SE VRSI IZMENA
    //U SUPROTNOM SE VRSI INSERT SLIKE
    function ubaciSlikuUBazu($imeSlike,$idVesti,$naslov,$insertUpdate=0,$conn){
        $alt = strtolower($naslov);
        $greske = [];
        $putanja = $imeSlike;
        if($insertUpdate==1){
            $updateSLike = "UPDATE slika_vest SET putanja=:putanja, alt=:alt WHERE vest_id=:id";
            $priprema = $conn->prepare($updateSLike);
        }else{
            $unosSlike="INSERT INTO slika_vest SET vest_id=:id, putanja=:putanja, alt=:alt";
            $priprema = $conn->prepare($unosSlike);
        }
        $priprema->bindParam(":id",$idVesti);
        $priprema->bindParam(":putanja",$putanja);
        $priprema->bindParam(":alt",$alt);

        try{
            $priprema->execute();
            if(!$priprema->rowCount()){
                array_push($greske,"Neuspesan unos slike u bazu");
                return false;
            }else{
                return true;
            }
        }catch (PDOException $e){
            array_push($greske,$e->getMessage());
            return false;
        }
    }

    //RADNJA SA SLIKOM

    function updateNews($naslov, $tekst, $datum, $idKor, $idKat, $idVest, $withImg, $conn){
        $updateVesti = "UPDATE vest SET naslov=:naslov, tekst=:tekst, datum=:datum, korisnik_id=:idKor, kategorija_id=:idKat 
                        WHERE id_vest=:idVest";
        $priprema = $conn->prepare($updateVesti);
        $priprema->bindParam(":naslov",$naslov);
        $priprema->bindParam(":tekst",$tekst);
        $priprema->bindParam(":datum",$datum);
        $priprema->bindParam(":idKor",$idKor);
        $priprema->bindParam(":idKat",$idKat);
        $priprema->bindParam(":idVest",$idVest);
        try{
            $conn->beginTransaction();
            $priprema->execute();
            if($priprema->rowCount()){
                if($withImg==0){
                    $conn->commit();
                    return true;
                    /*$_SESSION['vest']="Uspesno izmenjena vest";
                    header("Location: ../../../admin.php?page=news");*/
                }else{
                    $imeSlike = $withImg;
                    $insertUpdate = 1;
                    $dali = $this->ubaciSlikuUBazu($imeSlike,$idVest,$naslov,$insertUpdate,$conn);
                    if(!is_string($dali)){
                        $conn->commit();
                        return true;
                        /*$_SESSION['vest']="Uspesno izmenjena vest";
                        header("Location: ../../../admin.php?page=news");*/
                    }else{
                        $conn->rollBack();
                        return false;
                        /*$_SESSION['greske'] = "Doslo je do serverske greske prilikom postavljena slika i izmene vesti";
                        header("Location: ../../../admin.php?page=news");*/
                    }
                }
            }
            else{
                $conn->rollBack();
                return false;
                /*array_push($greske,"Serverska greska pri update-u");
                $_SESSION['greske']=$greske;
                header("Location: ../../../admin.php?page=news");*/
            }
        }catch (PDOException $e){
            $conn->rollBack();
            return false;
            /*array_push($greske,"Podaci su identični kao što su i bili".$e->getMessage());
            header("Location: ../admin.php?admin=unos");*/
        }
    }

    function getMostComment($brojVesti,$conn){
        $upit =
            "SELECT * FROM vest v 
              INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id 
              INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik 
              GROUP BY v.id_vest 
              ORDER BY broj_komentara DESC
              LIMIT 0,$brojVesti";
        return executeQuery($upit);
    }

    function getLatestNews($conn){
        $upit =
            "SELECT * FROM vest v 
              INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id 
              INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik 
              GROUP BY v.id_vest 
              ORDER BY datum DESC
               LIMIT 0,3";
        return executeQuery($upit);
    }
    function paginateNews($prikaziOd,$brojVestiPoStrani, $conn){
        $dohvatiVesti = "SELECT *,v.datum AS datum_vesti FROM vest v INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
                                                  INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik GROUP BY v.id_vest ORDER BY datum_vesti DESC LIMIT $prikaziOd,$brojVestiPoStrani";
        return executeQuery($dohvatiVesti);
    }

    function getNewsByCategory($idCat, $conn){
        $dohvatiVestiKategorije = "SELECT * FROM vest v INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik WHERE kat.id_kat=:id GROUP BY v.id_vest ";
        return dohvatiNaOsnovuID($dohvatiVestiKategorije,$idCat,1);
    }
    function getNewsById($idVesti, $conn){
        $dogvatiVest = "SELECT * FROM vest v INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id INNER JOIN kategorija ka ON v.kategorija_id=ka.id_kat
              INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik WHERE id_vest=:id";
        return dohvatiNaOsnovuID($dogvatiVest,$idVesti);
    }
}