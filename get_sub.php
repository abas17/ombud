<?php
	include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

	echo "<option value=''>---Pilih Substansi---</option>";

$selectSql = "SELECT * FROM substansi ORDER BY nama_sub ASC";
$stmt = $db->prepare($selectSql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_sub"] . '">' . $row["nama_sub"] . '</option>';
}
?>