<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Worker Dashboard</h2>

                <?php if (session()->get('isLoggedIn')): ?>
                    <h4>Welcome, <?= esc(session()->get('name')) ?>!</h4>
                    <p><strong>Email:</strong> <?= esc(session()->get('email')) ?></p>
                    <p><strong>User Role:</strong> <?= esc(session()->get('user_role')) ?></p>
                <?php else: ?>
                    <div class="alert alert-warning">
                        You are not logged in. Please log in first.
                    </div>
                <?php endif; ?>

                <!-- Logout Button -->
                <?php if (session()->get('isLoggedIn')): ?>
                    <form action="<?= base_url('logout') ?>" method="post">
                        <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
