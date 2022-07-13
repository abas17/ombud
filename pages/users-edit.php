<?php
if (isset($_GET['id']) && $_GET['id'] <> '') {
    $database = new Database();
    $db = $database->getConnection();

    $id = $_GET['id'];
    $findSql = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();

    if (isset($row['id'])) {
        if (isset($_POST['button_update'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            date_default_timezone_set('Asia/Makassar');
            $ldate = date('Y-m-d H:i:s', time());
            $date = date('Y-m-d', strtotime($_POST['datepicker']));
            $updateSql = "UPDATE users SET username = ?, nama = ?, email = ?, level = ?, verified = ?, tgl_lahir = ?, no_tlp = ?, alamat = ?, updationDate = ? WHERE id = ?";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $_POST['nama']);
            $stmt->bindParam(3, $_POST['email']);
            $stmt->bindParam(4, $_POST['level']);
            $stmt->bindParam(5, $_POST['verified']);
            $stmt->bindParam(6, $date);
            $stmt->bindParam(7, $_POST['phone_code']);
            $stmt->bindParam(8, $_POST['address']);
            $stmt->bindParam(9, $ldate);
            $stmt->bindParam(10, $id);
            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil ubah data";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal ubah data";
            }
            echo '<meta http-equiv="refresh" content="0; url=?page=users-list">';
        }


?>
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users Edit</span></h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="?page=home">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=users-list">User</a>
                                </li>
                                <li class="breadcrumb-item active">Users Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- users edit start -->
        <div class="section users-edit">
            <div class="card">
                <div class="card-content">
                    <form id="accountForm" method="POST" action="">
                        <!-- <div class="card-body"> -->
                        <ul class="tabs mb-2 row">
                            <li class="tab">
                                <a class="display-flex align-items-center active" id="account-tab" href="#account">
                                    <i class="material-icons mr-1">person_outline</i><span>Account</span>
                                </a>
                            </li>
                            <li class="tab">
                                <a class="display-flex align-items-center" id="information-tab" href="#information">
                                    <i class="material-icons mr-2">error_outline</i><span>Information</span>
                                </a>
                            </li>
                        </ul>
                        <div class="divider mb-3"></div>
                        <div class="row">
                            <div class="col s12" id="account">
                                <!-- users edit media object start -->
                                <div class="media display-flex align-items-center mb-2">
                                    <a class="mr-2" href="#">
                                        <img src="{{asset('images/avatar/avatar-11.png')}}" alt="users avatar" class="z-depth-4 circle" height="64" width="64">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading mt-0">Avatar</h5>
                                        <div class="user-edit-btns display-flex">
                                            <a href="#" class="btn-small indigo">Change</a>
                                            <a href="#" class="btn-small btn-light-pink">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- users edit media object ends -->
                                <!-- users edit account form start -->

                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="row">
                                            <div class="col s12 input-field">
                                                <input id="username" name="username" type="text" class="validate" value="<?php echo $row['username'] ?>" data-error=".errorTxt1">
                                                <label for="username">Username</label>
                                                <small class="errorTxt1"></small>
                                            </div>
                                            <div class="col s12 input-field">
                                                <input id="nama" name="nama" type="text" class="validate" value="<?php echo $row['nama'] ?>" data-error=".errorTxt2">
                                                <label for="nama">Nama</label>
                                                <small class="errorTxt2"></small>
                                            </div>
                                            <div class="col s12 input-field">
                                                <input id="email" name="email" type="email" class="validate" value="<?php echo $row['email'] ?>" data-error=".errorTxt3">
                                                <label for="email">E-mail</label>
                                                <small class="errorTxt3"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="row">
                                            <div class="col s12 input-field">
                                                <select name="level">
                                                    <option value="USER" <?php if ($row['level'] == 'USER') echo 'selected'; ?>>USER</option>
                                                    <option value="STAFF" <?php if ($row['level'] == 'STAFF') echo 'selected'; ?>>STAFF</option>
                                                    <option value="ADMIN" <?php if ($row['level'] == 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                                                </select>
                                                <label>Role</label>
                                            </div>
                                            <div class="col s12 input-field">
                                                <select name="verified">
                                                    <option value="No" <?php if ($row['verified'] == 'No' || '') echo 'selected'; ?>>No</option>
                                                    <option value="Yes" <?php if ($row['verified'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                                </select>
                                                <label>Verified</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- users edit account form ends -->
                            </div>
                            <div class="col s12" id="information">
                                <!-- users edit Info form start -->
                                <div class="row">
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="col s12">
                                                <h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Personal Info</h6>
                                            </div>
                                            <div class="col s12 input-field">
                                                <input id="datepicker" name="datepicker" value="<?php echo $row['tgl_lahir'] ?>" type="date" class="" placeholder="Pick a birthday" data-error=".errorTxt4">
                                                <label for="datepicker">Birth date</label>
                                                <small class="errorTxt4"></small>
                                            </div>

                                            <div class="col s12 input-field">
                                                <input id="phone_code" name="phone_code" type="text" maxlength="16" value="<?php echo $row['no_tlp'] ?>" class="validate" value="">
                                                <label for="phone_code">Phone</label>
                                            </div>
                                            <div class="col s12 input-field">
                                                <input id="address" name="address" value="<?php echo $row['alamat'] ?>" type="text" class="validate" data-error=".errorTxt5">
                                                <label for="address">Address</label>
                                                <small class="errorTxt5"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button type="submit" class="btn indigo" name="button_update">
                                    Save changes</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
            </div>
            <!-- </div> -->
        </div>
        </div>
        </div>
        <!-- users edit ends -->

        <?php include 'partials/scripts.php'; ?>



<?php
    } else {
        echo '<meta http-equiv="refresh" content="0; url=?page=users-list">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=?page=users-list">';
}
?>