<?php
include_once('./config/config.php');
$test = !empty($_GET['ref']) ? $_GET['ref'] : (!empty($_GET['id']) ? $_GET['id'] : (!empty($_GET['name']) ? $_GET['name'] : ""));
$product['test'] = $test;
$p = !empty($PRODUCT->getProduct2($product)) ? $PRODUCT->getProduct2($product) : "";
$ptil = $p != null ?  $p->name : 404;
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');


if (!empty($p)) {

    $cat = new stdClass();
    $cat->test = $p->idCat;
    $cat->limit = 4;
    $cat->rand = true;
    $cat->except = $p->id;
    $cat->bg = "dark";
    $cat->txt = "white";
    $cat->title = "PRODUITS SIMILAIRES \"{$p->cat}\"";

    $col = new stdClass();
    $col->test = $p->idCol;
    $col->limit = 4;
    $col->rand = true;
    $col->except = $p->id;
    $col->bg = "warning";
    $col->txt = "white";
    $col->title = "PRODUITS SIMILAIRES \"{$p->col}\"";

    $alt = new stdClass();
    $alt->test = $p->idAlt;
    $alt->limit = 4;
    $alt->rand = true;
    $alt->except = $p->id;
    $alt->bg = "info";
    $alt->txt = "white";
    $alt->title = "PRODUITS SIMILAIRES \"{$p->alt}\"";

    $new = new stdClass();
    $new->new = true;
    $new->limit = 4;
    $new->except = $p->id;
    $new->bg = "success";
    $new->txt = "white";
    $new->title = "DERNIERS ARTICLES";

}
?>
<main>
    <nav class='container'>
        <ol class='<?= STYLE::BREADCRUMB ?>'>
            <li class='breadcrumb-item'><a href='./' class='text-white'>HOME</a></li>
            <li <?= $NAV->hidden($p == null) ?> class='breadcrumb-item'><a href='./category?cat=<?= $p->cat ?>' class='text-white text-uppercase'><?= $p->cat ?></a></li>
            <li <?= $NAV->hidden($p == null) ?> class='breadcrumb-item active' aria-current='page'><span class='text-uppercase'><?= $p->name ?></span></li>
            <li <?= $NAV->hidden($p != null) ?> class='breadcrumb-item active' aria-current='page'><span class='text-uppercase'>404</span></li>
        </ol>
    </nav>
    <section class='container'>
        <?php empty($p) ? $NAV->notFound("Essayez un autre article") : include_once('./src/category/product_page.php') ?>
    </section>

    <!-- articles similaires collections -->
    <div <?= $NAV->hidden(empty($p)) ?> class="m-0 p-0 mb-2"><?php $PRODUCT->listProduct($col) ?></div>

    <!-- articles similaires caatégorie -->
    <div <?= $NAV->hidden(empty($p)) ?> class="m-0 p-0 mb-2"><?php $PRODUCT->listProduct($cat) ?> </div>

    <!-- articles similaires caatégorie -->
    <div <?= $NAV->hidden(empty($p)) ?> class="m-0 p-0 mb-2"><?php $PRODUCT->listProduct($alt) ?></div>

    <!-- articles similaires caatégorie -->
    <div <?= $NAV->hidden(empty($p)) ?> class="m-0 p-0 mb-2"><?php $PRODUCT->listProduct($new) ?></div>

</main>


<?php include_once('./inc/footer.inc.php'); ?>