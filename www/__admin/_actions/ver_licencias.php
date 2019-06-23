<?php
$rows = DBHelper::Query(
<<<SQL
SELECT 
  fw_licencias.IMEI as imei,
  managers.user as manager,
  FROM_UNIXTIME(fw_licencias.fecha, "%Y-%m-%d") AS fecha
FROM 
  fw_licencias, managers
WHERE
  fw_licencias.managerId=managers.id
ORDER BY fw_licencias.fecha DESC
SQL
, $sqlErr);

if ($sqlErr)
    print $sqlErr . "\r\n";

$k = 1;

?><!DOCTYPE html>
<html>
 <head><title>Listado de Licencias del Firewall</title>
 <style type="text/css">
    body{color: #444}
 
    td, th { padding: 4px 20px; border: none; margin:0}
    th { background: lightblue; border-bottom: 1px solid #555; text-align: left; color: darkred}
    table {border: 1px solid #333}
    td, th {border-right: 1px solid #bbb;}
    td:first-child, th:first-child {border-right: 1px solid #555 !important;}
    td:last-child, th:last-child {border-right: none !important;}
    
    tr.even td {background: #eee}
 </style>
 </head>
 <body>
    <h4>Listado de Licencias Emitidas del Firewall :</h4>
    <table border="0" cellspacing="0" cellpadding="0">
       <tr>
        <th>#</th>
        <th>IMEI</th>
        <th>Manager</th>
        <th>Fecha de Emision</th>
       </tr>
    
     <?php foreach ($rows as $row) : ?>
       <tr class="<?php print $k % 2 == 0 ? "even" : "odd" ?>">
        <td><?php print $k++ ?>)</td>
        <td><?= $row['imei'] ?></td>
        <td><?= $row['manager'] ?></td>
        <td><?= $row['fecha'] ?></td>
       </tr>
     <?php endforeach; ?>
    </table><br />
 </body>
</html>