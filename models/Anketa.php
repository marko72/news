<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/22/2019
 * Time: 5:48 PM
 */

class Anketa
{
    function getUsersQuestionByAnswer($idKor,$conn){
        $upit = "SELECT id_pitanje FROM pitanje p INNER JOIN odgovor o ON p.id_pitanje=o.pitanje_id INNER JOIN korisnik_odgovor ko 
                  ON ko.odgovor_id=o.id_odgovor WHERE ko.korisnik_id=:idKor GROUP BY id_pitanje";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idKor",$idKor);
        try{
            $rez = $priprema->execute();
            if($rez){
                $pitanjaKorisnika = $priprema->fetchAll();
                /*if(is_array($pitanjaKorisnika)){
                    if(count($pitanjaKorisnika)==0){
                        $pitanjaKorisnika = [-1];
                        return $pitanjaKorisnika;
                    }else{
                        return $pitanjaKorisnika;
                    }
                }else{
                    return 500;
                }*/
                return $pitanjaKorisnika;
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    function insertUserAnswer($idKor, $odgovor, $conn){
        $upit = "INSERT INTO korisnik_odgovor SET korisnik_id=:id, odgovor_id=:odgovor";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":id",$idKor);
        $priprema->bindParam(":odgovor",$odgovor);
        try{
            $priprema->execute();
            if($priprema->rowCount()){
                return 201;
            }else{
                return 500;
                //$data = "Serverska greska pri unosu odgovora!";
            }
        }catch (PDOException $e){
            return $e->getMessage();
            //$data = $e->getMessage();
        }
    }

    //NAJVIŠE ODGOVORA NA ANKETU

    function getMostPopAnswers($conn){
        $upit = "SELECT *,COUNT(o.id_odgovor) AS broj_odgovora FROM korisnik_odgovor ko INNER JOIN odgovor o ON ko.odgovor_id=o.id_odgovor INNER JOIN pitanje p ON o.pitanje_id=p.id_pitanje GROUP BY o.id_odgovor ORDER BY broj_odgovora DESC ";
        return executeQuery($upit);
    }
}