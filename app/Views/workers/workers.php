<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Workers Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/Workers/Style_Workers.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4"> Worker Dashboard </h2>

                <?php if (session()->get('isLoggedIn')): ?>
                    <h4> Welcome, <?= esc(session()->get('name')) ?>! </h4> <br>
                    <p> Employee Information: || <strong> Email: </strong> <?= esc(session()->get('email')) ?> || <strong> User Role: </strong> <?= esc(session()->get('user_role')) ?> || </p>
                <?php else: ?>
                    <div class="alert alert-warning">
                        You are not logged in. Please log in first.
                    </div>
                <?php endif; ?>

                <!-- Logout Button -->
                <?php if (session()->get('isLoggedIn')): ?>
                    <form action="<?= base_url('logout') ?>" method="post">
                        <button type="submit" class="btn btn-danger w-100 mt-3"> Logout </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<br><br>

 <!-- Table of Receipts -->
<div class="container mt-5">
    <h2 class="text-center"> Your Current Bookings </h2>
            
        <table class="table table-striped table-bordered">
            <thead class="table-dark">

                <tr>
                    <th> Customer Name </th>
                    <th> Email </th>
                    <th> Date Selected </th>
                    <th> Time Selected </th>
                    <th> Actions </th>
                </tr>

            </thead>
            <h>
                <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $booking): ?>

                <tr>
                    <td><?= esc($booking['customer_name']) ?></td>
                    <td><?= esc($booking['customer_email']) ?></td>
                    <td><?= esc($booking['date_selected']) ?></td>
                    <td><?= esc($booking['time_selected']) ?></td>
                    <td>
                        <form action="<?= base_url('/workers/delete/' . $booking['id']) ?>" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
                        </form>
                    </td>
                </tr>

                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center"> No Bookings Found! </td?>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>

</body>
</html>