<?php
	include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

	echo "<option value=''>---Pilih Kelompok Instansi Terlapor---</option>";

$selectSql = "SELECT * FROM kelompok_klasifikasi_instansi ORDER BY pilih_kel ASC";
$stmt = $db->prepare($selectSql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_kel"] . '">' . $row["pilih_kel"] . '</option>';
}
