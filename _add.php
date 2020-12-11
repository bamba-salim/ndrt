<?php
require './config/config.php';
// isset($_SESSION['user']) ? var_dump($_SESSION['user']) : "";
extract($_POST);

$errors = [];
if (isset($_GET['action'])):
    switch ($_GET['action']):
    case 'prod': // ajouter de produit -> todo
        $name = $FORM->newInput($name, REGEX::W_N) ? $errors['name'] = 'Libellé invalide' : $name;
        $price = $FORM->newInput($price, REGEX::PRICE) ? $errors['price'] = 'Prix invalide' : $price;
        $color = $FORM->newInput($color, REGEX::W_N) ? $errors['color'] = 'Couleur invalide' : $color;
        $qty = $FORM->newInput($qty, REGEX::NUMBER) ? $errors['qty'] = 'Quantité invalide' : $qty;
        $col = $FORM->newInput($col, REGEX::NUMBER) || $col == 0 ? $errors['col'] = 'Collection invalide' : $col;
        $cat = $FORM->newInput($cat, REGEX::NUMBER) || $cat == 0 ? $errors['cat'] = 'Catégorie invalide' : $cat;
        $alt = $FORM->newInput($alt, REGEX::NUMBER) || $alt == 0 ? $errors['alt'] = 'Sous-catégorie invalide' : $alt;
        $description = $FORM->newInput($description, REGEX::TEXT) ? $errors['description'] = 'Desciption invalide' : $description;
        $composition = $FORM->newInput($composition, REGEX::TEXT) ? $errors['composition'] = 'Composition invalide' : $description;
        if (!empty($errors)):
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $_POST;
            header('location: ./admin?root=productadd');
        else:
            // $c = DB()->fetch(CATEGORY::SELECT . ' where c.id IN (:cat,:col)', array(':cat' => $cat, ':col' => $col)); TODO
            $ref = $PRODUCT->generateRef();
            DB()->query2(
                'INSERT INTO product (name, price, img, color, cat, alt, col, ref, descr, compo, qty)
						          VALUES (:name,:price,:img,:color,:cat,:alt,:col,:ref,:descr,:compo,:qty)',
                array(
                    ':name' => $name, ':price' => $price, ':img' => $img, ':color' => $color, ':cat' => $cat, ':alt' => $alt, ':col' => $col, ':ref' => $ref, ':descr' => $description, ':compo' => $composition, ':qty' => $qty,
                )
            );
            header('location: ./admin?root=productadd');
        endif;
        break;
    case 'category': // create category

        //TODO: regex en javascript

        $category['name'] = $name;
        $category['detail'] = $detail;
        $category['type'] = $type;
        $category['image'] = $image;

        $CATEGORY->createCategory($category);
        header('location: ./admin?ad=category');

        break;

    case 'order': //creat order

        extract($_SESSION);

        $date = new DateTime();
        $order = new stdClass();

        $order->products = $cart;
        $order->livraison = $livraison;
        $order->facturation = $facturation;
        $order->user = $user->id;
        $order->remise = $NAV->isCollab() ? USER::REMISE : null;
        $order->qty = $CART->countQTY();
        $order->total = $CART->newTotal()->price;

        $ORDER->creatOrder($order);

        unset($_SESSION['cart']);
        header('location: ./profile');
        exit();
        break;
    case 'user': // create user -> done

        $USER = new USER();
        $FORM = new FORM();

        $user = new stdClass();
        $user->role = $role;
        $user->username = $username;
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->mail = $mail;
        $user->ref = $USER->generateRef();
        $user->password = $FORM->creatPassword($password);

        $USER->creatUser($user);

        $_SESSION['user'] = $USER->logUser($USER->getUser($user->ref)->info);
        header("location: ./profile");
        break;
    case 'cart': // add to cart

        if (!isset($_GET['ref'])):
            $NAV->goBack();
        else:
            $product['test'] = $_GET['ref'];
            $product['ref'] = $_GET['ref'];
            $product['qty'] = $qty;
            $product['object'] = $PRODUCT->getProduct2($product);
            if (!empty($product['object'])) {
                    $CART->add($product);
                    header('location: ./cart');
            } else {
                $NAV->goBack();
            }
        endif;
        break;
    case 'mail': //create mail
        //todo
        $name = $FORM->newInput($name, REGEX::WORDS) ? $errors['name'] = 'Nom invalide' : $name;
        $sujet = $FORM->newInput($sujet, REGEX::TEXT) ? $errors['sujet'] = 'Sujet invalide' : $sujet;
        $mail = $FORM->newInput($mail, REGEX::MAIL) ? $errors['contactMail'] = 'Mail invalide' : $mail;
        $message = $FORM->newInput($message, REGEX::TEXT) ? $errors['mail'] = 'Veullez entre votre message' : $message;
        if (!empty($errors)):
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $$_POST;
            // header('location: ./contact');
        else:
            echo "c'est bon";
            $ref = $MAIL->generateRef();
            $_SESSION['success'] = "Le message est envoyé avec succes <br> Voici votre réference de demande: {$ref}";
            DB()->query2(
                'INSERT INTO mail (name,msg,sujet,mail,ref) VALUES (:name,:msg,:sujet,:mail,:ref)',
                array(':name' => $name, ':msg' => $message, ':sujet' => $sujet, ':mail' => $mail, ':ref' => $ref)
            );
            // header('location: ./contact');
        endif;
        break;
    case 'adress': // add adresse

        //todo
        $libelle = $FORM->newInput($libelle, REGEX::W_N) ? $errors['libelle'] = "Libellé d'adress invalide" : $libelle;
        $type = $FORM->newInput($type, REGEX::NUMBER) ? $errors['type'] = "Type d'adresse invalide" & $type = "" : $type;
        if (!empty($contact) && !empty($society)) {
            $contact = $FORM->newInput($contact, REGEX::WORDS) ? $errors['contact'] = "Nom de contact invalide" : $contact;
            $society = $FORM->newInput($society, REGEX::W_N) ? $errors['society'] = "Societé invalide" : strtoupper($society);
        } elseif (!empty($contact) && empty($society)) {
        $contact = $FORM->newInput($contact, REGEX::WORDS) ? $errors['contact'] = "Nom de contact invalide" : $contact;
    } elseif (!empty($society) && empty($contact)) {
        $society = $FORM->newInput($society, REGEX::W_N) ? $errors['society'] = "Societé invalide" : strtoupper($society);
    }
    $adress['phone'] = $FORM->newInput($phone, REGEX::PHONE) ? $errors['phone'] = "Téléphone invalide" : $phone;
    $adress[''] = $FORM->newInput($adress, REGEX::W_N) ? $errors['adress'] = "Adresse invalide" : $adress;
    $complement = $FORM->inputNotReq($complement, REGEX::W_N) ? $errors['complement'] = "Complément d'adresse invalide" : $complement;
    $zip = $FORM->newInput($zip, REGEX::ZIP) ? $errors['zip'] = "Code postale invalide" : $zip;
    $city = $FORM->newInput($city, REGEX::W_N) ? $errors['city'] = "Ville invalide" : $city;
    $region = $FORM->inputNotReq($region, REGEX::W_N) ? $errors['region'] = "Région invalide" : $region;
    $country = $FORM->newInput($country, REGEX::NUMBER) ? $errors['country'] = "Pays invalide" : $country;
    if (!empty($errors)):
        $_SESSION['errors'] = $errors;
        $_SESSION['inputs'] = $_POST;
        $NAV->goBack();
    else:
        var_dump("tout est ok");

        // $ADRESSE->createAdress();
        //DB()->query(ADRESSE::ADD_TO_USER, array(':libelle' => $libelle, ':uref' => $_SESSION['user']['ref'], ':aref' => $ref));
        //DB()->query(ADRESSE::CREATE, array(':ref' => $ref, ":type" => $type, ':contact' => $contact, ':society' => $society, ':adresse' => $adress, ':complement' => $complement, ':zip' => $zip, ':city' => $city, ':region' => $region, ':country' => $country, ':phone' => $phone));
        $NAV->goBack();
    endif;
    break;
case 'img':
    var_dump($_FILES['upFile']);
    $img = $FORM->getImgPath($_POST['submit'], IMG::FOLDER['category'], 'upFile', $_SESSION['objectRef']);
    var_dump($_SESSION['success']);

    // $NAV->goBack();

    endswitch;
    endif;
