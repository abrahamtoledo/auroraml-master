<?php
$scheme = $_SERVER['HTTPS'] ? "https" : "http";
$url = "$scheme://go.auroraml.com" . "/";
header("Location: ".  $url);
?>

<html>
<head>
	<title>Redirection</title>
</head>
<body>
	<p>The document has moved <a href="<?php print $url; ?>">here</a></p>
</body>
</html>