
<?php
$page_name="User Mangement";
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../header/header.php');
echo $content;
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../footer/footer.php');

?>
