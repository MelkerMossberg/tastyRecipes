<?php
  $file = '../resources/recipes.xml';
  $xml = simplexml_load_file($file);
  $deleteID = $_GET['commentid'];

  foreach ($xml->recipe as $item)
    if ($item->url == $_GET['url'])
      $recipe = $item;

  $comments = $recipe->commentlist;  

  print_r($recipeID.' and '. $deleteID.'</br></br>');
  //print_r($comments->comment->username.'</br></br>');

  foreach ($comments->comment as $comment) {
    if ($comment->commentID == $deleteID) {
      unset($comment[0][0]);
      unset($comment[0][1]);
      unset($comment[0][2]);
      unset($comment[0][3]);
      $xml->asXML($file);
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
