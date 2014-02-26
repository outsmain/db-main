<?php
/* @var $this ResetpassController */
/* @var $model UserLogin */

?>
<?php 
Yii::app()->user->logout();
  ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>