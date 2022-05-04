<?php
    //Temel PHP Sözdizimi
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Syntax</title>
</head>
<body>
<?php
    /*
    <?php ile başlar ?> ile biter
    php dosylarının dosya uzantısı .php dir.

    Aşağıdaki örnekte ekrana basit bir şekilde merhaba elbistan kelimesini yazdırmış olacağız.
    */
    echo "Merhaba Elbistan!!<br>";

    /*
    PHP ifadeleri noktalı virgül (;) ile biter.

    PHP'de anahtar sözcükler case-sensitive(küçük/büyük) harfe duyarlı değildir.

    Aşağıda üç farklı echo komutunun kullanımını inceleyelim.
    */

    ECHO "Merhaba Ankara!<br>";
    echo "Merhaba Ankara!<br>";
    EcHo "Merhaba Ankara!<br>";

    /*
    Ama değişken isimleri case-sensitive(küçük/büyük) harfe duyarlıdır.

    Aşağıdaki örnekte inceleyelim.
    */

    $number = 26;
    echo "Benim yaşım " . $number . "<br>";
    echo "Forma numaram " . $NUMBER . "<br>";
    echo "Uğurlu sayım " . $nuMBER . "<br>";

    /*
    Yukarıda yer alan örneklerin sonucunda $NUMBER ve $nuMBER değişkenleri için Undefined variable(tanımsız değişken) böyle değişken bulunamadı hatası vercektir.
    */
?>
</body>
</html>