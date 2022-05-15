<?php
    require_once "baglan.php";

    $gelen = "8";
    if($gelen == "1")
    {
        //insert işlemi
        $query = $db->prepare("insert into kullanicilar set 
        kullanici_isim = ?, 
        kullanici_soyisim = ?, 
        kullanici_email = ?, 
        kullanici_sifre = ?, 
        kullanici_kayit_tarihi = ?");

        $insert = $query->execute(array(
            "ali",
            "veli",
            "info@info.com",
            "123456",
            date("Y-m-d")
        ));

        if($insert)
        {
            $son_id = $db->lastInsertId();
            echo "son eklenen veri idsi: ".$son_id;
        }
        else
        {
            echo "hata oluştu tekrar deneyiniz";
        }
        //end insert işlemi
    }

    if($gelen == "2")
    {
        //update işlemi
        $query = $db->prepare("update kullanicilar set 
            kullanici_isim =:kullanici_isim,
            kullanici_soyisim =:kullanici_soyisim 
            where kullanici_id =:kullanici_id
        ");

        $edit = $query->execute(array(
            "kullanici_isim" => "ayse",
            "kullanici_soyisim" => "fatma hayriye",
            "kullanici_id" => 2
        ));

        if($edit)
        {
            echo "veri güncellendi";
        }
        else
        {
            echo "hata oluştu tekrar deneyiniz";
        }
        //end update işlemi
    }

    if($gelen == "3")
    {
        //delete işlemi
        $query = $db->prepare("delete from kullanicilar where kullanici_id =:kullanici_id");
        $delete = $query->execute(array("kullanici_id" => 4));

        if($delete)
        {
            echo "veri slindi";
        }
        else
        {
            echo "hata oluştu tekrar deneyiniz";
        }
        //end delete işlemi
    }

    if($gelen == 4)
    {
        //veri listeleme işlemi
        $query = $db->prepare("select * from kullanicilar");
        $query->execute();
        $listele = $query->fetchAll(PDO::FETCH_ASSOC);

        echo "--------------Çoklu veri listeleme------------";
        echo "<br>";
        foreach ($listele as $key => $value) {
            echo $value["kullanici_id"]." isim: ".$value["kullanici_isim"]."<br>";
            echo $value["kullanici_id"]." soyisim: ".$value["kullanici_soyisim"]."<br>";
        }

        $query_sartli = $db->prepare("select * from kullanicilar where kullanici_id=:kullanici_id");
        $query_sartli->execute(array("kullanici_id" => 2));
        $listele = $query_sartli->fetch(PDO::FETCH_ASSOC);

        echo "--------------tekli veri listeleme------------";
        echo "<br>";
        echo "Kullanıcı ismi: ".$listele["kullanici_isim"];
        //end veri listeleme işlemi
    }

    if($gelen == 5)
    {
        //toplam veri sayısını bulma
        $query = $db->prepare("select * from kullanicilar");
        $query->execute();
        $toplam = $query->rowCount();

        $query_sartli = $db->prepare("select * from kullanicilar where kullanici_id=:kullanici_id");
        $query_sartli->execute(array("kullanici_id" => 2));
        $toplam = $query_sartli->rowCount();

        echo "toplam veri sayısı: " . $toplam;
        //end toplam veri sayısını bulma
    }

    if($gelen == 6)
    {
        //inner join, left join, right join kullanımı
        /*
        $query = $db->query("select * from kullanicilar
        inner join kullanici_bilgiler on kullanicilar.kullanici_id = kullanici_bilgiler.kullanici_bilgi_kullanici_id")->fetchAll(PDO::FETCH_ASSOC);

        $query = $db->query("select * from kullanicilar 
        left join kullanici_bilgiler on kullanicilar.kullanici_id = kullanici_bilgiler.kullanici_bilgi_kullanici_id")->fetchAll(PDO::FETCH_ASSOC);
        */

        $query = $db->query("select * from kullanicilar 
        right join kullanici_bilgiler on kullanicilar.kullanici_id = kullanici_bilgiler.kullanici_bilgi_kullanici_id")->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($query);
        echo "</pre>";

        foreach ($query as $value) {
            echo $value["kullanici_id"]."--->".$value["kullanici_isim"]."--->".$value["kullanici_bilgi_facebook"]."<br>";
        }

        //end inner join, left join, right join kullanımı
    }

    if($gelen == 7)
    {
        //order by, group by ve having kullanımı
        //$query = $db->query("select * from kullanicilar order by kullanici_id desc")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select * from kullanicilar group by kullanici_soyisim")->fetchAll(PDO::FETCH_ASSOC);
        $query = $db->query("select * from kullanicilar group by kullanici_soyisim having kullanici_puan > 15")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($query as $value) {
            echo $value["kullanici_id"]."--->".$value["kullanici_isim"]."--->".$value["kullanici_puan"]."<br>";
        }

        //end order by, group by ve having kullanımı
    }

    if($gelen == 8)
    {
        //and, or, in, like, min ve max kullanımı
        $query = $db->query("select * from kullanicilar where (kullanici_soyisim = 'veli' or kullanici_soyisim = 'fatma hayriye') and kullanici_puan > 25")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select * from kullanicilar where kullanici_soyisim in('veli','fatma hayriye')")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select if(kullanici_puan=30,'cavus.png','albay.png') as durum,kullanicilar.* from kullanicilar")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select * from kullanicilar where kullanici_soyisim like '%el%'")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select * from kullanicilar where kullanici_puan between '15' and '30'")->fetchAll(PDO::FETCH_ASSOC);
        //$query = $db->query("select max(kullanici_puan) from kullanicilar")->fetchAll(PDO::FETCH_ASSOC);

        print_r($query);
        foreach ($query as $value) {
            echo $value["kullanici_id"]."--->".$value["kullanici_isim"]."--->".$value["kullanici_puan"]."<br>";
        }

        //end and, or, in, like, min ve max kullanımı
    }
?>