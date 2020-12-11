<?php
include_once './config/config.php';
$u = $USER->getUser();
$user = new stdClass();
$user->user = $u->info->id;
$user->actived = true;
$ordersList = $ORDER->getOrderList($user);
$adressList = $ADRESSE->getAdresseList($user);
$ptil = "Mon profile";
include_once './inc/head.inc.php';
include_once './inc/header.inc.php';

?>
<main>
  <section class="<?=STYLE::ADMIN_TITLE_BG?>">
    <h2 class="<?=STYLE::ADMIN_TITLE?>"><?="{$u->info->nom} {$u->info->prenom}"?><?=$USER->hidden($NAV->isCollab()) ? " | {$u->info->role}" : ""?></h2>
  </section>
  <?php debug();?>
  <section class="container my-3">
    <div class="row">

      <!-- nav menu -->
      <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="<?=STYLE::MAIL_LINK_MENU?> active" id="my-account-tab" data-toggle="pill" href="#my-account" role="tab" aria-controls="my-account" aria-selected="true">Mon compte</a>
          <a class="<?=STYLE::MAIL_LINK_MENU?>" id="my-order-tab" data-toggle="pill" href="#my-order" role="tab" aria-controls="my-order" aria-selected="false">Mes commandes</a>
          <a class="<?=STYLE::MAIL_LINK_MENU?>" id="my-adress-tab" data-toggle="pill" href="#my-adress" role="tab" aria-controls="my-adress" aria-selected="false">Mes adresses</a>
          <a class="<?=STYLE::MAIL_LINK_MENU?>" id="my-mail-tab" data-toggle="pill" href="#my-mail" role="tab" aria-controls="my-mail" aria-selected="false" <?=$NAV->hidden(true)?>>Ma messagerie</a>
        </div>
      </div>
      <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <!-- mon compte -->
          <div class="tab-pane fade show active" id="my-account" role="tabpanel" aria-labelledby="my-account-tab">
            <div class="row row-cols-1">
              <div class="col">
                <div class="card alert alert-light rounded-0 shadow-sm" role="alert">
                  <div class="clearfix p-0 m-0">
                    <?="<p class='float-left small text-muted'>{$u->info->ref}</p>"?>
                    <?="<p class='float-right small text-muted'> Membre depuis le {$USER->DATE($u->info->created_at)}</p>"?>
                  </div>
                  <hr class="m-1 py-1">
                  <?="<h2 class='h1'>{$u->info->nom} {$u->info->prenom}</h2>"?>
                  <?="<p class='lead'>\" {$u->info->username} \"</p>"?>
                  <hr class="m-1">
                  <div class="text-right">
                    <?=!empty($u->order->total) ? "{$u->order->count} commande | {$ORDER->PRICE($u->order->total)->currency} dépensés" : "pas de commandes"?>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card alert alert-light rounded-0 shadow-sm">
                  <div class="p-1">
                    <?="<p class='lead'>{$u->info->mail}</p>"?>
                    <hr class="m-1">
                    <div class="text-right">
                      Changer de mot de passe <a class="small pl-2" data-toggle="modal" data-target="#changePassword"><?=ICON::EDIT?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- mes commandes -->
          <div class="tab-pane fade" id="my-order" role="tabpanel" aria-labelledby="my-order-tab">
          <div <?=$NAV->hidden(!empty($ordersList))?> >
          <h1 class="card-title text-center mt-4">Vous n'avez pas de commandes.</h1>
        </div>
            <div class="row row-cols-1" <?=$NAV->hidden(empty($ordersList))?>>
              <?php foreach ($ordersList as $order): $order = $ORDER->getOrder($order)?>
			                <div class="col">
			                  <div class="card alert alert-light rounded-0 shadow-sm">
			                    <div class="p-1">
			                      <div class="text-dark row">
			                        <div class="col py-2">Commande N° <?=$order->info->ref?></div>
			                        <div class="col text-right">
			                          <a class="<?=STYLE::BUTTON_ACTION?>" onclick="viewOrder(<?=$order->info->id?>)" title="Voir détails commande"><?=ICON::EYE?></a>
			                          <a class="<?=STYLE::BUTTON_ACTION?>" href="./facture?id=<?=$order->info->id?>" target="_blank" title="Imprimer facture" <?=$NAV->hidden(true)?>><?=ICON::INVOICE?></a>
			                          <a class="<?=STYLE::BUTTON_ACTION?>" onclick="trackOrder(<?=$order->info->id?>)" title="Suivre la commande" <?=$NAV->hidden(true)?>> <?=ICON::TRACK?></a>
			                          <a class="<?=STYLE::BUTTON_ACTION?>" onclick="cancelOrder(<?=$order->info->id?>)" title="Annuler la commande" <?=$NAV->hidden(in_array($order->info->status, [0, 1, 2]))?>><?=ICON::CROSS?></a>
			                        </div>
			                      </div>
			                      <div class="text-dark row">
			                        <div class="col"><small>Date de commande <?=$ORDER->DATE($order->info->created_at)?></small></div>
			                        <div class="col text-right"><?=$order->status->text?> <small><b><?=$ORDER->DATE($ORDER->dateStatus($order))?></b> </small></div>
			                      </div>
			                      <hr class="my-1 p-1">
			                      <div class="text-dark row">
			                        <div class="col">
			                          <?=$order->info->qty?> article | <?=$ORDER->PRICE($order->info->total)->currency?>
			                        </div>
			                      </div>
			                      <hr class="my-1 p-1">
			                      <div>
			                        <?=$ORDER->progress_bar($order->status)?>
			                      </div>
			                    </div>
			                  </div>
			                </div>

			                <?php include './src/modals/order_details_modal.php'?>
			                <?php include './src/modals/order_cancel_modal.php'?>
			              <?php endforeach;?>
            </div>
          </div>
          <!-- mes adresses -->
          <div class="tab-pane fade" id="my-adress" role="tabpanel" aria-labelledby="my-adress-tab">
        <div <?=$NAV->hidden(!empty($adressList))?> >
          <h1 class="card-title text-center mt-4">Vous n'avez pas d'adresse</h1>
        </div>
        <div <?=$NAV->hidden(empty($adressList))?> >
          <?php foreach ($adressList as $value): ?>
                <div class="col">
                  <div class="card alert alert-light rounded-0 shadow-sm">
                    <div class="text-dark row">
                      <div class="col">
                        <p class="h4 m-0 p-0"><b><?=$value->name?></b></p>
                      </div>
                      <div class="col text-right">
                        <a class="<?=STYLE::BUTTON_ACTION?>" onclick="editAdresse(<?=$value->id?>)" title="Modifié l'adresse"><?=ICON::EDIT?></a>
                        <a class="<?=STYLE::BUTTON_ACTION?>" onclick="deleteAdresse(<?=$value->id?>)" title="Supprimer l'adresse"><?=ICON::TRASH?></a>
                      </div>

                    </div>
                    <hr />
                    <div class="text-dark">
                      <p><?=$value->client?> <?=!empty($value->client) && !empty($value->society) ? "|" : ""?> <?=ucfirst($value->society)?></p>
                      <p class="m-0 p-0"><?=$value->adresse?></p>
                      <p class="m-0 p-0"><?=$value->complement?></p>
                      <p class="m-0 p-0"><?=$value->zip?> <?=$value->ville?></p>
                      <p class="m-0 p-0"><?=$value->pays?> <?=!empty($value->pays) && !empty($value->region) ? "|" : ""?> <?=$value->region?></p>
                      <p class="m-0 p-0"><?=$value->phone?></p>
                    </div>
                  </div>
                </div>
                <!-- edit adress modal -->
                <?php include './src/modals/adress_set_modal.php'?>
                <!-- delete adress modal -->
                <?php include './src/modals/adress_del_modal.php'?>

              <?php endforeach;?>
            </div>

          </div>
          <!-- mes messages -->
          <div class="tab-pane fade" id="my-mail" role="tabpanel" aria-labelledby="my-mail-tab">
            messages
          </div>
        </div>
      </div>
    </div>
  </section>






</main>
<?php unDebug()?>
<?php $script = './js/js-profile.js?vr=2'?>
<?php include_once './inc/footer.inc.php'?>