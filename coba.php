<script>
    $('.simpan').click(function() {
        swal({
            title: "Anda Yakin ingin melakukan registrasi laporan baru?",
            text: "Pastikan data yang Anda isi sudah benar",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'Batal',
                delete: 'Simpan'
            }
        }).then(function(willDelete) {
            if (willDelete) {
                swal({
                    title: 'Tersimpan',
                    icon: "success",
                }).then(function() {
                    window.location = "?page=registrasi-laporan-creates";
                });
            } else {
                swal({
                    title: 'Dibatalkan',
                    icon: "error",
                });
            }
        });
    })
</script>


<a href="#" class="btn cyan waves-effect waves-light right " name="simpan" type="submit">
    <i class="material-icons right">send</i>
    <span class="hide-on-small-only">Submit</span>
</a>

<button type="submit" class="btn btn_succes waves-effect waves-light float-right" name="button_create">
    <i class="material-icons right">send</i></i> Simpan
</button>

<?php

$stmt = $db->prepare($selectSql);
$stmt->bindParam(1, $warga);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row[" id_ji"] . '">' . $row["pilih_ji"] . '</option>';
}


if (isset($_POST['button_create'])) {
    $insertSql = "INSERT INTO registrasi_lap_masyarakat(id_reg,tgl_agenda,tipe_laporan,cara_penyampaian) VALUES (NULL, ?, ?, ?)";
    $stmt = $db->prepare($insertSql);
    $stmt->bindParam(1, $_POST['tgl_agenda']);
    $stmt->bindParam(2, $_POST['tipe_laporan']);
    $stmt->bindParam(3, $_POST['cara_penyampaian']);
    $stmt->execute();
    // echo $insertSql;
}

