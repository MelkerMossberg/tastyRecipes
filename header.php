<?php
  session_start();
 ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=devive-width, initial-sclae=1">
      <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
      <link rel="stylesheet" href="css/master.css">
      <title></title>

    </head>

    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="index.php">Tasty Recipes</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="calendar.php">Calendar</a>
              </li>
            </ul>
            <div class="form-group row my-0">
              <?php
               if (isset($_SESSION['userId'])) {
                 echo '<form class="form-inline my-2 mr-4" action="includes/logout.inc.php" method="post">
                      <button type="submit" name="logout-submit" class="btn btn-outline-secondary">Log Out</button>
                      </form>';
               }else {
                 echo '<form class="form-inline my-2" action="includes/login.inc.php" method="post">
                        <input type="text" name="mailuid"class="form-control mr-2" placeholder="Email...">
                        <input type="password" name="pwd" class="form-control mr-4" placeholder="Password...">
                        <button type="submit" name="login-submit" class="btn btn-success">Login</button>
                        <a href="signup.php" class="ml-3 mr-5">Signup</a>
                      </form>';
               }
               ?>
            </div>
          </div>
        </nav>
        <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == 'emptyfields') {
            echo '
               <div class="row alert alert-dismissible alert-warning" id="warning">
                 <h6 class="alert-heading mx-auto mt-2">Nope dude! Cannot have empty fields</h6>
               </div>
               <script> setTimeout(function(){document.getElementById("warning").style.display = "none";}, 4000);</script>
            ';
          }
          elseif ($_GET['error'] == 'nouser') {
            echo '
               <div class="row alert alert-dismissible alert-warning" id="warning">
                 <h6 class="alert-heading mx-auto mt-2">Wut? What username is that?</h6>
               </div>
               <script> setTimeout(function(){document.getElementById("warning").style.display = "none";}, 4000);</script>
            ';
          }
          elseif ($_GET['error'] == 'wrongpassword') {
            echo '
               <div class="row alert alert-dismissible alert-warning" id="warning">
                 <h6 class="alert-heading mx-auto mt-2">Forgot your password? Then you register again i guess ¯\_(ツ)_/¯.</h6>
               </div>
               <script> setTimeout(function(){document.getElementById("warning").style.display = "none";}, 4000);</script>
            ';
          }else {
            echo '
               <div class="row alert alert-dismissible alert-warning" id="warning">
                 <h6 class="alert-heading mx-auto mt-2">WHAT DID YOU DO???.</h6>
               </div>
              <script> setTimeout(function(){document.getElementById("warning").style.display = "none";}, 4000);</script>
            ';
          }

        }
        ?>
      </header>
