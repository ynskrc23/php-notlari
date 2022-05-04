<?php
//Temel PHP Sözdizimi
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Variable</title>
</head>
<body>
<?php
    /*
    PHP Değişkenleri

    PHP değişken tanımlama kuralları:

    Bir değişken $ işaretiyle başlar ve ardından değişkenin adı gelir.
    Değişken adı bir harf veya alt çizgi karakteri ile başlamalıdır.
    Değişken adı bir sayı ile başlayamaz.
    Değişken adı yalnızca alfasayısal karakterler ve alt çizgiler içerebilir (A-z, 0-9 ve _ )
    Değişken adları büyük/küçük harf duyarlıdır ($sayi ve $SAYI iki farklı değişkendir)

    NOT: PHP değişken adlarının büyük/küçük harfe duyarlı olduğunu unutmayınız!
    */

    $sehir = "Elbistan";
    $m = 82;
    $n = 46.5;

    echo "Mehaba ".$sehir."<br>";
    echo "Mehaba $sehir <br>";
    echo $m + $n;

    /*
    PHP'de üç farklı değişken kapsamı vardır.

    local
    global
    static
    */
?>
</body>
</html>