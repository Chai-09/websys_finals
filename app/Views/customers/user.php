<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> User Dashboard </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/CSS/Customers/Style_User.css">
        <link rel="icon" href="assets/Favicons/profile-user.png">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>

        <video autoplay muted loop id="myVideo" class="video-bg">
            <source src="assets/userbg.mp4" type="video/mp4">
        </video>

        <!-- Shows User Dashboard -->
        <div class="container mb-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center mb-4"> User Dashboard </h2>

                        <!-- For Error Handling -->
                        <?php if (session()->get('isLoggedIn')): ?>

                        <h4> Welcome, <?= esc(session()->get('name')) ?>! </h4>
                        <div>
                            <img src="assets/customer_image/<?= esc(session()->get('image')) ?>" class="mb-2">
                        </div>
                        <p class="mb-2"> User Information: || <strong> Email: </strong> <?= esc(session()->get('email')) ?> || </p>
                        <a href="<?= base_url('/customers/update/')?>" class="btn btn-warning btn-sm mb-3"> Update </a>

                        <!-- Shows the List of Workers -->
                        <div class="worker-list mb-3">
                            <h4> Select a Worker: </h4>
                            <form action="<?= base_url('calendar') ?>" method="POST">
                                <select name="workerId" id="worker" class="form-select mb-3" style="text-align: center" required>
                                    <option value=""> -- Select Worker -- </option>
                                    <?php if (!empty($workers)): ?>
                                        <?php foreach ($workers as $worker): ?>
                                            <option value="<?= esc($worker['id']) ?>"><?= esc($worker['name']) ?> </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option> No workers available. </option>
                                    <?php endif; ?>
                                </select>
                                <button type="submit" class="btn btn-primary w-100"> Go to Calendar </button>
                            </form>
                        </div>

                        <?php if (session()->get('isLoggedIn')): ?>
                            <form action="<?= base_url('logout') ?>" method="post">
                                <button type="submit" class="btn btn-danger w-25 mt-3"> Logout </button>
                            </form>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php else: ?>
            <div class="alert alert-warning"> You are not logged in. Please log in first. </div>
        <?php endif; ?>

        <div id="divider">
            <br><br><br><br><br><br><br><br><br><br>
        </div>

        <!-- Customer Bookings -->
        <div class="container mt-5 mb-5">
            <h2 class="text-center"> Your Current Bookings </h2>    
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th> Worker Selected </th>
                            <th> Date Selected </th>
                            <th> Time Selected </th>
                            <th> Time of Booking </th>
                        </tr>
                    </thead>
                    <h>
                        <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                            <td><?= esc($booking['worker_name']) ?></td>
                            <td><?= esc($booking['date_selected']) ?></td>
                            <td><?= esc($booking['time_selected']) ?></td>
                            <td><?= esc($booking['time_of_booking']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center"> You have no Bookings Scheduled! </td?>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
        </div>

        <script>
            const workers = document.querySelectorAll('.worker');
            const continueBtn = document.getElementById('continue-btn');
            let selectedWorker = null;

            workers.forEach(worker => {
                worker.addEventListener('click', () => {
                    if (selectedWorker) {
                        selectedWorker.classList.remove('selected');
                    }
                    worker.classList.add('selected');
                    selectedWorker = worker;
                    
                    document.getElementById('selectedWorkerId').value = worker.dataset.workerId;
                    document.getElementById('selectedWorkerName').value = worker.innerText;

                    continueBtn.classList.remove('d-none'); 
                });
            });

            // Retrieves the Name of the Chosen Worker - eiryk
            continueBtn.addEventListener('click', () => {
                const workerName = selectedWorker.innerText;
                window.location.href = "<?= base_url('calendar') ?>?workerName=" + encodeURIComponent(workerName);
            });
        </script>

    </body>
</html>