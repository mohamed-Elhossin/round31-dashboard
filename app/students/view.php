<!DOCTYPE html>
<html lang="en">
<?php include_once '../../shared/head.php'; ?>

<body>
    <?php

    include_once '../../shared/header.php';
    include_once '../../shared/aside.php'; ?>
<?php
include_once '../../vendor/env.php';
include_once '../../vendor/functions.php';

auth(2);
$count = 1;


if (isset($_GET['view'])) {
    $id =  $_GET['view'];

    $select = "SELECT * FROM users_data where id =$id";
    $allUsers = mysqli_query($connect, $select);
    $data = mysqli_fetch_assoc($allUsers);
} else {
    // redirect('')
}







?>



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>List All Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title">List User <?= $data['name'] ?> <a class="float-end" href="./index.php"> Back</a> </h5>

                    <div class="card">
                        <img width="200" src=" <?= base_url('/') .  $data['image'] ?>" alt="">
                        <div class="card-body">
                            <h5>name : <?= $data['name'] ?> </h5>
                            <hr>
                            <h5>email : <?= $data['email'] ?> </h5>
                            <hr>


                            <h5>created_by : <?= $data['created_by'] ?> </h5>
                            <hr>
                            <h5>rule_id : <?= $data['rule_id'] ?> </h5>
                            <hr>
                            <h5>rule_name : <?= $data['rule_name'] ?> </h5>
                            <hr>
                            <h5>rule_description : <?= $data['rule_description'] ?> </h5>
                            <hr>




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