<?php

include 'database/database.php';

if (isset($_POST['button_register'])) {
    $database = new Database();
    $db = $database->getConnection();

    $validateSql = "SELECT * FROM users WHERE username = ?";

    $stmt = $db->prepare($validateSql);
    $stmt->bindParam(1, $_POST['uname']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
?>
        <div class="card-alert card gradient-45deg-red-pink">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">error</i> Username sudah digunakan
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php
    } else {
        $validateSql = "SELECT * FROM users WHERE email = ?";

        $stmt = $db->prepare($validateSql);
        $stmt->bindParam(1, $_POST['cemail']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        ?>
            <div class="card-alert card gradient-45deg-red-pink">
                <div class="card-content white-text">
                    <p>
                        <i class="material-icons">error</i> Email sudah digunakan
                    </p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
<?php
        } else {
            $username = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST["cpassword"], PASSWORD_DEFAULT);
            $level = 'USER';
            date_default_timezone_set('Asia/Makassar');
            $regdate = date('Y-m-d H:i:s', time());
            $insertSql = "INSERT INTO users (id, username, email, password, level, regDate) VALUES (NULL, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($insertSql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $_POST['cemail']);
            $stmt->bindParam(3, $password);
            $stmt->bindParam(4, $level);
            $stmt->bindParam(5, $regdate);
            session_start();
            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil membuat akun";
            } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal membuat akun";
            }
            header("Refresh:0; url=login.php");
        }
    }

    //echo $validateSql;
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Register | Ombudsman</title>
    <link rel="apple-touch-icon" href="app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon/32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/register.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 1-column register-bg   blank-page blank-page" data-open="click" data-menu="vertical-gradient-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <form action="" method="POST" class="formValidate" id="formValidate">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Register</h5>
                                    <p class="ml-4">Join to our community now !</p>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="uname" name="uname" type="text">
                                    <label for="uname" class="center-align">Username</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">mail_outline</i>
                                    <input id="cemail" name="cemail" type="email">
                                    <label for="cemail">Email</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" name="password" type="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="cpassword" name="cpassword" type="password">
                                    <label for="cpassword">Password again</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" name="button_register">
                                    <i></i> Register
                                </button>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin medium-small"><a href="login.php">Already have an account? Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="app-assets/js/plugins.js"></script>
    <script src="app-assets/js/search.js"></script>
    <script src="app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/form-validation.js"></script>
    <script src="app-assets/js/scripts/ui-alerts.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>