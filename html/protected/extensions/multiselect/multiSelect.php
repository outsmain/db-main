<?php
class multiSelect 
{
	public function __construct($params = array()){
		foreach($params as $p => $v) $this->$p = $v;
	}
	
	protected static function registerScript(){
		$asset = dirname(__FILE__).DIRECTORY_SEPARATOR;
		$baseUrl = Yii::app()->assetManager->publish($asset);

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($baseUrl.'/jquery.multiselect.min.js', CClientScript::POS_HEAD);
		$cs->registerScriptFile($baseUrl.'/jquery.multiselect.filter.min.js', CClientScript::POS_HEAD);
		$cs->registerCssFile($baseUrl.'/css/jquery.multiselect.css');
		$cs->registerCssFile($baseUrl.'/css/jquery.multiselect.filter.css');
	}

	protected static function create($selector, $options = array(), $position = CClientScript::POS_END){
		self::registerScript();
		$options = CJavaScript::encode(array_merge(self::defaultOptions(),$options));
		Yii::app()->clientScript->registerScript(__CLASS__.$selector, 'jQuery("'.$selector.'").multiselect('.$options.');', $position);
	}
	
	public function addMultiselect($selector, $ops = array()){
		self::create($selector, array_merge(self::defaultOptions(),$ops));
	}

	protected static function defaultOptions(){
		$configs = array(
			'multiple' => false,
			'selectedList' => 1,
			'minWidth' => 150,
			'height' => 'auto',
		);
		return $configs;
	}
}
?>