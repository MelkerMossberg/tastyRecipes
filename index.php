<?php
require "header.php";

/*
* Fetch XML and store all <recipe>-nodes in array.
*/
$recipes = array();
$xml = simplexml_load_file("resources/recipes.xml");
foreach ($xml->recipe as $item) {
  $recipe = array();
  foreach ($item as $key => $value) {
    $recipe[(string)$key] = (string)$value;
  }
  $recipes[] = $recipe;
}
?>

<main >
  <div class="container">
    <div class="jumbotron mt-4" id="start-jumbotron">
      <div id="jumbotron-text" class="col-sm-8">
          <h1>Välkommen</h1>
          <form class="form-inline justify-content-center mt-3">
              <input type="text" id="recipeFilter" onkeyup="filterOut()" class="form-control col-lg-8"
                     placeholder="Sök recept">
          </form>
      </div>
    </div>

     <div id="recipe-cards" class="card-columns">
     <?php
      foreach ($recipes as $key => $value) {
        $rec = $recipes[$key];
        echo "
          <a class='recipe-prev m-0 p-0' href='recipe.php?url={$rec['url']}'>
             <div class='card'>
               <img class='card-img-top img-fluid' alt='tasty-img' src='{$rec['imageurl']}'>
               <div class='card-block p-3'>
                  <h5 class='card-title'>{$rec['title']}</h5>
                  <p class='card-text'>{$rec['description']}</p>
               </div>
             </div>
          </a>
        ";
      }
     ?>
    </div>
  </div>
</main>

<?php
 require "footer.php"
?>

<script type="text/javascript">
  /*
  *
  */
  function filterOut() {
      const cards = document.getElementsByClassName('recipe-prev');
      const filterVal = document.getElementById('recipeFilter').value;

      // reset the filter
      for (let i = 0; i < cards.length; i++) {
          cards[i].style.display = 'block';
      }

      // set new filter
      for (let i = 0; i < cards.length; i++) {
          if (!cards[i].getElementsByTagName('h5')[0].textContent.toLowerCase().includes(filterVal)) {
              cards[i].style.display = 'none';
          }
      }

  }
</script>
