<?php
$page_name="Dashboard1";
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../header/header.php');
echo $content;
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../footer/footer.php');

?>
