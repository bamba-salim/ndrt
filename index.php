<?php
require './config/config.php';
$ptil = 'HOME';
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');
$category['type'] = CATEGORY::PRINCIPAL['id'];
$category['limit'] = 4;
$c = $CATEGORY->getCategoryList($category);
$category['limit'] = 3;
$category['except'] = $c[0]->id;
$co = $CATEGORY->getCategoryList($category);

?>
<main>
    <section class="">
        <div class="md-screen container bg-transparent p-2">
            <?php include_once('./src/index/gallery.php'); ?>
        </div>
        <div class="sm-screen">
            <?php include_once('./src/index/slider.php'); ?>
        </div>
    </section>
</main>
<?php include_once('./inc/footer.inc.php'); ?>