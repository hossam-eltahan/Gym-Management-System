<?php
include('includes/config.php');

$pageTitle = 'Manage Bills';

// Initialize filters
$filters = [];
$sql = "SELECT b.id, b.member_id, b.membership_type, b.amount, b.renew_duration, b.total_amount, b.renew_date, b.expiry_date, m.fullname, m.email, m.contact_number 
        FROM bills b 
        JOIN members m ON b.member_id = m.id 
        WHERE 1";

// Apply filters based on POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['member_name'])) {
        $filters[] = "m.fullname LIKE '%" . $conn->real_escape_string($_POST['member_name']) . "%'";
    }
    if (!empty($_POST['membership_type'])) {
        $filters[] = "b.membership_type = '" . $conn->real_escape_string($_POST['membership_type']) . "'";
    }
    if (!empty($_POST['member_email'])) {
        $filters[] = "m.email = '" . $conn->real_escape_string($_POST['member_email']) . "'";
    }
    if (!empty($_POST['contact_number'])) {
        $filters[] = "m.contact_number = '" . $conn->real_escape_string($_POST['contact_number']) . "'";
    }
    if (!empty($_POST['bill_amount'])) {
        $filters[] = "b.amount = " . $conn->real_escape_string($_POST['bill_amount']);
    }
    if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        $startDate = $conn->real_escape_string($_POST['start_date']);
        $endDate = $conn->real_escape_string($_POST['end_date']);
        $filters[] = "b.renew_date BETWEEN '$startDate' AND '$endDate'";
    }
    
    // Add all filters to the query
    if (count($filters) > 0) {
        $sql .= " AND " . implode(" AND ", $filters);
    }
}

$sql .= " ORDER BY b.renew_date DESC";
$result = $conn->query($sql);

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
                                <h3 class="card-title">Filter Bills</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Member Name</label>
                                            <input type="text" name="member_name" class="form-control" placeholder="Enter member name">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Membership Type</label>
                                            <input type="text" name="membership_type" class="form-control" placeholder="Enter membership type">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Email</label>
                                            <input type="text" name="member_email" class="form-control" placeholder="Enter email">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Bill Amount</label>
                                            <input type="text" name="bill_amount" class="form-control" placeholder="Enter bill amount">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Start Date</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>End Date</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Bills</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bill ID</th>
                                            <th>Member Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Membership Type</th>
                                            <th>Amount</th>
                                            <th>Renew Date</th>
                                            <th>Expiry Date</th>
                                            <th>Actions</th>
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
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['renew_date']; ?></td>
                                                <td><?php echo $row['expiry_date']; ?></td>
                                                <td>
                                                    <a href="view_bill.php?bill_id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i> See</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
