<?php

if(empty($_GET["mail"])) {
	$confirm = "rien";
} else {
	$to = "whoever@domain.tld";
	$subject ="Message test from me";
	$body = "test du soir";	
	$headers = "From: me@domain.tld \r\n";
	$headers.= "Reply-To: me@domain.tld \r\n";
	mail($to, $subject, $body, $headers);
	$confirm = "envoyé ".time();
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
	<?=$confirm;?>
</body>
</html>