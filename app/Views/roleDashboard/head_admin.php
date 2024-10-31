<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Head Admin Dashboard</h2>

                <?php if (session()->get('isLoggedIn')): ?>
                    <h4>Welcome, <?= esc(session()->get('name')) ?>!</h4>
                    <p><strong>Email:</strong> <?= esc(session()->get('email')) ?></p>
                    <p><strong>User Role: Head Admin</strong></p>
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

    
<br> <br>
    <!-- Add New Workers (if may kulang pasabi) -->
    <div class="card p-4 mb-4">
        <h4>Add New Worker</h4>
        <form action="<?= base_url('/head_admin/add_worker') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" name="status" value="Active" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Worker</button>
        </form>
    </div>

    <!-- Filter Options (not sure if need pa yung head_admin since 1 lang naman ata-->
    <div class="mt-5">
        <form method="get" class="mb-4">
            <label for="filter" class="form-label">Filter by Role:</label>
            <select name="role_filter" class="form-select" id="filter" onchange="this.form.submit()">
                <option value="all" <?= ($role_filter === 'all') ? 'selected' : '' ?>>All Accounts</option>
                <option value="worker" <?= ($role_filter === 'worker') ? 'selected' : '' ?>>Worker Accounts</option>
                <option value="user" <?= ($role_filter === 'user') ? 'selected' : '' ?>>User Accounts</option>
            </select>
        </form>
    </div>

    <!-- Table of Accounts  -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($accounts)): ?>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td><?= esc($account['id']) ?></td>
                            <td><?= esc($account['name']) ?></td>
                            <td><?= esc($account['email']) ?></td>
                            <td><?= esc($account['user_role']) ?></td>
                            <td><?= esc($account['status']) ?></td>
                            <td>
                                <a href="<?= base_url('/head_admin/edit/' . $account['id']) ?>" class="btn btn-warning btn-sm">Update</a>
                                <form action="<?= base_url('/head_admin/delete/' . $account['id']) ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No accounts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<br><br><br><br>

</body>
</html>
