<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$pageTitle = 'Revenue Report';

// Initialize variables
$reportResult = null;
$totalAmount = 0;
$currencySymbol = ''; // Initialize currency symbol

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Query to get the report data and total amount
    $reportQuery = "SELECT m.fullname, m.membership_number, r.total_amount, r.renew_date, s.currency
                    FROM renew r
                    JOIN members m ON r.member_id = m.id
                    LEFT JOIN settings s ON s.id = 1
                    WHERE r.renew_date BETWEEN '$fromDate' AND '$toDate'";

    $reportResult = $conn->query($reportQuery);

    if ($reportResult && $reportResult->num_rows > 0) {
        // Calculate total amount
        $totalAmountQuery = "SELECT SUM(total_amount) AS totalAmount, s.currency
                             FROM renew r
                             LEFT JOIN settings s ON s.id = 1
                             WHERE r.renew_date BETWEEN '$fromDate' AND '$toDate'";
        $totalAmountResult = $conn->query($totalAmountQuery);
        if ($totalAmountResult && $totalAmountResult->num_rows > 0) {
            $totalAmountRow = $totalAmountResult->fetch_assoc();
            $totalAmount = $totalAmountRow['totalAmount'];
            $currencySymbol = $totalAmountRow['currency'];
        }
    }
}

?>

<?php include('includes/header.php');?>
<style>
    @media print {
        form {
            display: none;
        }

        .print-button {
            display: none;
        }
    }
</style>

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
                <h3 class="card-title"><i class="fas fa-keyboard"></i> Revenue Report</h3>
              </div>
              
              <form method="post" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="fromDate">From Date:</label>
                    <input type="date" id="fromDate" name="fromDate" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="toDate">To Date:</label>
                    <input type="date" id="toDate" name="toDate" class="form-control" required>
                  </div>

                  <button type="submit" class="btn btn-success">Generate Report</button>
                </div>
              </form>
              
              <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  if ($reportResult && $reportResult->num_rows > 0) {
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Member</th>';
                    echo '<th>Membership Number</th>';
                    echo '<th>Total Amount</th>';
                    echo '<th>Date</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    while ($row = $reportResult->fetch_assoc()) {
                      echo '<tr>';
                      echo '<td>' . $row['fullname'] . '</td>';
                      echo '<td>' . $row['membership_number'] . '</td>';
                      echo '<td>' . $row['currency'] . $row['total_amount'] . '</td>';
                      echo '<td>' . $row['renew_date'] . '</td>';
                      echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '<h4>Total Amount: ' . $currencySymbol . number_format($totalAmount, 2) . '</h4>'; // Display total amount
                    echo '</div>';

                    echo '<div class="card-footer">';
                    echo '<button type="button" class="btn btn-primary print-button" onclick="printReport()"><i class="fas fa-print"></i> Print Report</button>';
                    echo '</div>';
                  } else {
                    echo '<div class="card-body">';
                    echo '<p>No renew records found within the specified date range.</p>';
                    echo '</div>';
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <footer class="main-footer">
        <strong>&copy; <?php echo date('Y');?> Codezilla.com</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Developed By</b> <a href="https://www.linkedin.com/in/hossam-eltahan-24528b253/">Hossam Eltahan</a>
        </div>
    </footer>

</div>

<?php include('includes/footer.php');?>

<script>
function printReport() {
    window.print();
}
</script>

</body>
</html>
