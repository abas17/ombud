<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

	$kabupaten = $_POST['kabupaten'];

	echo "<option value=''>---Pilih Kecamatan---</option>";

$selectSql = "SELECT * FROM kecamatan WHERE id_kab=? ORDER BY nama_kec ASC";
$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $kabupaten);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_kec"] . '">' . $row["nama_kec"] . '</option>';
}

