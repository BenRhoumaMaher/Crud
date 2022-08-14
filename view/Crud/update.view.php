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
        <h1 class="text-center text-danger fw-bold">Update</h1>
        <h2 class="text-center text-muted">M&CODE</h2>
        <!-- with this action, the form will work on the current page you're in, if you change page it will work on that page -->
                   <?php
                   $uid = $_GET['id'];
                   GLOBAL $dbc; 
                   $sql = "SELECT * FROM users WHERE id = $uid";
                   $smt = $dbc->prepare($sql);
                   $smt->execute();
                   $res = $smt->fetchAll(PDO:: FETCH_OBJ);
                   $query = $smt->rowCount();
                   if($query > 0) {
                     foreach($res as $result)
                     {
                   ?>
        <form action="" method="POST">
            <div class="form-group fw-bold">
                <div class="row mb-3 mt-5">
                    <div class="col-md-6">
                        <label for="name" class="text-success ms-2">Name :</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $result->name ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="text-success ms-2">LastName :</label>
                        <input class="form-control" type="text" name="lastname" id="lastname" value="<?= $result->lastname ?>">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Country :</label>
                        <input class="form-control" type="text" name="country" id="country" value="<?= $result->country ?>">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Job :</label>
                        <input class="form-control" type="text" name="job" id="job" value="<?= $result->job ?>">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-success ms-2">Age :</label>
                        <input class="form-control" type="text" name="age" id="age" value="<?= $result->age ?>">
                    </div>
                </div>
                </div>
                <?php }} ?>
                    <button type="submit" class="btn btn-primary mt-4 w-25" name="update">Update</button>
                    <a href="../index.php">
                        <button type="button" class="btn btn-secondary mt-4">Cancel</button>
                    </a>
</div>
        </form>
    </div>
</body>
</html>