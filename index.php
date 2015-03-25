<?php

	// "Liste et réservations"
	// par Pierre Falconetti
	// v0.1 janvier 2015

    require_once('./libs/class.db.php');
    require_once('./libs/class.liste.php');
    require_once('./libs/class.resa.php');
    $db = new DB;
    $liste = new LISTE($db);
    $resa  = new RESA($db);
    require_once('./libs/functions.php');

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="pragma" content="no-cache" />
    <title>don de livres</title>
   	<link rel="stylesheet" type="text/css" href="./styles/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="./styles/lightbox.css" />
   	<link rel="stylesheet" type="text/css" href="./styles/custom.css" />
	<script type="text/javascript" language="javascript" src="./libs/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="./libs/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="./libs/lightbox.min.js"></script>
    <script type="text/javascript" language="javascript" src="./libs/gen_validatorv31.js"></script>
	<script type="text/javascript" language="javascript" src="./libs/functions.js"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $('#maliste').DataTable({
                "bPaginate": false,
                "columnDefs": [{
                    orderable: false,
                    targets: [0,2,3]
                }],
                "dom": '<"DTcontainer"ilftp>',
                "oLanguage": {
                    "sSearch":         "rechercher",
                    "sInfo":           "_END_ résultats",
                    "sInfoFiltered":   "(sur un total de _MAX_)",
                    "sZeroRecords":    "aucun résultat",
                    "sEmptyTable":     "liste vide"
                },
                "order": [[1,"asc"]]
            });
        } );
    </script>
</head>

<body>
    <div class="humanmessage">
        <div class="bulle"></div>
        <span class="error"><?=$errors;?></span>
    	<?=$texte;?>
    </div>
	<p><center><h1>Je donne mes livres</h1></center></p>
    <form method="POST" name="select_form" action="<?=htmlentities($_SERVER['PHP_SELF']);?>">
    	<fieldset>
            <input name="record_id" type="hidden" value="<?=myUniqId();?>" />
            <center><h2>1. Cochez les livres qui vous intéressent</h2></center>
            <table id="maliste">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="checkControler" value="yes" onClick="checkUncheckAll('listeSelect', 'checkControler', 'choix')"></th><!-- non sortable -->
                        <th>titre</th>
                        <th>complément</th><!-- non sortable -->
                        <th>couv</th><!-- non sortable -->
                        <th>domaine</th>
                        <th>langue</th>
                        <th>auteur</th>
                        <th>éditeur</th>
                        <th>année</th>
                        <th>support</th>
                        <th>hauteur (cm)</th>
                        <th>largeur (cm)</th>
                        <th>épaisseur (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $maListe = $liste->getItemsAll();
                        foreach($maListe as $livre) {
                            switch ($livre->dispo) {
                                case "réservé":
                                    $dispo = "reserv";
                                    break;
                                case "donné":
                                    $dispo = "don";
                                    break;
                                default:
                                    $dispo = "dispo";
                            }
                            if($dispo!="don") { ?>
                                <tr title="<?=$livre->dispo;?>" class="<?=$dispo;?>">
                                    <td class="center">
                                        <input type="checkbox" id="choix" name="items[]" value="<?=$livre->id;?>" />
                                    </td>
                                    <td><?=$livre->titre;?></td>
                                    <td><?=$livre->complement;?></td>
                                    <td class="center">
                                        <a href="./data/<?=$livre->couverture;?>.jpg" data-lightbox="couverture" data-title="<?=$livre->titre;?>">
                                            <img src="./data/<?=$livre->couverture;?>.jpg" height="30px" width="30px" />
                                        </a>
                                    </td>
                                    <td><?=$livre->domaine;?></td>
                                    <td class="center"><?=$livre->langue;?></td>
                                    <td><?=$livre->auteur;?></td>
                                    <td><?=$livre->editeur;?></td>
                                    <td class="center"><?=$livre->annee;?></td>
                                    <td class="center"><?=$livre->support;?></td>
                                    <td class="right"><?=$livre->hauteur;?></td>
                                    <td class="right"><?=$livre->largeur;?></td>
                                    <td class="right"><?=$livre->epaisseur;?></td>
                                </tr>
                    <?php } } ?>
                </tbody>
            </table>
            
            <!-- Formulaire de commande et contact : public -->
            <div class="humanform">
                <table class="formulaire">
                    <thead>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="2"><center><input type="submit" name="submit" value="Valider le formulaire" /></center></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="humanmessage">
                                    <div class="bulle"></div>
                                        Si des livres vous intéressent, veuillez les cocher dans la liste ci-dessus.<br/><br/>
                                        Ensuite, merci de remplir la fiche ci-dessous.<br/>
                                        Cela me permettra de vous envoyer un mail avec l'adresse exacte et de vous prévenir quand votre commande sera prête.<br/>
                                        Vos informations ne seront ni stockées, ni transmises à des tiers, ni utilisées à des fins commerciales.
                                </div>
                                <center><h2>2. Remplissez et validez ce formulaire</h2></center>
                            </td>
                        </tr>
                        <tr>
                            <td class="right">Votre nom<br/>(facultatif)</td>
                            <td><input type="text" name="user_name" value='<?=htmlentities($user_name);?>' title="nom" /></td>
                        </tr>
                        <tr>
                            <td class="right">Votre adresse e-mail<br/>(nécessaire pour vous contacter)</td>
                            <td><input type="text" name="user_email" value='<?=htmlentities($user_email);?>' title="email" class="mandatory" /></td>
                        </tr>
                        <tr>
                            <td class="right">Votre message<br/>(facultatif)</td>
                            <td><textarea name="user_message" title="message"><?=htmlentities($user_message);?></textarea></td>
                        </tr>
                        <tr>
                            <td class="right">CAPTCHA<br/><a href='javascript: refreshCaptcha();'>recharger un nouveau</a></td>
                            <td><img src="./libs/captcha_code_file.php?rand=<?=rand();?>" id="captchaimg" /></td>
                        </tr>
                        <tr>
                            <td class="right">Recopiez le CAPTCHA ci-dessus<br/>(nécessaire pour valider)</td>
                            <td><input type="text" id="6_letters_code" name="6_letters_code" title="Captcha" class="mandatory" /></td>
                        </tr>
                    </tbody>
                </table>
                <script src="./libs/modernizr.custom.js"></script>
                <script>
                    var frmvalidator = new Validator("select_form");
                    frmvalidator.addValidation("user_email","req","Merci de saisir une adresse e-mail."); 
                    frmvalidator.addValidation("user_email","email","Veuillez saisir une adresse e-mail valide."); 
                    frmvalidator.addValidation("6_letters_code","req","Merci de saisir le CAPTCHA."); 
                </script>
            </div>

		</fieldset>
    </form>
</body>

</html>