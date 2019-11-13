<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 2/22/2019
 * Time: 12:35 AM
 */

class Kategorija
{
    function insertCategory($naziv, $conn){
        $upit = "INSERT INTO kategorija SET naziv=:naziv";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":naziv",$naziv);
        try{
            $priprema->execute();
            if($priprema->rowCount()){
                return 201;
                /*$code = 201;
                $data = getCategories($conn);*/
            }else{
                return 500;
                /*$code = 500;
                $data = "Serverska greska pri unosu kategorija!";*/
            }
        }catch (PDOException $e){
            return 409;
            /*$code = 409;
            $data = $e->getMessage();*/
        }
    }
    function deleteCategory($idKat,$conn){
        $upit = "DELETE FROM kategorija WHERE id_kat=:idKat";
        $priprema2 = $conn->prepare($upit);
        $priprema2->bindParam(":idKat",$idKat);
        try{
            $priprema2->execute();
            if($priprema2->rowCount()){
                return 201;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }
    function getCategories($conn){
        $upit = "SELECT * FROM kategorija";
        try{
            $rezultat = $conn->query($upit)->fetchAll();
            if($rezultat){
                return $rezultat;
            }else{
                return 500;
            }
        }catch (PDOException $e){
            return 409;
        }
    }
}