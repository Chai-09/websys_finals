<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Register</h2>
                
                <?php if(isset($validation)): ?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= base_url('/store') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="<?= set_value('email') ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Re-type Password</label>
                        <input type="password" name="confirmpassword" class="form-control" value="<?= set_value('confirmpassword') ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">User Role</label>
                        <select name="user_role" class="form-select">
                            <option value="head_admin">Head Admin</option>
                            <option value="worker">Worker</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
