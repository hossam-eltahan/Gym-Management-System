<?php
include('includes/config.php');

// Check if bill ID is provided
if (!isset($_GET['bill_id'])) {
    die('Error: Bill ID is missing.');
}

$billId = (int) $_GET['bill_id'];  // Ensure it's an integer to avoid SQL injection

// Fetch bill details
$billQuery = "SELECT b.*, m.fullname, m.membership_number 
              FROM bills b
              JOIN members m ON b.member_id = m.id
              WHERE b.id = $billId";
$billResult = $conn->query($billQuery);

if ($billResult->num_rows > 0) {
    $billDetails = $billResult->fetch_assoc();
} else {
    die('Error: Bill not found.'); // Error message if the bill is not found
}

// Fetch gym details from the database
$gymQuery = "SELECT system_name, gym_address, gym_contact, gym_email, logo FROM settings WHERE id = 1";
$gymResult = $conn->query($gymQuery);

if ($gymResult->num_rows > 0) {
    $gymDetails = $gymResult->fetch_assoc();
} else {
    // Fallback gym details if settings are not found
    $gymDetails = [
        'system_name' => 'Elite Fitness Gym',
        'gym_address' => '123 Fitness Street, Muscle City, Fitland',
        'gym_contact' => '+123-456-7890',
        'gym_email' => 'info@elitefitness.com',
        'logo' => 'uploads/default-logo.png'  // Default logo
    ];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }
        .invoice-header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .invoice-body {
            margin-bottom: 20px;
        }
        .invoice-body h2 {
            font-size: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .invoice-body p {
            margin: 5px 0;
            font-size: 16px;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
        }
        .print-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #0056b3;
        }

        .return-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .return-button:hover {
            background-color: #5a6268;
        }

        /* Hide the print button and return button when printing */
        @media print {
            .print-button, .return-button {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <a href="javascript:window.history.back();" class="return-button">&larr; Return</a>

        <div class="invoice-header">
            <!-- Gym logo and details -->
            <img src="<?php echo $gymDetails['logo']; ?>" alt="Gym Logo">
            <h1><?php echo $gymDetails['system_name']; ?></h1>
            <p><?php echo $gymDetails['gym_address']; ?></p>
            <p>Phone: <?php echo $gymDetails['gym_contact']; ?> | Email: <?php echo $gymDetails['gym_email']; ?></p>
        </div>

        <div class="invoice-body">
            <h2>Customer Details</h2>
            <p><strong>Member Name:</strong> <?php echo $billDetails['fullname']; ?></p>
            <p><strong>Membership Number:</strong> <?php echo $billDetails['membership_number']; ?></p>

            <h2>Membership Details</h2>
            <p><strong>Membership Type:</strong> <?php echo $billDetails['membership_type']; ?></p>
            <p><strong>Renew Duration:</strong> <?php echo $billDetails['renew_duration']; ?> months</p>
            <p><strong>Total Amount:</strong> $<?php echo number_format($billDetails['total_amount'], 2); ?></p>
            <p><strong>Renew Date:</strong> <?php echo date('d M Y', strtotime($billDetails['renew_date'])); ?></p>
            <p><strong>Expiry Date:</strong> <?php echo date('d M Y', strtotime($billDetails['expiry_date'])); ?></p>
        </div>

        <div class="invoice-footer">
            <button class="print-button" onclick="window.print()">Print Bill</button>
        </div>
    </div>
</body>
</html>
