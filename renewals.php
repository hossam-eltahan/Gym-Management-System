<?php
include('includes/config.php');
$pageTitle = 'RENEWALS';
// Get all renewals
$sql = "SELECT r.id, r.total_amount, r.renew_date, m.fullname, m.email, m.contact_number, mt.type AS membership_type
        FROM renew r
        JOIN members m ON r.member_id = m.id
        JOIN membership_types mt ON m.membership_type = mt.id
        ORDER BY r.renew_date DESC";

$result = $conn->query($sql);

// Calculate total revenue
$totalRevenueQuery = "SELECT SUM(total_amount) AS totalRevenue FROM renew";
$totalRevenueResult = $conn->query($totalRevenueQuery);
$totalRevenue = $totalRevenueResult->fetch_assoc()['totalRevenue'];

?>

<?php include('includes/header.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php include('includes/nav.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="content-wrapper">
        <?php include('includes/pagetitle.php'); ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Renewals</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Renew ID</th>
                                            <th>Member Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Membership Type</th>
                                            <th>Total Amount</th>
                                            <th>Renew Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['fullname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['contact_number']; ?></td>
                                                <td><?php echo $row['membership_type']; ?></td>
                                                <td><?php echo $row['total_amount']; ?></td>
                                                <td><?php echo $row['renew_date']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Display total revenue -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Total Revenue</h3>
                            </div>
                            <div class="card-body">
                                <h4><?php echo '$' . number_format($totalRevenue, 2); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>&copy; <?php echo date('Y'); ?> Codezilla.com</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Developed By</b> <a href="https://www.linkedin.com/in/hossam-eltahan-24528b253/">Hossam Eltahan</a>
        </div>
    </footer>
</div>

<?php include('includes/footer.php'); ?>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>

</body>
</html>
