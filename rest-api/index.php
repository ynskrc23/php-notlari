<?php
    include "db.php";
    include "function.php";

    $islem = isset($_GET["islem"]) ? addslashes(trim($_GET["islem"])) : null;
    $jsonArray = array(); // array değişkenimiz bunu en alta json objesine çevireceğiz.
    $jsonArray["hata"] = FALSE; // Başlangıçta hata yok olarak kabul edelim.

    $_code = 200; // HTTP Ok olarak durumu kabul edelim.

    // üye ekleme kısmı burada olacak. CREATE İşlemi
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // verilerimizi post yöntemi ile alalım.
        $uye_rumuz = addslashes($_POST["uye_rumuz"]);
        $uye_uye_ad_soyad = addslashes($_POST["uye_uye_ad_soyad"]);
        $uye_sifre = addslashes($_POST["uye_sifre"]);
        $uye_mail = addslashes($_POST["uye_mail"]);
        $uye_telefon = addslashes($_POST["uye_telefon"]);

        // Kontrollerimizi yapalım.
        // gelen kullanıcı adı veya e-uye_mail veri tabanında kayıtlı mı kontrol edelim.
        $uyeler = $db->query("SELECT * from uyeler WHERE uye_rumuz='$uye_rumuz' OR uye_mail='$uye_mail'");

        if(empty($uye_rumuz) || empty($uye_uye_ad_soyad) || empty($uye_sifre) || empty($uye_mail) || empty($uye_telefon))
        {
            $_code = 400;
            $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
            $jsonArray["hataMesaj"] = "Boş alan bırakmayınız."; // Hatanın neden kaynaklı olduğu belirtilsin.
        }
        else if(!filter_var($uye_mail,FILTER_VALIDATE_EMAIL))
        {
            $_code = 400;
            $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
            $jsonArray["hataMesaj"] = "Geçersiz e-mail adresi"; // Hatanın neden kaynaklı olduğu belirtilsin.
        }
        else if($uyeler->rowCount() !=0)
        {
            $_code = 400;
            $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
            $jsonArray["hataMesaj"] = "Bu uye rumuz veya e-mail alınmış.";
        }
        else
        {
            $sorgu = $db->prepare("insert into uyeler set 
                uye_rumuz = ?, 
                uye_uye_ad_soyad = ?, 
                uye_sifre = ?, 
                uye_mail = ?, 
                uye_telefon = ?");

            $ekle = $sorgu->execute(array(
                $uye_rumuz,
                $uye_uye_ad_soyad,
                $uye_sifre,
                $uye_mail,
                $uye_telefon
            ));

            if($ekle)
            {
                $_code = 201;
                $jsonArray["mesaj"] = "Ekleme Başarılı.";
            }
            else
            {
                $_code = 400;
                $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
                $jsonArray["hataMesaj"] = "Sistem Hatası.";
            }
        }
    }

    else if($_SERVER['REQUEST_METHOD'] == "PUT")
    {
        $gelen_veri = json_decode(file_get_contents("php://input")); // veriyi alıp diziye atadık.

        // basitçe bi kontrol yaptık veriler varmı yokmu diye
        if(	isset($gelen_veri->uye_rumuz) && isset($gelen_veri->uye_ad_soyad) && isset($gelen_veri->uye_mail) && isset($gelen_veri->uye_id) && isset($gelen_veri->uye_telefon))
        {
            // veriler var ise güncelleme yapıyoruz.
            $sorgu = $db->prepare('UPDATE uyeler SET 
                uye_rumuz = ?,
                uye_ad_soyad = ?,
                uye_mail = ?,
                uye_telefon = ?
                WHERE uye_id = ?
            ');

            $update = $sorgu->execute([
                $gelen_veri->uye_rumuz, $gelen_veri->uye_ad_soyad, $gelen_veri->uye_mail, $gelen_veri->uye_telefon, $gelen_veri->uye_id
            ]);

            // güncelleme başarılı ise bilgi veriyoruz.
            if($update)
            {
                $_code = 200;
                $jsonArray["mesaj"] = "Güncelleme Başarılı";
            }
            else
            {
                // güncelleme başarısız ise bilgi veriyoruz.
                $_code = 400;
                $jsonArray["hata"] = TRUE;
                $jsonArray["hataMesaj"] = "Sistemsel Bir Hata Oluştu";
            }
        }
        else
        {
            // gerekli veriler eksik gelirse apiyi kulanacaklara hangi bilgileri istediğimizi bildirdik.
            $_code = 400;
            $jsonArray["hata"] = TRUE;
            $jsonArray["hataMesaj"] = "uye_rumuz,uye_ad_soyad,uye_mail,uye_telefon,uye_id Verilerini json olarak göndermediniz.";
        }
    }

    else if($_SERVER['REQUEST_METHOD'] == "DELETE")
    {
        // üye silme işlemi burada olacak. DELETE işlemi
        if(isset($_GET["uye_id"]) && !empty(trim($_GET["uye_id"])))
        {
            $uye_id = intval($_GET["uye_id"]);
            $kontrol = $db->query("select * from uyeler where uye_id = '$uye_id'")->rowCount();
            if($kontrol)
            {
                $delete = $db->prepare("DELETE FROM uyeler WHERE uye_id = ?");
                $delete->execute([$uye_id]);
                if( $delete )
                {
                    $_code = 200;
                    $jsonArray["mesaj"] = "Üyelik Silindi.";
                }
                else
                {
                    // silme başarısız ise bilgi veriyoruz.
                    $_code = 400;
                    $jsonArray["hata"] = TRUE;
                    $jsonArray["hataMesaj"] = "Sistemsel bir hata oluştu";
                }
            }
            else
            {
                $_code = 400;
                $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
                $jsonArray["hataMesaj"] = "Geçersiz id"; // Hatanın neden kaynaklı olduğu belirtilsin.
            }
        }
        else
        {
            $_code = 400;
            $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
            $jsonArray["hataMesaj"] = "Lütfen üye id değişkeni gönderin"; // Hatanın neden kaynaklı olduğu belirtilsin.
        }
    }

    else if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        // üye bilgisi listeleme burada olacak. GET işlemi
        if(isset($_GET["uye_id"]) && !empty(trim($_GET["uye_id"])))
        {
            $uye_id = intval($_GET["uye_id"]);
            $kontrol = $db->query("select * from uyeler where uye_id = '$uye_id'")->rowCount();
            if($kontrol)
            {
                $bilgiler = $db->query("select * from  uyeler where uye_id = '$uye_id'")->fetch(PDO::FETCH_ASSOC);
                $jsonArray["uye-bilgileri"] = $bilgiler;
                $_code = 200;
            }
            else
            {
                $_code = 400;
                $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
                $jsonArray["hataMesaj"] = "Üye bulunamadı"; // Hatanın neden kaynaklı olduğu belirtilsin.
            }
        }
        else
        {
            $kontrol = $db->query("select * from uyeler")->rowCount();
            if($kontrol)
            {
                $bilgiler = $db->query("select * from  uyeler")->fetchAll(PDO::FETCH_ASSOC);
                $jsonArray["uye-bilgileri"] = $bilgiler;
                $_code = 200;
            }
            else
            {
                $_code = 400;
                $jsonArray["hata"] = TRUE; // bir hata olduğu bildirilsin.
                $jsonArray["hataMesaj"] = "Üye bulunamadı"; // Hatanın neden kaynaklı olduğu belirtilsin.
            }
        }
    }
    else
    {
        $_code = 406;
        $jsonArray["hata"] = TRUE;
        $jsonArray["hataMesaj"] = "Geçersiz method!";
    }

    SetHeader($_code);
    $jsonArray[$_code] = HttpStatus($_code);
    echo json_encode($jsonArray);
?>