<html>
<head>
    <title>Apks de AuroraSuite</title>
    <meta name="viewport" content="width=device-width" />
    <style>
        table td{padding: 4px 20px}
    </style>
</head>

<body>
<h3>Descargar AuroraSuite</h3>
<table border="1">
<tr>
    <th>Nombre</th>
    <th>Versión</th>
    <th>Tamaño (bytes)</th>
</tr>
<?php
$jsonStr = str_replace("\r\n", "\n", file_get_contents("../../apps_manifest.json"));
$json = json_decode($jsonStr, TRUE);

//var_dump($json);

foreach($json["apps"] as $app){
    if ($app["appId"] == "com.ats.android.aurorasuite"){
        $asApp = $app;
        break;
    }
}

if (isset($asApp)){
    
    foreach($asApp["releases"] as $rel){
        $vCode = $rel["versionCode"];
        $vName = $rel["versionName"];
        $appUri = $rel["updateUri"];
        
        $name = basename($appUri);
        $appUri = rtrim(dirname(dirname(dirname($_SERVER['PHP_SELF']))), "/" ) . "/" . $appUri;
        $appPath = realpath($_SERVER['DOCUMENT_ROOT'] . $appUri);
        $size = filesize($appPath);
        
        print "<tr>";
        print "<td><a href=\"$appUri\">$name</a></td>";
        print "<td>$vName</td>";
        print "<td>$size</td>";
        print "</tr>";
    }
}

?>
</table>
</body>
</html>