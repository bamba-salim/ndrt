<?php
include_once('./config/config.php');

$cat = new stdClass();
$ptil = 404;

if (!empty($_GET['id'])) $cat->test = $_GET['id'];
if (!empty($_GET['cat'])) $cat->test = $_GET['cat'];

$products  = !empty($cat->test) ? $PRODUCT->getProductList($cat) : $PRODUCT->getProductList();

 if(empty($cat->test) && !empty($products)) $ptil = CATEGORY::ALL;
 if(!empty($cat->test)) $ptil = $CATEGORY->getCategory($cat)->name;

$type['avoid'] = true;
$type['rand'] = true;
$categories = $CATEGORY->getCategoryList($type);
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');
?>
<main>
  <nav class='container'>
    <ol class="<?= STYLE::BREADCRUMB ?>">
      <li class='breadcrumb-item'><a href='./' class='text-white'>HOME</a></li>
      <li <?= $NAV->hidden(empty($products)) ?> class='breadcrumb-item active' aria-current='page'><span class='text-uppercase'><?= $ptil ?></span></li>
      <li <?= $NAV->hidden(!empty($products)) ?> class='breadcrumb-item active' aria-current='page'><span class='text-uppercase'>404</span></li>
    </ol>
  </nav>
  <section class="container">
    <div class='row'>
      <div <?= $NAV->hidden(empty($products)) ?> class='col-lg-3 col-12 mt-3 p-0'>
        <section class='container'>
          <div class='breadcrumb p-3 bg-light shadow-sm <?= STYLE::NO_BDR_AND_RND ?>'>
            <?php foreach ($categories as $value) :
              extract($CATEGORY->getCatColor($value->idType));
              $hiddenCat =  $NAV->hidden(empty($PRODUCT->getProductList($value)));
            ?>
              <a class='badge <?= "badge-{$bg} text-{$txt}" . SITE::NO_BDR_AND_RND ?>  m-2 p-2 small' href='./category?cat=<?= $value->name ?>' <?= $hiddenCat ?>>
                <?= strtolower($value->name) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </section>
      </div>
      <div class="col ">
        <?php !empty($products) ? include_once('./src/module/list_category_module.php') : $NAV->notFound($CATEGORY->getFromUrl()) ?>
      </div>

    </div>
  </section>
</main>
<?php include_once('./inc/footer.inc.php'); ?>