<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

$warga = $_POST['warga'];

echo "<option value=''>---Pilih Jenis Identitas---</option>";

$selectSql = "SELECT * FROM jenis_identitas WHERE id_wn=? order by id_ji";
$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $warga);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row["id_ji"] . '">' . $row["pilih_ji"] . '</option>';
}
?>