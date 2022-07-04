<?php
	include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

	echo "<option value=''>Pilih Provinsi</option>";

$selectSql = "SELECT * FROM provinsi ORDER BY nama_prov ASC";
$stmt = $db->prepare($selectSql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_prov"] . '">' . $row["nama_prov"] . '</option>';
}
?>