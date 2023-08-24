<html>
<head>
  <meta charset="utf-8">
  <title>QR-CODE</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<body onLoad="window.print()">

<?php

 
  $fileQrcode=isset($_GET['fileQrcode']) ? $_GET['fileQrcode'] : NULL; 
  $fileName = isset($_GET['fileName']) ? $_GET['fileName'] : NULL; 
  $linkUrl = isset($_GET['linkUrl']) ? $_GET['linkUrl'] : NULL; 
 $linkUrl1=base64_decode($linkUrl);
    $path="../temp";

    $filename = $path .'/'.$fileQrcode;
    echo "<center>";
    echo  "<h1>$fileName</h1><br>";
    echo  "<h4>$linkUrl1 </h4><br>";
    echo "<br>";
    echo "<img src='$filename' style='width:500px; height:500px'/>";
    // echo "<br>"."$linkUrl";
    echo "</center>";
   
?>




</body>

</head>
</html>