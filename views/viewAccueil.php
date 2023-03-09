<?php 
$this->_t = "Accueil";
foreach($articles as $article){
    echo "<h2>".$article->getTitle()."</h2>";
    echo "<p>".$article->getContent()."</p>";
    echo "<time>".$article->getDate()."</time>";
}


?>