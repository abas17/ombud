<?php
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
<div class="pt-3 pb-2" id="breadcrumbs-wrapper">
    <div class="col s12 m6 l6">
        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users List</span></h5>
    </div>
</div>
<!-- users list start -->
<section class="users-list-wrapper section">
    <div class="users-list-filter">
        <div class="card-panel">
            <div class="row">
                <form>
                    <div class="col s12 m6">
                        <label for="users-list-verified">Verified</label>
                        <div class="input-field">
                            <select class="form-control" id="users-list-verified">
                                <option value="">Any</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <label for="users-list-role">Role</label>
                        <div class="input-field">
                            <select class="form-control" id="users-list-role">
                                <option value="">Any</option>
                                <option value="User">User</option>
                                <option value="Staff">Staff</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="users-list-datatable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>id</th>
                                <th>username</th>
                                <th>name</th>
                                <th>email</th>
                                <th>verified</th>
                                <th>role</th>
                                <th>last activity</th>
                                <th>edit</th>
                                <th>view</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $database = new Database();
                            $db = $database->getConnection();
                            $selectSql = "SELECT * from users ORDER BY id desc";
                            $stmt = $db->prepare($selectSql);
                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><a href="?page=users-view&id=<?php echo $row['id'] ?>"><?php echo $row['username'] ?></a>
                                    </td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['verified'] ?></td>
                                    <td><?php echo $row['level'] ?></td>
                                    <td><?php echo $row['loginTime'] ?></td>
                                    <td><a href="?page=users-edit&id=<?php echo $row['id'] ?>"><i class="material-icons">edit</i></a></td>
                                    <td><a href="?page=users-view&id=<?php echo $row['id'] ?>"><i class="material-icons">remove_red_eye</i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->

<?php include 'partials/scripts.php'; ?>