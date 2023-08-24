<?php 
$avg_per=strip_tags($_GET["avg_per"]);

?>
<link rel="stylesheet" type="text/css" href="../plugins/progressbar_style/style.css">
<div align="center">

<div class="progress1 test" data-width="<?=number_format($avg_per)?>%" align="left">
<div class="progress1-text" ><?=number_format($avg_per)?>%</div>
<div class="progress1-bar" style="width:<?=number_format($avg_per,2)?>%;"  >
<div class="progress1-text"><?=number_format($avg_per)?>%</div>
</div>
</div>

</div>
