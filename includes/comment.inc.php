<?php
if (isset($_POST['comment-submit'])) {

  $file = '../resources/recipes.xml';
  $xml = simplexml_load_file($file);

  foreach ($xml->recipe as $item)
    if ($item->url == $_GET['url'])
      $recipe = $item;

  $comments = $recipe->commentlist;

  $newcomment = $comments->addChild('comment');
  $newcomment->addChild('commentID', $_GET['time']);
  $newcomment->addChild('username', $_GET['uid']);
  $newcomment->addChild('rating', '5');
  $newcomment->addChild('text', $_POST['usercomment']);
  //print_r($recipe);
  $xml->asXML($file);

  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();

}
