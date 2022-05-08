<?php
    error_reporting(0);

    try {
        $db = new PDO('mysql:host=localhost;dbname=lesson','root','');
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>