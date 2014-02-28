<?php
echo CHtml::activeTextField($this->model,$this->id,array('width'=>100,'maxlength'=>100,"placeholder"=>"DD/MM/YYYY HH:MM:SS","class"=>"timepicker","value"=>$this->model->{$this->name}?$this->model->{$this->name}:$this->options['value']));
?>