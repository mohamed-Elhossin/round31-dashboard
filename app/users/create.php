<!DOCTYPE html>
<html lang="en">
<?php include_once '../../shared/head.php'; ?>

<body>
    <?php

    include_once '../../vendor/env.php';
    include_once '../../vendor/functions.php';

    $errors = [];
    // Bool , Filter
    auth();
    $par_id = $_COOKIE['auth_user'];
    if (isset($_POST['submit'])) {
        $name = filterValidtion($_POST['name']);
        $email = filterValidtion($_POST['email']);
        $password =    htmlspecialchars($_POST['password']);
        $select = "SELECT * FROM `users` where `email` = '$email' ";
        $data =  mysqli_query($connect, $select);
        $numRows =  mysqli_num_rows($data);

 
        if (stringValidation($name, 50)) {
            $errors[] = "Please Enter Valid Name";
        }
        if (emailValidation($email, 50)) {
            $errors[] = "Please Enter Valid email";
        }
        if ($numRows > 0) {
            $errors[] = "This User Arady Exixest";
        } else {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $image_name = rand(0, 1000) . $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];

            if (sizeFileVaildation($file_size, 1)) {
                $errors[] = "You Size Bigger than 2 miga";
            }
            $location = "upload/$image_name";
            $full_path =  $location;
            $result =  move_uploaded_file($tmp_name, $location);
            if (empty($errors)) {
                $insert = "INSERT INTO users VALUES (NULL , '$name','$email','$hash_password','$full_path' , $par_id , 3, Default )";
                $i = mysqli_query($connect, $insert);
                redirect("/app/users");
            }
        }
    }
    include_once '../../shared/header.php';
    include_once '../../shared/aside.php';
    ?>



    <main id="main" class="main">


        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Layouts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section container col-10">
            <div class="row">
                <div class="col-lg-12">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Horizontal Form</h5>

                            <!-- Horizontal Form -->
                            <form method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="User Name" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="User Email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" placeholder="User Password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select name="type" class="form-control" id="">
                                            <option value="students">students</option>
                                            <option value="noraml">noraml</option>
                                            <option value="Instructor">Instructor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Horizontal Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->



    <?php include_once '../../shared/footer.php';
    include_once '../../shared/script.php';
    ?>

</body>

</html>