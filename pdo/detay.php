<?php
require_once "db.php";

$sorgu = $db->prepare("SELECT * from egtimci WHERE egtimci_id = ?");
$sorgu->execute([$_GET["id"]]);

$egtimci = $sorgu->fetch(PDO::FETCH_ASSOC);
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
    <div class="text-center mt-3">
        <h2>Eğtimci detayları</h2>
        <a href="index.php">Geri Dön</a>
    </div>
    <hr>
    <div class="col-md-6 offset-md-3">
        <ul class="list-group">
            <li class="list-group-item active">İsim</li>
            <li class="list-group-item">
                <?php echo $egtimci["egtimci_adi"]; ?>
            </li>
            <li class="list-group-item active">CV</li>
            <li class="list-group-item">
                <?php echo $egtimci["egtimci_cv"]; ?>
            </li>
            <li class="list-group-item active">Durum</li>
            <li class="list-group-item">
                <?=($egtimci["egtimci_durum"]=='1') ? 'Aktif' : 'Pasif'; ?>
            </li>
        </ul>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>