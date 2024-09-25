<!DOCTYPE html>
<html lang="en">
<?php include_once './shared/head.php';
include_once './vendor/env.php';
auth();
$user_id = $_SESSION['auth']['id'];

$select = "SELECT * FROM users WHERE  id  = $user_id";
$d = mysqli_query($connect, $select);

$data = mysqli_fetch_assoc($d);


$message = null;
if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  //  Image Code
  if (empty($_FILES['image']['name'])) {
    $image_name = $_SESSION['auth']['image'];

    $full_path =   $image_name;
  } else {
    $oldImage = $_SESSION['auth']['image'];
    unlink($oldImage);
    $image_name = rand(0, 1000) . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "app/users/upload/$image_name";
    $full_path =  $location;
    $result =  move_uploaded_file($tmp_name, $location);
  }

  $update = "UPDATE users SET `name` = '$name' , email = '$email' , `image` = '$full_path' where  id = $user_id   ";
  $u = mysqli_query($connect, $update);
  $_SESSION['auth']['name'] = $name;
  $_SESSION['auth']['email'] = $email;
  $_SESSION['auth']['image'] = $full_path;

  redirect("profile.php");
}


if (isset($_POST['changePassword'])) {
  $EnterYourCurrenPassword =   $_POST['password'];
  $newpassword =   $_POST['newpassword'];
  $renewpassword = $_POST['renewpassword'];


  if (password_verify($EnterYourCurrenPassword, $data['password'])) {

    if ($newpassword == $renewpassword) {
      $hash_password = password_hash($newpassword, PASSWORD_DEFAULT);
      $update = "UPDATE users SET  password = '$hash_password' where  id = $user_id   ";
      $u = mysqli_query($connect, $update);
      redirect("profile.php");
    } else {
      $message = "confimration password False";
    }
  } else {
    $message = "Wrong Password";
  }
}

?>

<body>
  <?php include_once './shared/header.php';
  include_once './shared/aside.php';
  ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <?php if ($message != null):  ?>
        <div class="alert alert-danger">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= $data['image'] ?>" alt="Profile" class="rounded-circle">
              <h2><?= $data['name'] ?> </h2>
              <h3><?= $data['email'] ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $data['name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $data['email'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">Web Designer</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">USA</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?= $data['image'] ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" name="image" class="w-50 form-control btn btn-primary">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?= $data['name'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= $data['email'] ?>">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
                </div>
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input id="newpassword" name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input id="renewpassword" name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <!-- <script>
    let newpassword = document.querySelector("#newpassword");
    let renewpassword = document.querySelector("#renewpassword");

    renewpassword.addEventListener("keyup", function() {
      let first = newpassword.value;
      let second = renewpassword.value;

      if (first != second) {
        console.log("الباسورد غير متطاااابق");
      } else {
        console.log("ايووواه اثبت كدا متطااابق");

      }

    });
  </script> -->
  <?php include_once './shared/footer.php';
  include_once './shared/script.php';
  ?>

</body>

</html>