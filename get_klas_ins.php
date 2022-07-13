<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

$klas_ins = $_POST['klas_ins'];

echo "<option value=''>---Pilih Klasifikasi Instansi Terlapor---</option>";

$selectSql = "SELECT * FROM klasifikasi_instansi_terlapor WHERE id_kel=? order by pilih_ins";
$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $klas_ins);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row["id_ins"] . '">' . $row["pilih_ins"] . '</option>';
}
