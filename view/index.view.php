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
        <h1 class="text-center text-danger fw-bold">M&CODE</h1>
        <h2 class="text-center text-muted">Welcome</h2>
        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add</button>
            <a href="Authentification/logout.php">
                <button type="button" class="btn btn-danger">Logout</button>
            </a>
        </div>
            <p class="text-danger"><?= message(); ?></p>
        <form action="" method="POST" class=" mt-5">


            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">Job</th>
                        <th scope="col">Age</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   GLOBAL $dbc; 
                   $sql = "SELECT * FROM users";
                   $smt = $dbc->prepare($sql);
                   $smt->execute();
                   $res = $smt->fetchAll(PDO:: FETCH_OBJ);
                   $query = $smt->rowCount();
                   if($query > 0) {
                     foreach($res as $result)
                     {
                     ?>
                     <tr>
                     <td><?= chars($result->id); ?></td>
                     <td><?= chars($result->name); ?></td>
                     <td><?= chars($result->lastname); ?></td>
                     <td><?= chars($result->email); ?></td>
                     <td><?= chars($result->country); ?></td>
                     <td><?= chars($result->job); ?></td>
                     <td><?= chars($result->age); ?></td>
                     <td><a class="text-decoration-none text-danger" href="crud/delete.php?email=<?= chars($result->email); ?>">Delete</a></td>
                     <td><a class="text-decoration-none text-primary" href="crud/update.php?id=<?= chars($result->id); ?>">Update</a></td>
                     </tr>
                    <?php 
                    }}
                    ?>
                </tbody>
            </table>

        </div>
    </form>
    <!-- add code -->
    <form action="" method="post">
        <div class="modal fade" aria-hidden="true" id="add" tabindex ="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-muted">Updating</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                         </div>
                         <div class="modal-body">
                         <div class="form-group fw-bold">
                <div class="row mb-3 mt-5">
                    <div class="col-md-6">
                        <label for="name" class="text-primary ms-2">Name :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="name" id="name">
                        <span class="text-danger"><?= " " .$errorName ?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="text-primary ms-2">LastName :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="lastname" id="lastname">
                        <span class="text-danger"><?= " " .$errorLastName ?></span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="email" class="text-primary ms-2">Email :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="email" id="email">
                        <span class="text-danger"><?= " " .$errorEmail ?></span>
                        <span class="text-danger"><?= " " .$msg ?></span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-primary ms-2">Country :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="country" id="country">
                        <span class="text-danger"><?= " " .$errorCountry ?></span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-primary ms-2">Job :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="job" id="job">
                        <span class="text-danger"><?= " " .$errorJob ?></span>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="name" class="text-primary ms-2">Age :</label>
                        <span class="text-danger">*</span>
                        <input class="form-control" type="text" name="age" id="age">
                        <span class="text-danger"><?= " " .$errorAge ?></span>
                    </div>
                </div>
                </div>
                         </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                         </div>
                    </div>
                </div>
            </div>
        <div> 
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>