<?php
require_once "db.php";
extract($_POST);

//ekleme işlemi
if(isset($_POST["ekle"]) == "1" && $id == "")
{
    isset($egtimci_adi) ? $egtimci_adi : null;
    isset($egtimci_cv) ? $egtimci_cv : null;
    isset($egtimci_dersi) ? $egtimci_dersi : 0;
    isset($egtimci_durum) ? $egtimci_durum : 2;

    if(!$egtimci_adi){
        echo '<script type="text/javascript"> alert("İsim giriniz");</script>';
    }
    else if(!$egtimci_cv){
        echo '<script type="text/javascript"> alert("Cv giriniz");</script>';
    }
    else{
        $query = $db->prepare('INSERT INTO egtimci SET 
            egtimci_adi = ?,
            egtimci_cv = ?,
            egtimci_dersi = ?,
            egtimci_durum = ?
        ');

        $ekle = $query->execute([
            $egtimci_adi, $egtimci_cv, $egtimci_dersi, $egtimci_durum
        ]);

        if($ekle){
            echo "Ekleme işlemi başarılı";
            header( "refresh:2;url=index.php" );
        }
        else{
            $hata = $query->errorInfo();
            echo "Hata oluştu: ".$hata[2];
        }
    }
}


//düzenleme işlemi
if(isset($_POST["edit"]) == "2" && $id != "")
{
    $sorgu = $db->prepare("SELECT * from egtimci WHERE egtimci_id = ?");
    $sorgu->execute([$_POST["id"]]);

    $egtimci = $sorgu->fetch(PDO::FETCH_ASSOC);

    isset($egtimci_adi) ? $egtimci_adi : $egtimci["egtimci_adi"];
    isset($egtimci_cv) ? $egtimci_cv : $egtimci["egtimci_cv"];
    isset($egtimci_dersi) ? $egtimci_dersi : 0;
    isset($egtimci_durum) ? $egtimci_durum : 2;


    $query = $db->prepare('UPDATE egtimci SET 
        egtimci_adi = ?,
        egtimci_cv = ?,
        egtimci_dersi = ?,
        egtimci_durum = ?
        WHERE egtimci_id = ?
    ');

    $edit = $query->execute([
        $egtimci_adi, $egtimci_cv, $egtimci_dersi, $egtimci_durum, $id
    ]);

    if($edit){
        echo "Düzenleme işlemi başarılı";
        header( "refresh:2;url=ekle.php?id=".$id);
    }
    else{
        $hata = $query->errorInfo();
        echo "Hata oluştu: ".$hata[2];
    }
}


//silme işlemi
if($_GET["sil_id"] != ""){
    $sorgu = $db->prepare("DELETE FROM egtimci WHERE egtimci_id = ?");
    $sorgu->execute([$_GET["sil_id"]]);

    header('Location:index.php');
}
?>