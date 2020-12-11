<div class="modal fade bd-example-modal-md" id="viewOrder<?= $order->info->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content p-3">
      <!-- header-->
      <div class="row justify-content-around my-2 text-dark">
        <div class="<?= STYLE::ORDER_CARD_COL ?> border-0 ">
          <div class="text-gold h6"><b>Commande N° <?= $order->info->ref ?></b></div>
          <div class=""><small>Date commande <b><?= $ORDER->DATE($order->info->created_at) ?></b></small></div>
          <div class=""><small><?= $order->status->text ?> <b><?= $ORDER->DATE($ORDER->dateStatus($order)) ?></b></small></div>
        </div>
        <div class="<?= STYLE::ORDER_CARD_COL ?> border-0 text-right">
          <div class="align-items-center"><?= $ORDER->progress_bar($order->status) ?></div>
        </div>
      </div>
      <hr class="my-2 py-2">

      <!-- adresse -->
      <div class="row justify-content-around my-2 text-dark">
        <div class="<?= STYLE::ORDER_CARD_COL ?> border-gold shadow-sm">
          <div class="text-dark ">
            <h5><b>Adresse de facturaton</b></h5>
            <p><?= $order->facturation->client ?> <?= !empty($order->facturation->client) && !empty($order->facturation->society) ? "|" : ""  ?> <?= ucfirst($order->facturation->society) ?></p>
            <p class="m-0 p-0"><?= $order->facturation->adresse ?></p>
            <p class="m-0 p-0"><?= $order->facturation->complement ?></p>
            <p class="m-0 p-0"><?= $order->facturation->zip ?> <?= $order->facturation->ville ?></p>
            <p class="m-0 p-0"><?= $order->facturation->pays ?> <?= !empty($order->facturation->pays) && !empty($order->facturation->region) ? "|" : ""  ?> <?= $order->facturation->region ?></p>
            <p class="m-0 p-0"><?= $order->facturation->phone ?></p>
          </div>
        </div>
        <div class="<?= STYLE::ORDER_CARD_COL ?> border-gold shadow-sm">
          <div class="text-dark">
            <h5><b>Adresse de livraison</b></h5>
            <p><?= $order->livraison->client ?> <?= !empty($order->livraison->client) && !empty($order->livraison->society) ? "|" : ""  ?> <?= ucfirst($order->livraison->society) ?></p>
            <p class="m-0 p-0"><?= $order->livraison->adresse ?></p>
            <p class="m-0 p-0"><?= $order->livraison->complement ?></p>
            <p class="m-0 p-0"><?= $order->livraison->zip ?> <?= $order->livraison->ville ?></p>
            <p class="m-0 p-0"><?= $order->livraison->pays ?> <?= !empty($order->livraison->pays) && !empty($order->livraison->region) ? "|" : ""  ?> <?= $order->livraison->region ?></p>
            <p class="m-0 p-0"><?= $order->livraison->phone ?></p>
          </div>
        </div>
      </div>

      <hr class="my-2 py-2">
      <!-- products -->
      <div class="row justify-content-around my-2 text-dark">
        <?php foreach ($order->products as $prod) : ?>
          <div class="<?= STYLE::ORDER_PROD_COL ?> my-2 shadow-sm ">
            <div class="row py-3">
              <div class="col-12 col-md-2">
                <figure class="m-0 p-0">
                  <div class="gallery-selected">
                    <?= "<img src='{$prod->product->img}' alt='{$prod->product->name}'/>" ?>
                  </div>
                </figure>
              </div>
              <div class="col">
                <div class=""><?= "<b>". strtoupper($prod->product->name) ."</b> - <small class='text-muted'>{$prod->product->ref}</small>" ?> </div>
                <div class="text-muted"><?= "<em>{$prod->product->color} / {$prod->product->col} / {$prod->product->cat} / {$prod->product->alt}</em>" ?></div>
                <div class="row">
                  <div class="col-0 col-md-6 text-right"></div>
                  <div class="col-4 col-md-2 text-right">PU: <?= $ORDER->PRICE($prod->price)->currency ?></div>
                  <div class="col-4 col-md-2 text-right">QTY: <?= $prod->qty ?></div>
                  <div class="col-4 col-md-2 text-right">PT: <?= $ORDER->PRICE($prod->price * $prod->qty)->currency ?></div>
                </div>
              </div>
            </div>


          </div>
        <?php endforeach; ?>
      </div>

      <hr class="my-2 py-2">

      <div class="row justify-content-around my-2 text-dark">
        <div class="<?= STYLE::NO_BDR_AND_RND ?> col-11 card  bg-dark text-gold font-weight-bold py-2">
          <div class="row">
            <div class="col-9 col-md-10 text-right">QTY :</div>
            <div class="col text-right"><?= $order->info->qty ?></div>
          </div>
          <div class="row">
            <div class="col-9 col-md-10 text-right">PT:</div>
            <div class="col text-right"> <?= $ORDER->PRICE($order->info->total)->currency  ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>