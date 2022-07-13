<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

$provinsi = $_POST['provinsi'];

echo "<option value=''>---Pilih Kota/Kabupaten---</option>";

$selectSql = "SELECT * FROM kabupaten WHERE id_prov=? order by nama_kab";
$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $provinsi);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo '<option value="' . $row["id_kab"] . '">' . $row["nama_kab"] . '</option>';
}
