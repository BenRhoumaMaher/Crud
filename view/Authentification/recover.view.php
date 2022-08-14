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
    <div class="container mt-3 text-center">
        <h1 class="text-center text-danger fw-bold">Recover Password</h1>
        <h2 class="text-center text-muted">M&CODE</h2>
        <!-- with this action, the form will work on the current page you're in, if you change page it will work on that page -->
        <div class="mt-5">
        <span class="text-danger fw-bold"><?= message() ?></span>
        <form action="" method="POST">
            <div class="form-group fw-bold">
                <div class="col-md-6 mt-4 mx-auto">
                        <label for="name" class="text-success ms-2">Password :</label>
                        <span class="text-danger">*<?= " $errorPassword "?></span>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="col-md-6 mt-4 mx-auto">
                        <label for="name" class="text-success ms-2">Confirm Password :</label>
                        <span class="text-danger">*<?= " $errorConfirm "?></span>
                        <input class="form-control" type="password" name="confirm" id="confirm">
                    </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-5 mt-4 w-25" name="submit">Confirm</button>
                </div>
            </div>
        </form>
        </div>
</div>
</body>
</html>