<?php

$button = $_GET['submit']; 
$search = $_GET['search']; 

if (!$button){
  echo "you didn't submit a keyword"; 
} else {
  if (strlen($search) <= 1) {
    echo "Search term too short";
  } else {
    echo "You searched for <b>".$search."</b> <hr size='1'> <br />"; 
    // connexion à la base de donnée
    mysql_connect ("localhost", "USER_NAME", "PASSWORD");
    mysql_select_db("DB_NAME");
  
    // construire la requête 
    $search_exploded = explode(" ", $search);
    $x = 0; 
    
    foreach( $search_exploded as $search_each) {
      $x++;
      $construct_state = "";
      if ($x == 1) {
        $construct_state .="keywords like '.$search_each.' "; 
      } else {
        $construct_state .="AND keywords LIKE '.$search_each.' ";
      }
    }

    $construct = "SELECT * FROM SEARCH_ENGINE WHERE '.$construct_state.' "; 
    $run = mysql_query($construct); 
    $foundnum = mysql_num_rows($run); 

    // récupérez le résultat et présentez-le à l'utilisateur 
    if ($foundnum == 0) {
      echo "Sorry, there are no matching result for <b>".$search."</b>
        <br />
        <br /> 1. Essayez ds mots plus généraux. Par exemple: Si vous rechercher 'Comment créer un site web', utilisez un mot clé général comme 'créer' 'siteweb'.
        <br /> 2. Essayez des mots différents avec un sens similaire.
        <br /> 3. S'il vous plaît vérifiez votre orthographe";
    } else {
      echo "<p>".$foundnum." résultat trouvés ! </p>";
      while ($runrows = mysql_fetch_assoc($run)) {
        $title = $runrows['titre'];
        $desc = $runrows['description'];
        $url = $runrows['url'];
        echo "<p><a href=".$url."> <b>".$title."</b> </a> <br />".$desc."<br /> <a href=".$url.">".$url."</a> </p>";
      }
    }
  }
}
