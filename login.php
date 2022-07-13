<?php
session_start();
if (isset($_SESSION["user"])) header("Location: index.php");
include 'database/database.php';
if (isset($_SESSION['hasil'])) {
    if ($_SESSION['hasil']) {
?>
        <div class="card-alert card gradient-45deg-green-teal">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">check</i> <?php echo $_SESSION['pesan'] ?>
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
    } else {
    ?>
        <div class="card-alert card gradient-45deg-red-pink">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">error</i> <?php echo $_SESSION['pesan'] ?>
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
<?php
    }
    unset($_SESSION['hasil']);
    unset($_SESSION['pesan']);
}
?>
<?php
if (isset($_POST['button_login'])) {
    $database = new Database();
    $db = $database->getConnection();

    $username = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM users WHERE username=:uname OR email=:cemail";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":uname" => $username,
        ":cemail" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($user) {
        // verifikasi password
        if (password_verify($password, $user["password"])) {
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            date_default_timezone_set('Asia/Makassar');
            $ldate = date('Y-m-d H:i:s', time());
            $updateSql = "UPDATE users SET loginTime = ? WHERE username = '" . $_SESSION['user']['username'] . "'";
            $stmt = $db->prepare($updateSql);
            $stmt->bindParam(1, $ldate);
            $stmt->execute();
            // login sukses, alihkan ke halaman timeline
            header("Location: index.php");
        } else {

?>
            <div class="card-alert card gradient-45deg-light-blue-cyan">
                <div class="card-content white-text">
                    <p>
                        <i class="material-icons">info_outline</i> INFO : Username atau password salah
                    </p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="card-alert card gradient-45deg-light-blue-cyan">
            <div class="card-content white-text">
                <p>
                    <i class="material-icons">info_outline</i> INFO : Username atau password salah
                </p>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
<?php

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
    <title>Login | Ombudsman</title>
    <link rel="apple-touch-icon" href="app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon/32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-gradient-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form action="" method="POST" class="formValidate" id="formValidate">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Sign in</h5>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="uname" name="uname" type="text">
                                    <label for="uname" class="center-align">Username atau email</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" name="password" type="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" name="button_login">
                                    <i></i> Login
                                </button>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
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