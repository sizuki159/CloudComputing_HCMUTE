<?php

require './config.php';


if(isset($_POST["username"])) {
    $username   = mysqli_escape_string($conn, $_POST["username"]);
    $password   = md5(mysqli_escape_string($conn, $_POST["password"]));
    $email      = mysqli_escape_string($conn, $_POST["email"]);

    // if(strlen($username < 3) || strlen($password < 3) || strlen($email < 3)) {
    //   setcookie("error", "Register Error");
    //   header("Location: register.php");
    //   exit();
    // }

    $sql = "INSERT INTO `users`(`username`, `password`, `email`, `created_at`) VALUES('".$username."', '".$password."', '".$email."', '".time()."')";
    $result = $conn->query($sql);
    if($result === TRUE) {
        $_SESSION["logged"]     = true;
        $_SESSION["username"]   = $username;
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Polly</title>
    <link rel="shortcut icon" type="image/png" href="./logo.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style/register.css">
</head>
<body>


<?php
include_once './header.php';
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>


              <?php
                    if(isset($_COOKIE["error"])){
                ?>
                <div class="alert alert-danger">
                    <?php
                        echo $_COOKIE["error"];
                        unset($_COOKIE["error"]);
                        setcookie('error', null, -1, '/'); 
                    ?>
                </div>
              <?php } ?>

              <form method="POST" action="./register.php">
                <div class="form-outline mb-4">
                  <input type="text" name="username" id="username" class="form-control form-control-lg" />
                  <label class="form-label" for="username">UserName</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" />
                  <label class="form-label" for="email">Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" id="password" class="form-control form-control-lg" />
                  <label class="form-label" for="password">Password</label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="./login.php"
                    class="fw-bold text-body"><u>Login here</u></a>
                </p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>