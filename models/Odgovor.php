<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/22/2019
 * Time: 11:15 PM
 */

class Odgovor
{
    function getAnswers($conn){
        return executeQuery("SELECT *  FROM odgovor o INNER JOIN pitanje p ON o.pitanje_id=p.id_pitanje");
    }
    function getAnswersByID($idPitanje,$conn){
        return dohvatiNaOsnovuID("SELECT * FROM odgovor WHERE pitanje_id=:id",$idPitanje,1);
    }
    function insertAnswer($odgovor, $idPitanje, $conn){
        $upit = "INSERT INTO odgovor SET odgovor=:odgovor, pitanje_id=:idPitanje";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":odgovor",$odgovor);
        $priprema->bindParam(":idPitanje",$idPitanje);
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
    function deleteAnwer($idOdg, $conn){
        $upit = "DELETE FROM odgovor WHERE id_odgovor=:idOdg";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idOdg",$idOdg);
        try{
            $priprema->execute();
            if($priprema->rowCount()){
                return 201;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    function getQuestionID($idOdg, $conn){
        $upit = 'SELECT id_pitanje FROM pitanje p INNER JOIN odgovor o ON o.pitanje_id=p.id_pitanje WHERE o.id_odgovor=:id';
        return dohvatiNaOsnovuID($upit,$idOdg);
    }
}