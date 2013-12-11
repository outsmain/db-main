<?php
/* @var $this ResetpassController */
/* @var $model UserLogin */

?>
<?php 
Yii::app()->user->logout();
  ?>
<?php $this->renderPartial('_Form2', array('model'=>$model)); ?>