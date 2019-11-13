<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/21/2019
 * Time: 10:55 PM
 */

class Komentar
{
    function comment($idKor, $idVest, $tekst, $date, $conn){
        $upit = "INSERT INTO komentar SET korisnik_id=:idKor,vest_id=:idVest,tekst=:tekst,date=:date";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idKor",$idKor);
        $priprema->bindParam(":idVest",$idVest);
        $priprema->bindParam(":tekst",$tekst);
        $priprema->bindParam(":date",$date);
        try{
            $priprema->execute();
            if($priprema->rowCount()){
                $updateVesti = 'UPDATE vest SET broj_komentara=(broj_komentara+1) WHERE id_vest=:idVest';
                $priprema1 = $conn->prepare($updateVesti);
                $priprema1->bindParam(":idVest",$idVest);
                try{
                    $priprema1->execute();
                    if($priprema1->rowCount()){
                        return 201;
                    }else{
                        return 500;
                    }
                }catch (PDOException $e){
                    return $e->getMessage();
                }
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }
    function getComments($idVest, $conn){
        $upit = "SELECT *, kom.tekst AS tekst_komentara FROM komentar kom INNER JOIN vest v ON kom.vest_id=v.id_vest 
                 INNER JOIN korisnik kor ON kom.korisnik_id=kor.id_korisnik WHERE v.id_vest=:idVest";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idVest",$idVest);
        try{
            $rez = $priprema->execute();
            if($rez){
                $komentari = $priprema->fetchAll();
                return $komentari;
            }else{
                return 500;
                //$data = "Serverska greska pri unosu kategorija!";
            }
        }catch (PDOException $e){
            return 409;
            //$data = "Ne moze se uneti kategorija!";
        }
    }
    function deleteComment($idKom,$conn){
        $upit = "DELETE FROM komentar WHERE id_komentar=:idKom";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idKom",$idKom);
        try{
            $priprema->execute();
            if($priprema->rowCount()){
                return 201;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }

    function getNewsComments($idVesti,$conn){
        $dohvatiKomentare = "SELECT *,kom.tekst AS text_komentara FROM komentar kom INNER JOIN vest v ON kom.vest_id=v.id_vest INNER JOIN korisnik kor ON kom.korisnik_id=kor.id_korisnik WHERE id_vest=:id";
        return dohvatiNaOsnovuID($dohvatiKomentare,$idVesti,1);
    }
}