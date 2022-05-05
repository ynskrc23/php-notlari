<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OPERATORLER</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<?php 
    extract($_POST);
    if($_POST["gelen"] == "1")
    { 
        $topla = $sayi1 + $sayi2;
        $cikar = $sayi1 - $sayi2;
        $carp = $sayi1 * $sayi2;
        $bol = $sayi1 / $sayi2;
    }
?>

    <center>
        <h1 class="mt-3">PHP İLE 4 İŞLEM YAPIMI</h1>
    </center>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="sayi1">Sayı 1</label>
                        <input type="text" class="form-control" id="sayi1" name="sayi1" value="<?php echo $sayi1; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sayi2">Sayı 2</label>
                        <input type="text" class="form-control" id="sayi2" name="sayi2" value="<?php echo $sayi2; ?>">
                    </div>

                    <input type="hidden" name="gelen" value="1">
                    <button type="submit" class="btn btn-primary btn-sm"> HESAPLA </button>
                </form>
            </div>
            
            <div class="col-6">
                <?php if($_POST["gelen"] == "1"){ ?>
                    <table width="300" class="mt-4" border="1">
                        <tr>
                            <td colspan="2" align="center">Dört İşlem Sonucu</td>
                        </tr>
                        <tr>
                            <td>Toplam</td>
                            <td><?php echo $topla; ?></td>
                        </tr>
                        <tr>
                            <td>Fark</td>
                            <td><?php echo $cikar; ?></td>
                        </tr>
                        <tr>
                            <td>Çarpım</td>
                            <td><?php echo $carp; ?></td>
                        </tr>
                        <tr>
                            <td>Bölüm</td>
                            <td><?php echo $bol; ?></td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
   

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>