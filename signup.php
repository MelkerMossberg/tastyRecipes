<?php
require "header.php";
 ?>

 <main >
   <div class="container">
     <div class="col-md-6 mx-auto">
       <h1 class="my-5">Sign Up</h1>
       <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>You have to fill in all fields</p>
              </div>';
            }
            elseif ($_GET['error'] == "invaliduidmail") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>The email you entered is invalid.</p>
              </div>';
            }
            elseif ($_GET['error'] == "invaliduid") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>The username you entered is invalid.</p>
              </div>';
            }
            elseif ($_GET['error'] == "invalidmail") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>The email you entered is invalid.</p>
              </div>';
            }
            elseif ($_GET['error'] == "passwordcheck") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>Your passwords do not match</p>
              </div>';
            }
            elseif ($_GET['error'] == "usertaken") {
              echo '<div class="alert alert-dismissible alert-danger">
              <p class="mb-0"><strong>Oh snap! </strong>That username is already taken</p>
              </div>';
            }
          }elseif (isset($_GET['signup'])){
              if ($_GET['signup'] == "success") {
                  echo '<div class="alert alert-dismissible alert-success">
                  <p class="mb-0"><strong>Well done! </strong>Signup was successful.</p>
                  </div>';
                }
          }


       ?>

       <form class="form-group mt-4" action="includes/signup.inc.php" method="post">
         <input class="form-control mb-2" type="text" name="uid" placeholder="Username">
         <input class="form-control mb-2"type="email" name="mail" placeholder="Email">
         <input class="form-control mb-2" type="password" name="pwd" placeholder="Password">
         <input class="form-control mb-2" type="password" name="pwd-repeat" placeholder="Repeat password">
         <button type="submit" name="signup-submit" class="btn btn-success mt-3 col-sm-12">Create user</button>

       </form>
     </div>

  </div>
 </main>

 <?php

 require "footer.php"

  ?>
