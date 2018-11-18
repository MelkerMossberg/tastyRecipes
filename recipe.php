<?php
if (isset($_GET['url'])) {
  require "header.php";

  function findRecipe(){
    $xml = simplexml_load_file('resources/recipes.xml');
    foreach ($xml->recipe as $item)
      if ($item->url == $_GET['url']){
        return $item;
      }
    echo "Problem with finding recipe";
  }
  $recipe = findRecipe();
  $ingredients = (array) $recipe->ingredientlist->ingredient;
  $instructions = (array) $recipe->instructionList->instruction;
  $usercomments =  $recipe->commentlist[0];

  // If the user has any comments on this page we save the variable containg their comment_id
  if (isset($_POST['comment_id'])) {
    $newID = $_POST['comment_id'];
  }

}else {
  header('Location: index.php');
}
 ?>

 <main >

     <div class="container">
       <div class="m-0 p-0">
       <?php echo '<div class="jumbotron mt-4" id="recipe-photo"
                  style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('.$recipe->imageurl .')">
                    <div id="jumbotron-text">
                      <h1>'.$recipe->title.'</h1>
                      <h6>Prep-time: '.$recipe->preptime.' Cook-time: '.$recipe->cooktime.'</h6>
                    </div>
                  </div'
       ?>
     </div>
   </div>
     <div class="row my-3 mx-0">
    <div class="col-lg-4 px-0">
        <h5>Ingredienser</h5>
        <ul class="list-group col-sm-12 mr-auto mt-3 px-0">
            <?php
              foreach ($ingredients as $ingredient) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                  ' . $ingredient .  '
                </li>';
              };
            ?>
        </ul>
    </div>
    <div id="recipe-texts" class="col-lg-8 pr-0">
        <h5>Beskrivning</h5>
        <div class="card bg-light my-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $recipe->title ?></h5>
                <p class="mb-0"> <?php echo $recipe->description ?> </p>
            </div>
        </div>
        <h5 class="my-3">Instruktioner</h5>
        <div class="card bg-light ">
            <ol class="card-body px-5 pb-0">
                <?php
                  foreach ($instructions as $instruction) {
                    echo '<li class="mb-3">'. $instruction .'</li>';
                  };
                ?>
            </ol>
        </div>
        <h5 class="my-3">Kommentarer</h5>
        <div class="card bg-light">
            <div class="card-body m-0 px-5 pt-4 pb-1" id="comments">
              <?php
                for ($i=0; $i < sizeof($usercomments); $i++) {
                  echo '
                  <div class="mb-4 comment" id="'.$usercomments[0]->comment[$i]->commentID.'">
                      <div class="row my-0">
                          <h6 class="my-0">'. $usercomments[0]->comment[$i]->username .'</h6>
                          <p class="recipe-rating">Betyg: '. $usercomments[0]->comment[$i]->rating .'/5</p>';

                  //If this is a comment made by current user -> spawn "delete button"
                  if (isset($_SESSION['userId']) && ($_SESSION['userUid'] == $usercomments[0]->comment[$i]->username)) {
                    echo '
                        <form class="form-inline ml-auto delete-comment" action="includes/deletecomment.inc.php?url='. $_GET['url'] .'&commentid='. $usercomments[0]->comment[$i]->commentID .'" method="post">
                        <button class="btn btn-outline-danger ml-auto" name="delete-submit" type="submit">Ta bort</button>
                        </form>
                    ';
                  }

                  echo '
                      </div>
                      <p class="recipe-text"> '. $usercomments[0]->comment[$i]->text .' </p>
                      <hr class="comment-line">
                  </div>
                  ';
                }
               ?>

                <?php
                  if (isset($_SESSION['userId'])) {
                    $timestamp = round(microtime(true) * 1000);
                    echo '
                    <div class="card-body m-0 p-0">
                      <div class="row" id="comment-info">
                        <h6>Write a comment as: "'. $_SESSION['userUid'] .'"</h6>
                      </div>
                      <form class="form-group" action="includes/comment.inc.php?url='.$_GET['url'].'&uid='.$_SESSION['userUid'].'&time='.$timestamp.'" method="post">
                        <input type="text" autocomplete="off" name="usercomment"class="form-control" placeholder="Comment...">
                        <button type="submit" name="comment-submit" class="btn btn-success">Skicka</button>
                      </form>
                    </div>
                    ';
                  }
                 ?>


            </div>
        </div>
    </div>
  </div>
 </main>

 <?php

 require "footer.php"

  ?>
