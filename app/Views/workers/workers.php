<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Workers Dashboard </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/CSS/Workers/Style_Workers.css">
        <link rel="icon" href="assets/Favicons/workers.png">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .socialCard {
                width: fit-content;
                height: fit-content;
                background-color: #2a2a2a;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 25px 25px;
                gap: 20px;
                box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.055);
            }

            .socialContainer {
                width: 52px;
                height: 52px;
                background-color: rgb(44, 44, 44);
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                transition-duration: .3s;
            }
            
            .containerOne:hover {
                background-color: #d62976;
                transition-duration: .3s;
            }
            
            .containerTwo:hover {
                background-color: #00acee;
                transition-duration: .3s;
            }
            
            .containerThree:hover {
                background-color: #0072b1;
                transition-duration: .3s;
            }
            
            .containerFour:hover {
                background-color: #128C7E;
                transition-duration: .3s;
            }

            .socialContainer:active {
                transform: scale(0.9);
                transition-duration: .3s;
            }

            .socialSvg {
                width: 17px;
            }

            .socialSvg path {
                fill: rgb(255, 255, 255);
            }

            .socialContainer:hover .socialSvg {
                animation: slide-in-top 0.3s both;
            }

            @keyframes slide-in-top {
                0% {
                    transform: translateY(-50px);
                    opacity: 0;
                }

                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
    </head>

    <body>

        <div class="logo" style="float: right; margin-right: 35px;">
            <img src="assets/logo1.jpg" style="width: 275px; height: 275px; border-radius: 50%">
        </div>

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