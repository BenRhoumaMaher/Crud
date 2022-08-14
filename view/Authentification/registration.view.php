<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container mt-3">
        <h1 class="text-center text-danger fw-bold">Registration</h1>
        <h2 class="text-center text-muted">Welcome to M&CODE</h2>
        <!-- with this action, the form will work on the current page you're in, if you change page it will work on that page -->
        <form action="" method="POST">
            <div class="form-group fw-bold">
                <div class="row mb-3 mt-5">
                    <div class="col-md-6">
                        <label for="name" class="text-success ms-2">Name :</label>
                        <span class="text-danger">*<?= " " .$errorName ?></span>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="text-success ms-2">LastName :</label>
                        <span class="text-danger">*<?= " " .$errorLastName ?></span>
                        <input class="form-control" type="text" name="lastname" id="lastname">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="email" class="text-success ms-2">Email :</label>
                        <span class="text-danger">*<?= " " .$errorEmail; ?></span>
                        <span class="text-danger"><?= " " .$msg; ?></span>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Phone :</label>
                        <span class="text-danger">*<?= " " .$errorPhone ?></span>
                        <input class="form-control" type="text" name="phone" id="phone">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Country :</label>
                        <span class="text-danger">*<?= " " .$errorCountry ?></span>
                        <input class="form-control" type="text" name="country" id="country">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Gender :</label>
                        <span class="text-danger">*<?= " " .$errorGender ?></span>
                        <select class="form-control" name="gender" id="gender">
                            <option value="" selected disabled hidden>Please select</option>
                            <option value="male">Male</option>
                            <option value="femal">Femal</option>
                        </select>
                    </div>
                </div>
                <label for="comments" class="text-success ms-2">Message :</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Password :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="password" name="password" id="password">
                        <span class="text-danger"><?= " $errorPassword "?></span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Confirm Password :</label>
                        <span class="text-danger">*<?= " $errorConfirm "?></span>
                        <input class="form-control" type="password" name="confirm" id="confirm">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mt-4 w-25" name="submit">Register</button>
                </div>
                <div class="mb-5">
                <span class="text-muted">You Have an account ?</span><a href="login.php" class="text-decoration-none p-2">Login</a>
            </div>
</div>
        </form>
    </div>
</body>
</html>