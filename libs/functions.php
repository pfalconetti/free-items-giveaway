<?php


// *************** VARIABLES ***************

$errors = "";
$texte = "";
$user_email = "";
$user_message = "";
$user_name = "";

$txtAccueil = 'Salut.<br/><p>';
$txtAccueil.= '<span style="text-decoration:underline;">Je donne les livres ci-dessous.</span><br/>';
$txtAccueil.= "Ils ne sont pas très récents, mais ils contiennent encore des informations utiles (comme les bases et les <em>best practices</em>) sur leurs domaines respectifs, et dans l'ensemble ils sont encore en bon état. ";
$txtAccueil.= "Ils m'ont bien servi dans mon activité, mais aujourd'hui je n'en ai plus l'utilité. ";
$txtAccueil.= "Ils n'ont (pratiquement) plus de valeur marchande, mais plutôt que de les jeter, je préfère vous en faire profiter.<br/>";
$txtAccueil.= "Le seul impératif c'est de venir les chercher à Montreuil-sous-Bois, quartier la Boissière.<br/><ol>";
$txtAccueil.= "<li>Cochez les livres qui vous intéressent. ";
$txtAccueil.= "Si un livre vous intéresse mais qu'il est déjà réservé (ligne orangée), vous pouvez le réserver aussi : ";
$txtAccueil.= "il sera à vous si la personne avant vous se désiste</li>";
$txtAccueil.= "<li>Remplissez et envoyez le formulaire sous la liste</li>";
$txtAccueil.= "<li>Je vous recontacte ensuite pour vous donner l'adresse exacte et vous dire à partir de quand vous pouvez passer</li>";
$txtAccueil.= "<li>Récupérez vos livres à Montreuil.</li></ol>";
$txtAccueil.= "C'est complètement gratuit, mais si vous voulez donner un Euro ou deux, des cookies maison, ou juste un sourire, ce n'est pas interdit ;-)<br/><br/>";
$txtAccueil.= "Pierre</p>PS : Ce n'est ni une blague, ni une arnaque. Ce sont juste des bouquins. S'ils vous intéressent, ils sont à vous.";


// *************** VERIFICATIONS ***************

// Vérifications à la validation du formulaire
session_start();
if(!isset($_POST['submit'])) { // Cas par défaut
    $texte.= $txtAccueil;
} else { // Cas où quelqu'un a cliqué sur le bouton submit : vérifications + ajouts à la bdd + envoi de mails
    $user_name = (!empty($_POST['user_name'])) ? htmlentities($_POST['user_name']) : "" ;
    $items = (!empty($_POST['items'])) ? $_POST['items'] : "";
    $user_email = $_POST['user_email'];
    // Validation de l'e-mail
    if(empty($user_email) || IsInjected($user_email)) { // Cas d'adresse e-mail invalide
        $errors.= "E-mail invalide. Veuillez ré-essayer.<br/>";
    } else {
        // Validation du CAPTCHA
        if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0) { // Cas du CAPTCHA invalide
            $errors.= "Le code CAPTCHA ne correspond pas.<br/>Refaites votre sélection et ré-essayez.<br/>";
        } else {
            // Enregistrement de la réservation et message de confirmation
            // Si on a un message vide et une réservation vide, je considère que le formulaire n'est pas valide
            if(empty($_POST['items']) && empty($_POST['user_message'])) { // Cas si la liste est vide et que le message est vide
                $errors.= "Votre demande ne sera pas prise en compte car elle ne contient ni réservation, ni message.<br/>";
            } else { // Vérification de la réservation : cas où on a soit une liste, soit un messsage, soit les deux
                // Enregistrer la validation de formulaire
                $resa->logResa($_POST['record_id'],$_POST['user_name'],$_POST['user_email'],$items,$_POST['user_message']);
                // Afficher la référence
                $texte.= "Votre demande a été enregistrée sous la référence : <strong>".$_POST['record_id']."</strong><br/>";
                if(empty($errors) && !empty($_POST['items'])) { // Actions à effectuer spécifiquement si on aune réservation
                    // Flagger les items comme réservés
                    $liste->itemsBooking($_POST['items']);
                    // Construction du résumé sous forme d'une liste human-friendly
                    // Pour l'affichage : $itemsList
                    // Pour le mail : $mailItemList
					$maListe = $liste->getItemsAll();
                    $itemsList = "Articles réservés :<ol>";
                    $mailItemList = "Sélection :\n";
                    foreach($_POST['items'] as $check) {
                        $id = $check - 1;// FIXME: pas sûr!
                        $livre = $maListe[$id];
                        $itemsList.= '<li>"'.$livre->titre.', '.$livre->complement.'", chez '.$livre->editeur.'</li>';
                        $mailItemList.= '- "'.$livre->titre.', '.$livre->complement.'", chez '.$livre->editeur." \n";
                    }
                    $itemsList.= '</ol>';
                    $texte.= $itemsList;
                    // Envoi des e-mails
                    // Le 1er est pour l'user
                    // Le 2ème est pour le webmaster
                    $to = $_POST['user_email'];
                    $subject = "Formulaire validé sur www.long2.net/livres - ref ".$_POST['record_id'];
                    $body = "Hello,\n";
                    $body.= "Un formulaire a été validé sur le site www.long2.net/livres.\n";
                    $body.= "Référence : ".$_POST['record_id']."\n";
                    $body.= $mailItemList;
                    $body.= "E-mail : ".$_POST['user_email']."\n";
                    $body.= "Nom : ".htmlentities($_POST['user_name'])."\n";
                    $body.= "Message : ".htmlentities($_POST['user_message'])."\n";
                    $headers = "From: ".$to." \r\n";
                    $headers.= "Reply-To: ".$to." \r\n";
                    mail($to,$subject,$body,$headers);
                    $to = "pierre.falconetti@long2.net";
                    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
                    $body.= "IP : ".$ip;
                    mail($to,$subject,$body,$headers);
                    $texte.= "Un e-mail de confirmation va vous être envoyé.<br/>";
                    $texte.= "<h2>3. Je vous recontacte très vite</h2>Merci.";
                    // Rechargement de la page
                    //$params.= "index.php?sent=1&ref=".$_POST['record_id'];
                    //header('Location: ./'.$params);
                }
            }
        }
    }
}


// *************** FONCTIONS ***************

// Générateur d'ID alphanumérique unique
// Basé sur microtime()
// Retourne une chaîne hexadécimale de longueur variable, avec les lettres en majuscules
function myUniqId() {
    $shortTime = ceil(microtime(true)) - 45*365.25*24*3600;
    return strtoupper(dechex($shortTime));
}

// Fonction de validation contre les injections e-mail
function IsInjected($str) {
	$injections = array('(\n+)',
						'(\r+)',
						'(\t+)',
						'(%0A+)',
						'(%0D+)',
						'(%08+)',
						'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	return (preg_match($inject,$str)) ? true : false ;
}


?>