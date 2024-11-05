<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/Customers/Style_Receipts.css">
</head>
<body>

<?php
    $myDate = date('Y-m-d h:i:s')
?> 

<!-- Shows the User's Information, Chosen Worker, Selected Date and Time, and Time of Booking - eiryk -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Appointment Receipt</h2>
                <p><strong>Name:</strong> <?= session()->get('name') ?></p>
                <p><strong>Email:</strong> <?= session()->get('email') ?></p>
                <p><strong>Worker Chosen:</strong> <?= htmlspecialchars($workerName) ?></p>
                <p><strong>Date Selected:</strong> <?= htmlspecialchars($selectedDate) ?></p>
                <p><strong>Time Selected:</strong> <?= htmlspecialchars($selectedTime) ?></p>
                <p><strong>Time of Booking:</strong> <?= htmlspecialchars($myDate) ?></p>
                
                <br>
                <div class="text-center mb-3"> <!-- Back Button to Dashboard -->
                    <button onclick="window.location.href='<?= base_url('user') ?>'" class="btn btn-secondary btn-sm">Back to Dashboard</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
