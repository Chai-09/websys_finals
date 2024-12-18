<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title> Edit Profile </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/CSS/Customers/Style_Update.css">
        <link rel="icon" href="../assets/Favicons/update.png">
    </head>

    <body>

        <div class="container mt-5">
            <a href="<?= base_url('/user') ?>" class="btn btn-primary"> ⬅️ Back </a>
            <br><br>

            <h2> Edit Profile </h2>

            <form action="<?= base_url('/customer/updateProfile') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label"> Name </label>
                    <input type="text" class="form-control" name="name" value="<?= esc(session()->get('name')) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"> Email </label>
                    <input type="email" class="form-control" name="email" value="<?= esc(session()->get('email')) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"> Password </label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label"> Profile Image </label> <br>
                    <img src="../assets/customer_image/<?= esc(session()->get('image')) ?>" style="width: 175px; height: 175px; border-radius: 50%"> <br><br>
                    <input type="file" class="form-control" name="image">
                </div>
                <button type="submit" class="btn btn-primary"> Update Profile </button>
            </form>
        </div>

    </body>
</html>