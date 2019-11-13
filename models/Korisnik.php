<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/20/2019
 * Time: 6:58 PM
 */

class Korisnik
{
    function insertUser($ime, $prezime, $username, $passwd, $email, $kod, $conn)
    {
        $aktivan = 1;
        $uloga = 2;
        $datum = time();
        $unesiKorisnika = "INSERT INTO korisnik(ime, prezime, username, passwd, email, aktivan,kod, uloga_id, datum_reg) 
                                    VALUES (:ime,:prezime,:username,:passwd,:email, :aktivan,:kod,:uloga,:datum)";
        $priprema = $conn->prepare($unesiKorisnika);
        $priprema->bindParam(":ime", $ime);
        $priprema->bindParam(":prezime", $prezime);
        $priprema->bindParam(":username", $username);
        $priprema->bindParam(":passwd", $passwd);
        $priprema->bindParam(":email", $email);
        $priprema->bindParam(":aktivan", $aktivan);
        $priprema->bindParam(":kod", $kod);
        $priprema->bindParam(":uloga", $uloga);
        $priprema->bindParam(":datum", $datum);
        try {
            $priprema->execute();
            if ($priprema->rowCount()) {
                return 201;
            } else {
                return 500;
            }
        } catch (PDOException $e) {
            return 409;
        }
    }

    function getUser($idKor, $conn)
    {
        $upit = "SELECT * FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.id_uloga WHERE id_korisnik=:idKor";
        $prepare = $conn->prepare($upit);
        $prepare->bindParam("idKor", $idKor);
        try {
            $prepare->execute();
            $rezultat = $prepare->fetch();
            if ($rezultat) {
                return $rezultat;
            } else {
                return 502;
            }
        } catch (PDOException $e) {
            return 509;
        }
    }

    function getUserLogin($username, $passwd, $conn)
    {
        $upit = "SELECT * FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.id_uloga WHERE username=:username AND passwd=:passwd AND aktivan=1";
        $passwd = md5($passwd);
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":username", $username);
        $priprema->bindParam(":passwd", $passwd);
        try {
            $priprema->execute();
            if ($priprema->rowCount()) {
                $rezultat = $priprema->fetch();
                return $rezultat;
            } else {
                return 500;
            }

        } catch (PDOException $e) {
            return 409;
        }
    }

    function updateAdmin($aktivan, $uloga, $idKor, $conn){
        $upit = "UPDATE korisnik SET aktivan=:aktivan, uloga_id=:uloga WHERE id_korisnik=:idKor";
        $prepare = $conn->prepare($upit);
        $prepare->bindParam(":aktivan",$aktivan);
        $prepare->bindParam(":uloga",$uloga);
        $prepare->bindParam(":idKor",$idKor);
        try{
            $prepare->execute();
            if($prepare->rowCount()){
                return  201;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }
    function deleteUser($idKor,$conn){
        $upit1 = "DELETE FROM korisnik_odgovor WHERE korisnik_id=:idKor";
        $prepare1 = $conn->prepare($upit1);
        $prepare1->bindParam(":idKor",$idKor);
        $conn->beginTransaction();
        try{
            $rez = $prepare1->execute();
            if($rez){
                $upit2 = "DELETE FROM korisnik WHERE id_korisnik=:idKor";
                $prepare2 = $conn->prepare($upit2);
                $prepare2->bindParam(":idKor",$idKor);
                try{
                    $prepare2->execute();
                    if($prepare2->rowCount()){
                        $conn->commit();
                        return 201;
                    }else{
                        $conn->rollBack();
                        return 500;
                        //$data = "Serverska greska kod brisanja korisnika";
                    }
                }catch (PDOException $e){
                    $conn->rollBack();
                    //$data = $e->getMessage();
                    return 409;
                }

            }else{
                $conn->rollBack();
                //$data = "Serverska greska lajk";
                return 500;
            }
        }catch (PDOException $e){
            $conn->rollBack();
            return 409;
            //$data = "lose obrisan lajk";
        }
    }
    function getUsers ($conn){
        $upit = "SELECT * FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.id_uloga";
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
    function updateUser($ime,$prezime,$username,$email,$idKor,$currPass,$conn)
    {
        $unesiKorisnika = "UPDATE korisnik SET ime=:ime, prezime=:prezime, username=:username, email=:email 
                        WHERE id_korisnik=:idKor AND passwd=:curPasswd";
        $priprema = $conn->prepare($unesiKorisnika);
        $priprema->bindParam(":ime", $ime);
        $priprema->bindParam(":prezime", $prezime);
        $priprema->bindParam(":username", $username);
        $priprema->bindParam(":email", $email);
        $priprema->bindParam(":idKor", $idKor);
        $priprema->bindParam(":curPasswd", $currPass);
        try {
            $priprema->execute();
            if ($priprema->rowCount()) {
                return 200;
            } else {
                return 500;
            }
        } catch (PDOException $e) {
            return 409;
        }
    }
}