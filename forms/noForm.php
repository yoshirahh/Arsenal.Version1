<div style="text-align:center">
<h3>There appears to be no available registration form...</h3>
<?php 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <errors@arsenalperformingarts.com>' . "\r\n";
mail("tech@arsenalperformingarts.org","Form Missing from Registration","There appears to be an open registration that does not have a form. I suggest you change that",$headers);
?>
</div>