<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

$substansi = $_POST['substansi'];

echo "<option value=''>---Pilih Pokok Permasalahan---</option>";

$selectSql = "SELECT * FROM klasifikasi_permasalahan WHERE id_sub=? order by nama_klasper";
$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $substansi);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row["id_klasper"] . '">' . $row["nama_klasper"] . '</option>';
}
?>