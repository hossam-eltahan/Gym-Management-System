<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateSettings'])) {
    $systemName = $_POST['systemName'];
    $currency = $_POST['currency'];
    $gymAddress = $_POST['gym_address'];
    $gymContact = $_POST['gym_contact'];
    $gymEmail = $_POST['gym_email'];
    $gymManager = $_POST['gym_manager'];

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logoName = $_FILES['logo']['name'];
        $logoTmpName = $_FILES['logo']['tmp_name'];
        $uploadPath = 'uploads/';
        $targetPath = $uploadPath . $logoName;

        if (move_uploaded_file($logoTmpName, $targetPath)) {
            $updateSettingsQuery = "UPDATE settings SET system_name = '$systemName', logo = '$targetPath', currency = '$currency', gym_address = '$gymAddress', gym_contact = '$gymContact', gym_email = '$gymEmail', gym_manager = '$gymManager' WHERE id = 1";
            $updateSettingsResult = $conn->query($updateSettingsQuery);
        }
    } else {
        $updateSettingsQuery = "UPDATE settings SET system_name = '$systemName', currency = '$currency', gym_address = '$gymAddress', gym_contact = '$gymContact', gym_email = '$gymEmail', gym_manager = '$gymManager' WHERE id = 1";
        $updateSettingsResult = $conn->query($updateSettingsQuery);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changePassword'])) {
    // Get form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $userId = $_SESSION['user_id'];
    $validatePasswordQuery = "SELECT password FROM users WHERE id = $userId";
    $validatePasswordResult = $conn->query($validatePasswordQuery);

    if ($validatePasswordResult->num_rows > 0) {
        $row = $validatePasswordResult->fetch_assoc();
        $hashedPassword = $row['password'];

        if (md5($currentPassword) === $hashedPassword) {
            $hashedNewPassword = md5($newPassword);
            $updatePasswordQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE id = $userId";
            $updatePasswordResult = $conn->query($updatePasswordQuery);

            if ($updatePasswordResult) {
                $successMessagePassword = 'Password updated successfully.';
            } else {
                $errorMessagePassword = 'Error updating password: ' . $conn->error;
            }
        } else {
            $errorMessagePassword = 'Current password is incorrect.';
        }
    }
}

$fetchSettingsQuery = "SELECT * FROM settings WHERE id = 1";
$fetchSettingsResult = $conn->query($fetchSettingsQuery);

if ($fetchSettingsResult->num_rows > 0) {
    $settings = $fetchSettingsResult->fetch_assoc();
}

?>

<?php include('includes/header.php');?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include('includes/nav.php');?>
    <?php include('includes/sidebar.php');?>

    <div class="content-wrapper">
        <?php include('includes/pagetitle.php');?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-cogs"></i> System Settings</h3>
                            </div>

                            <?php
                            if (!empty($successMessage)) {
                                echo '<div class="alert alert-success">' . $successMessage . '</div>';
                            } elseif (!empty($errorMessage)) {
                                echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                            }

                            if (!empty($successMessagePassword)) {
                                echo '<div class="alert alert-success">' . $successMessagePassword . '</div>';
                            } elseif (!empty($errorMessagePassword)) {
                                echo '<div class="alert alert-danger">' . $errorMessagePassword . '</div>';
                            }
                            ?>

                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="systemName">System Name:</label>
                                        <input type="text" id="systemName" name="systemName" class="form-control"
                                            value="<?php echo isset($settings['system_name']) ? $settings['system_name'] : ''; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Logo:</label>
                                        <input type="file" id="logo" name="logo" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="currency">Currency:</label>
                                        <input type="text" id="currency" name="currency" class="form-control"
                                            value="<?php echo isset($settings['currency']) ? $settings['currency'] : ''; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="gym_address">Gym Address:</label>
                                        <input type="text" id="gym_address" name="gym_address" class="form-control"
                                            value="<?php echo isset($settings['gym_address']) ? $settings['gym_address'] : ''; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="gym_contact">Gym Contact:</label>
                                        <input type="text" id="gym_contact" name="gym_contact" class="form-control"
                                            value="<?php echo isset($settings['gym_contact']) ? $settings['gym_contact'] : ''; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="gym_email">Gym Email:</label>
                                        <input type="email" id="gym_email" name="gym_email" class="form-control"
                                            value="<?php echo isset($settings['gym_email']) ? $settings['gym_email'] : ''; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="gym_manager">Gym Manager:</label>
                                        <input type="text" id="gym_manager" name="gym_manager" class="form-control"
                                            value="<?php echo isset($settings['gym_manager']) ? $settings['gym_manager'] : ''; ?>" required>
                                    </div>

                                    <button type="submit" name="updateSettings" class="btn btn-primary">Update Settings</button>
                                </div>
                            </form>

                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="currentPassword">Current Password:</label>
                                        <input type="password" id="currentPassword" name="currentPassword" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="newPassword">New Password:</label>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password:</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                                            required>
                                    </div>

                                    <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
        <strong> &copy; <?php echo date('Y');?> Codezilla.com</a> -</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Developed By</b> <a href="https://www.linkedin.com/in/hossam-eltahan-24528b253/">Hossam Eltahan</a>
        </div>
    </footer>
</div>

<?php include('includes/footer.php');?>


</body>
<!-- Visit codeastro.com for more projects -->
</html>
