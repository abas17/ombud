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


?>
        <div class="row">
            <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users View</span></h5>
                        </div>
                        <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="?page=home">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=users-list">User</a>
                                </li>
                                <li class="breadcrumb-item active">Users View</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- users view start -->
        <div class="section users-view">
            <!-- users view media object start -->
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m7">
                        <div class="display-flex media">
                            <a href="#" class="avatar">
                                <img src="" alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                            </a>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <span><?php echo $row['nama'] ?> </span>
                                    <span class="grey-text">@</span>
                                    <span class=" grey-text"><?php echo $row['username'] ?></span>
                                </h6>
                                <span>ID:</span>
                                <span><?php echo $row['id'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                        <a href="" class="btn-small btn-light-indigo">Profile</a>
                        <a href="?page=users-edit&id=<?php echo $row['id'] ?>" class="btn-small indigo">Edit</a>
                    </div>
                </div>
            </div>
            <!-- users view media object ends -->
            <!-- users view card data start -->
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Registered:</td>
                                        <td><?php echo $row['regDate'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Latest Activity:</td>
                                        <td><?php echo $row['loginTime'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Verified:</td>
                                        <td><?php echo $row['verified'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Role:</td>
                                        <td><?php echo $row['level'] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- users view card data ends -->

            <!-- users view card details start -->
            <div class="card">
                <div class="card-content">
                    <div class="row indigo lighten-5 border-radius-4 mb-2">
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Username:</td>
                                        <td><?php echo $row['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td><?php echo $row['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail:</td>
                                        <td><?php echo $row['email'] ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Birthday:</td>
                                        <td><?php echo tgl_indo($row['tgl_lahir']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact:</td>
                                        <td><?php echo $row['no_tlp'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <!-- users view card details ends -->

        </div>
        <!-- users view ends -->


        <?php include 'partials/scripts.php'; ?>



<?php
    } else {
        echo '<meta http-equiv="refresh" content="0; url=?page=users-list">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=?page=users-list">';
}
