<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/Customers/Style_User.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<video autoplay muted loop id="myVideo" class="video-bg"> <!-- Nilagyan ko lang ng class pre HAHAH -->
  <source src="assets/userbg.mp4" type="video/mp4">
</video>

<!--Shows user dashboard -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">User Dashboard</h2>

                <!--Error Handling -->
                <?php if (session()->get('isLoggedIn')): ?>
                    <h4>Welcome, <?= esc(session()->get('name')) ?>!</h4>
                    <p> User Information: || <strong>Email:</strong> <?= esc(session()->get('email')) ?> || <strong>User Role:</strong> <?= esc(session()->get('user_role')) ?> || </p>
                

                  <!-- Worker List -->
                  <div class="worker-list mb-3">
                    <h4>Select a Worker:</h4>
                    <form action="<?= base_url('calendar') ?>" method="POST"> <!-- Change ko lang to POST -->
                        <select name="workerName" id="worker" class="form-select mb-3" style="text-align: center" required>
                            <option value="">-- Select Worker --</option>
                            <?php if (!empty($workers)): ?>
                                <?php foreach ($workers as $worker): ?>
                                    <option value="<?= esc($worker['name']) ?>"><?= esc($worker['name']) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option>No workers available</option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">Go to Calendar</button>
                    </form>
                </div>

                <?php if (session()->get('isLoggedIn')): ?>
                    <form action="<?= base_url('logout') ?>" method="post">
                        <button type="submit" class="btn btn-danger w-25 mt-3">Logout</button>
                    </form>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>

<?php else: ?>
    <div class="alert alert-warning">You are not logged in. Please log in first.</div>
<?php endif; ?>

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

            document.getElementById('selectedWorker').value = worker.innerText;

            continueBtn.classList.remove('d-none'); 
        });
    });

    //gets worker's name - ryk
    continueBtn.addEventListener('click', () => {
        const workerName = selectedWorker.innerText;
        window.location.href = "<?= base_url('calendar') ?>?workerName=" + encodeURIComponent(workerName);
    });
</script>

</body>
</html>
