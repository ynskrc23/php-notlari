<?php
require_once "db.php";

if(!empty($_GET["id"])){
    $sorgu = $db->prepare("SELECT * from egtimci WHERE egtimci_id = ?");
    $sorgu->execute([$_GET["id"]]);

    $egtimci = $sorgu->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="col-md-6 offset-md-3">
        <div style="text-align: center;">
            <h1 class="mt-3">PDO İşlemleri</h1>
        </div>

        <div class="row">
            <form action="islem.php" method="post">
                <label>Adı</label>
                <input type="text" class="form-control" name="egtimci_adi" id="egtimci_adi" value="<?php echo $egtimci["egtimci_adi"]; ?>">
                <br>

                <label>Cv</label>
                <textarea class="form-control" name="egtimci_cv" id="egtimci_cv" cols="50">
                   <?php echo $egtimci["egtimci_cv"]; ?>
                </textarea>
                <br>

                <label>Ders</label>
                <select class="form-control" name="egtimci_dersi" id="egtimci_dersi">
                    <option value="">Ders seciniz</option>
                </select>
                <br>

                <label>Durum</label>
                <select class="form-control" name="egtimci_durum" id="egtimci_durum">
                    <option value="">Durum seciniz</option>
                    <option <?php echo $egtimci["egtimci_durum"] == 1 ? 'selected' : '' ?> value="1">Aktif</option>
                    <option <?php echo $egtimci["egtimci_durum"] == 2 ? 'selected' : '' ?> value="2">Pasif</option>
                </select>
                <br>

                <input type="hidden" class="form-control" name="id" value="<?php echo $egtimci["egtimci_id"]; ?>">
                <input type="hidden" class="form-control" name="edit" value="2">
                <input type="hidden" class="form-control" name="ekle" value="1">
                <button type="submit" class=" btn btn-primary w-100" name="submitEkle">
                    <?php echo $egtimci["egtimci_id"] == "" ? 'Ekle' : 'Duzenle' ?>
                </button>
            </form>
        </div>
    </div>

</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>