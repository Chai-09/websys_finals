<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<!-- Back Button Logic -->
<a href="<?= base_url('/head_admin') ?>" class="btn btn-primary"> ⬅️ Back</a>
    <br> <br>

    <h2>Edit User: <?= esc($account['name']) ?></h2>

    <form action="<?= base_url('/head_admin/update/' . esc($account['id'])) ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?= esc($account['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= esc($account['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" name="status" value="<?= esc($account['status']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

</body>
</html>
