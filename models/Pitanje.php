<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/22/2019
 * Time: 10:33 PM
 */

class Pitanje
{
    function dohvatiPitanja($conn){
        $pitanja = executeQuery("SELECT * FROM pitanje");
        return $pitanja;
    }
    function insertQuestion($pitanje, $conn){
        $upit = "INSERT INTO pitanje SET pitanje=:pitanje";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":pitanje",$pitanje);
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
    function deleteQuestion($idPitanje, $conn){
        $upit = "DELETE FROM pitanje WHERE id_pitanje=:idPitanje";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idPitanje",$idPitanje);
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
}