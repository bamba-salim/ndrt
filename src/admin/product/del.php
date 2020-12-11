<?php
if (!isset($_GET['ref'])) :
  header("location: ./admin?root=product");
endif;


echo "<p>voulez vous vraiment suprimer {$_GET['ref']} </p>";
echo "<a href='./admin?root=product&ref={$_GET['ref']}' class='btn btn-secondary'>view</a>";
echo "<a href='./admin?root=product' class='btn btn-secondary' >retout à la liste</a>";
