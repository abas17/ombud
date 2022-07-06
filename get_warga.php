<?php
	include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

	echo "<option value=''>---Pilih Warga Negara---</option>";

$selectSql = "SELECT * FROM warga_negara ORDER BY id_wn";
$stmt = $db->prepare($selectSql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_wn"] . '">' . $row["pilih_wn"] . '</option>';
}
