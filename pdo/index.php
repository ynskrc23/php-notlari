<?php
require_once "db.php";

$sorgu = $db->query('SELECT * from egtimci inner join dersler on egtimci.egtimci_dersi = dersler.ders_id');
$egtimciler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="row">
        <table class="table table-hover ">
            <thead class="thead-default">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">İsim</th>
                    <th scope="col">Ders</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Kayıt Tarihi</th>
                    <th scope="col">İşlemler</th>
                    <th scope="col">
                        <a href="ekle.php">Yeni Kayıt</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php if($egtimciler): ?>
                <?php foreach($egtimciler as $egtimci): ?>
                <tr>
                    <th scope="row"><?php echo $egtimci["egtimci_id"]; ?></th>
                    <td><?php echo $egtimci["egtimci_adi"]; ?></td>
                    <td><?php echo $egtimci["ders_adi"]; ?></td>
                    <td>
                        <?php
                            if($egtimci["egtimci_durum"] == 1){
                                echo "Aktif";
                            }
                            else {
                                echo "Pasif";
                            }
                        ?>
                    </td>
                    <td><?php echo $egtimci["egtimci_kayit_tarihi"]; ?></td>
                    <td>
                        <a href='detay.php?id=<?php echo $egtimci["egtimci_id"]; ?>' class="btn btn-info btn-sm">İncele</a>
                        <a href='ekle.php?id=<?php echo $egtimci["egtimci_id"]; ?>' class="btn btn-success btn-sm">Düzenle</a>
                        <a href='islem.php?sil_id=<?php echo $egtimci["egtimci_id"]; ?>' class="btn btn-danger btn-sm">Sil</a>
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <td colspan="6" class="text-center">Henüz görüntülenecek veri yok</td>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>