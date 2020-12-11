<?php
require './config/config.php';
if (isset($_GET['del'])) :
  switch ($_GET['del']):
    case $_GET['del'] > 0:
      $CART->takeOff($_GET['del']);
      header('location: ./cart');
      exit();
      break;
    case 'all':
      unset($_SESSION['cart']);
      header('location: ./cart');
      exit();
      break;
  endswitch;
endif;
if (isset($_GET['upd'])) :
  switch ($_POST['qty']):
    case 0:
      $CART->takeOff($_GET['upd']);
      header('location: ./cart');
      exit();
      break;
    default:
      $CART->upd($_GET['upd'], $_POST['qty']);
      header('location: ./cart');
      exit();
      break;
  endswitch;
endif;



$ptil = "Panier";
include_once('./inc/head.inc.php');
include_once('./inc/header.inc.php');
?>
<main>
  <section class="container p-0">
    <div class="row-cols-1 p-0 my-2">
      <div class="col bg-gold text-white clearfix">
        <h2 class="float-left p-2">Votre panier</h2>
        <p class="float-right small p-2"><?= $CART->cartQty()->title ?></p>
      </div>
      <div class="col m-0">
        <?php
        if (empty($_SESSION['cart'])) : echo "<div class='card border-0 rounded-0 p-5 h1 text-center'>Votre panier est vide</div>";
        else : foreach ($_SESSION['cart'] as $value) :
        ?>
            <div class="card my-2 border-0 p-0 m-0">
              <div class="row">
                <div class="col-4 col-md-3 col-lg-2 p-0 m-0">
                  <!-- photo -->
                  <figure class="m-0 p-0">
                    <div class="gallery-selected">
                      <?= "<a href='./product?ref={$value['ref']}'>" ?>
                      <?= "<img src='{$value['img']}' alt='{$value['name']}'/>" ?>
                      </a>
                    </div>
                  </figure>
                </div>
                <div class="col row p-0 m-0">
                  <!-- info -->
                  <div class="col-12 row p-0 m-0">
                    <div class="col-7 col-sm-8 col-md-10">
                      <?= "<p class='p-2 m-0'><a href='./product?ref={$value['ref']}' class='text-decoration-none text-dark'>{$value['name']}</a></p>" ?>
                    </div>
                    <div class="col p-0 m-0">
                      <?= "<form action='./cart?upd={$value['ref']}' method='post' class='m-0'> " ?>
                      <div class="row m-0 p-0 w-100">
                        <?= "<input type='number' name='qty' class='ndrtInput bg-transparent col-6' min=0 max=12 value='{$value['qty']}'/>" ?>
                        <button type="submit" class="btn btn-info btn-sm col-0 rounded-0 col-4"><?= ICON::REFRESH ?></button>
                      </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-12 p-0 m-0 row">
                    <div class="col-6 col-md-9 col-lg-10">
                      <p class="col text-right ">Prix unitaire</p>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                      <?= "<p class='col text-right '> {$PRODUCT->PRICE($value['price'])->currency}</p>" ?>
                    </div>
                    <div class="col-6 col-md-9 col-lg-10">
                      <p class="col text-right ">Prix total</p>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                      <?= "<p class='col text-right m-0'>{$PRODUCT->PRICE($value['price'] * $value['qty'])->currency}</p>" ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr class="p-0 m-0 mx-auto">
        <?php
          endforeach;
        endif;
        ?>
      </div>
      <?php if (!empty($_SESSION['cart'])) : ?>
        <?php if ($NAV->isCollab()) : ?>
          <div class="col bg-gold m-0 p-0 text-white row p-2">
            <div class="col-4 col-md-6 p-0">
            </div>
            <?= "<div class='col-4 col-md-4 text-right p-0'>Remise collaborateur de 15%</div>" ?>
            <?= "<div class='col-4 col-md-2 text-right p-0'>{$CART->PRICE($CART->newTotal()->remise)->currency}</div>" ?>
          </div>
        <?php endif; ?>
        <div class="col bg-dark m-0 p-0 text-gold row p-2">
          <div class="col-4 col-md-6 p-0">
            <?php !empty($_SESSION['cart']) ? print("<a href='./cart?del=all' class='text-danger'>" . ICON::CROSS . "</a>") : "" ?>
          </div>
          <div class='col-4 col-md-4 text-right p-0'>Total à payer</div>
          <?= "<div class='col-4 col-md-2 text-right p-0'>{$CART->PRICE($CART->newTotal()->price)->currency}</div>" ?>
        </div>
      <?php endif ?>
      <div class="col bg-gold m-0 p-0 text-white p-2 row">
        <div class="col-12 p-0 mx-auto">
          <div class="mx-auto col-10 col-sm-6 col-lg-4 row">
            <a href="./category" class="btn btn-secondary w-50 rounded-0 col"><?= ICON::BACK ?> Shop</a>
            <a <?= $NAV->hidden(!$NAV->isLog() || empty($_SESSION['cart'])) ?> onclick="chooseAdresse()" class="btn btn-success w-50 rounded-0 col">Commander</a>
          </div>
        </div>
        <div class="col-12 p-0 text-center small text-wrap">
          <?= !$NAV->isLog() ? "<a data-toggle='modal' data-target='#exampleModal' class='text-white' style='cursor: pointer;'><u>{$LOGIN->IN_ALT}</u></a> ou <a href='./login?sign=up' class='text-white'><u>{$LOGIN->UP_ALT}</u></a> pour commander." : '' ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
include('./src/modals/adress_choice_modals.php');
$script = './js/js-cart.js?vr=1';
include_once('./inc/footer.inc.php');
?>