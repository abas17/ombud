<?php include 'partials/scripts.php'; ?>
<script src="app-assets/vendors/sweetalert/sweetalert.min.js"></script>
<script src="app-assets/js/scripts/extra-components-sweetalert.js"></script>
<?php
echo '<script>';
echo 'swal("success")';
echo '</script>';
echo '<meta http-equiv="refresh" content="0; url=">';


$db->beginTransaction();

$insertSql = "INSERT INTO registrasi_lap_masyarakat(id_reg,tgl_agenda,tipe_laporan,cara_penyampaian,no_agenda,no_arsip) 
  VALUES(NULL, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($insertSql);
$stmt->bindParam(1, $_POST['tgl_agenda']);
$stmt->bindParam(2, $_POST['tipe_laporan']);
$stmt->bindParam(3, $_POST['cara_penyampaian']);
$stmt->bindParam(4, $_POST['no_agenda']);
$stmt->bindParam(5, $_POST['no_arsip']);
$stmt->execute();

$insertId = $db->lastInsertId();


$insertSql = "INSERT INTO pelapor(id_pel,identitas_pelapor_rahasia) 
    VALUES(?,?)";
$stmt = $db->prepare($insertSql);
$stmt->bindparam(1, $insertId);
$stmt->bindparam(2, $_POST['identitas_pelapor_rahasia']);
$stmt->execute();


$insertSql = "INSERT INTO terlapor(id_ter,nama_terlapor) 
    VALUES(?,?)";
$stmt = $db->prepare($insertSql);
$stmt->bindparam(1, $insertId);
$stmt->bindparam(2, $_POST['nama_terlapor']);
$stmt->execute();


$db->commit();
echo $insertId;