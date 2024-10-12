<!DOCTYPE html>
<html lang="en">
<?php include_once '../../shared/head.php'; ?>

<body>
    <?php
    include_once '../../vendor/env.php';
    include_once '../../vendor/functions.php';

    auth(2, 3);
    $count = 1;


    $select = "SELECT * FROM users_data";
    $allUsers = mysqli_query($connect, $select);

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $insert = "delete from users where id = $id";
        $i = mysqli_query($connect, $insert);
        redirect("/app/users");
    }

    ?>

    <?php

    include_once '../../shared/header.php';
    include_once '../../shared/aside.php'; ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>List All Students</h1>
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
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List Users <a class="float-end" href="./create.php"> Create New</a> </h5>


                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created_by</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Action</th>

                                        <!-- <th scope="col">Start Date</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allUsers as $item): ?>
                                        <tr>
                                            <th scope="row"><?= $count++ ?></th>

                                            <th scope="col"><?= $item['name'] ?></th>
                                            <th scope="col"><?= $item['email'] ?></th>
                                            <?php if ($item['created_by'] == null): ?>
                                                <th scope="col">Owner</th>
                                            <?php else: ?>
                                                <th scope="col"><?= $item['created_by'] ?></th>
                                            <?php endif; ?>
                                            <th scope="col"> <a class="text-danger" href="?delete=<?= $item['id'] ?>"> Delete</a> </th>
                                            <th scope="col"> <a class="text-info" href="view.php?view=<?= $item['id'] ?>"> View</a> </th>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

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