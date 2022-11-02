<?php
session_start();

require_once "classes/auth.php";
$auth = new Auth();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query = $auth->adminLogin($username, $password);
    $get = pg_fetch_object($query);

    if ($get) {
      $_SESSION['username']=$_POST['username'];
      $_SESSION['user_id']=$get->id;
      echo "<script>window.location.href ='home.php';</script>";
      
    } else {
      $error = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/all.css">
      <link rel="stylesheet" href="css/login.css">

      <title> Admin Login</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">
                República da Guiné-Bissau
                <br>
                Sistema de Gestão de Imigrantes
              </h5>
              <div class="col-sm-10 mr-auto ml-auto mb-2">
                <img src="images/guinea-bissau.png" alt="" class="col-12">
              </div>

              <?php if ($error){?>
                <div class="alert alert-danger" role="alert">Username or Password is wrong! Please try again.</div>
              <?php } ?>

              <form class="form-signin" method="post">
                <div class="form-label-group">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                  <label for="username">Username</label>
                </div>

                <div class="form-label-group">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="signin">Conecte-se</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/jquery.bootstrap.min.js"></script>
    <script src="js/jquery.bootstrap.bundle.min.js"></script>
  </body>
</html>