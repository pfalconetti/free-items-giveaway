// ********** **********

// Contrôle pour activer/désactiver toutes les textboxes
function checkUncheckAll(formulaire,controleur,element){
	var chk=eval("document."+formulaire+"."+element);
	var ctr=eval("document."+formulaire+"."+controleur);
	if(ctr.checked==true){for(i=0;i<chk.length;i++) chk[i].checked=true;}
    else{for(i=0;i<chk.length;i++) chk[i].checked=false;}
}

// Rechargement d'un nouveau CAPTCHA
function refreshCaptcha() {
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}

// Mise à jour de certaines informations de session
function majs(nouveau) {
	alert("nouveau:"+nouveau);
}
