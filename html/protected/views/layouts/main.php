
<?php
$page_name="Dashboard1";
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../header/header.php');
echo $content;
if(isset(Yii::app()->session['user'])) include(dirname(__FILE__).'/../footer/footer.php');

?>

<?php
/*     $this->widget('ext.timeout-dialog.ETimeoutDialog', array(
        // Get timeout settings from session settings.
        'timeout' => Yii::app()->getSession()->getTimeout(),
        // Uncomment to test.
        // Dialog should appear 20 sec after page load.
        //'timeout' => 1,
        'keep_alive_url' => $this->createUrl('/site/keepalive'),
        'logout_redirect_url' => $this->createUrl('/site/logout'),
    )); */
?>