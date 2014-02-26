<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="description" content="jformvalidate is an extension for Yii to easely allow javascript form validation">
    <meta name="keywords" content="yii extension form validation javascript ">
    <meta name="author" content="Raoul">
    <meta name="Charset" content="UTF-8">
    <meta name="Rating" content="General">
    <meta name="Revisit-after" content="31 Days">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<style type="text/css">
		body
		{
			background: #fff;
		}
	#header
	{
		text-align:right;
		border-top: 0px;
	}	
		#page
		{
		
			border: 0px solid #C9E0ED;
		}
		
		#footer{
			padding: 0px;
			margin: 0px;
			font-size: 0.8em;
			text-align: center;
			margin-top:2em;
			padding-top:2em;
			border-top: 1px solid #C9E0ED;
		}
		.leftMenu {
			padding-top:2em;
		}
		.leftMenu .active {
			text-decoration:none;
			font-weight: bold;
		}
		div.form
		{
		border: 2px solid #B7DDF2;
		background: #EBF4FB;
		margin: 0;
		padding: 5px;
	
		}	
		div.form pre {
			background-color:#ddd;
			padding:1em;
		}
	
		span.invalid {
			color:red;
			padding-left:1em;
		}
		div.content {
			padding-top:1em;
		}
		div.list label{
			display:inline;
			height:0.9em;
		}	
		div.list input{
			height:0.9em;
			padding-left:50px;
		}		
	</style>	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
	<hr/>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Demo', 'url'=>array('/jsvform/index')),
				array('label'=>'Download', 'url'=>array('/site/download')),
			),
		)); ?>
	</div><!-- mainmenu -->
	
	
	<div class="leftMenu span-6">
		<h3>Form Sample</h3>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Login Form', 'url'=>array('jsvform/TestForm','id'=>1)),
				array('label'=>'Inline Error Message', 'url'=>array('jsvform/TestForm','id'=>2)),
				array('label'=>'Checkbox', 'url'=>array('jsvform/TestForm','id'=>3)),
				array('label'=>'List Elements', 'url'=>array('jsvform/TestForm','id'=>4)),
				array('label'=>'Another Select box', 'url'=>array('jsvform/TestForm','id'=>5)),
				array('label'=>'Multi-form', 'url'=>array('jsvform/TestForm','id'=>6)),
				array('label'=>'Ajax Validation', 'url'=>array('jsvform/TestForm','id'=>7)),
				array('label'=>'Compare Validator', 'url'=>array('jsvform/TestForm','id'=>8)),
				array('label'=>'Numerical Validator', 'url'=>array('jsvform/TestForm','id'=>9)),
				array('label'=>'Optional Fields', 'url'=>array('jsvform/TestForm','id'=>10)),
				array('label'=>'Custom Validator', 'url'=>array('jsvform/TestForm','id'=>12)),
				array('label'=>'Ajax Submit', 'url'=>array('jsvform/TestForm','id'=>13)),
				array('label'=>'Ajax Submit (reloaded)', 'url'=>array('jsvform/TestForm','id'=>14)),
				array('label'=>'Match Validator', 'url'=>array('jsvform/TestForm','id'=>15)),
				array('label'=>'Custom Submit Handler', 'url'=>array('jsvform/TestForm','id'=>17)),
				array('label'=>'Required Validator', 'url'=>array('jsvform/TestForm','id'=>19)),
				
			),
		)); ?>
	</div>
	
	
	
	<div class="span-18 last">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>

	<div id="footer" class="span-24 last">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>