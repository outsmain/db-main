<h1>Compare validator</h1>
<div class="form">
<p>Password must be entered twice, and username must be equal to <strong>yii</strong>. Note the nice JS effect when error fields are highlighted.</p>
<?php	
	echo EHtml::beginForm(); 
	EHtml::setOptions(array(
		'errorContainer'		=> 'div.errorSummary',
		'wrapper' 				=> 'li',
		'errorLabelContainer' 	=> 'div.errorSummary ul',
		'errorClass' 			=> 'invalid',
		'onkeyup' 				=> false,
		'onfocusout' 			=> false,
		'highlight' 			=> '
				function(element,errorClass){
			     $(element).fadeOut(function() {			      
			       		$(element).addClass("invalid");
			       		$(element).fadeIn()
			     })
				}',
		'unhighlight' 			=> '
				function(element,errorClass){
			     $(element).fadeOut(function() {			      
			       		$(element).removeClass("invalid");
			       		$(element).fadeIn()
			     })
				}'
	));
?>
	<pre>submitted data : <?php if($postedData != null) echo CVarDumper::dumpAsString($postedData); ?></pre>
	<?php echo EHtml::errorSummary($model); ?>
	<div class="errorSummary" style="display:none">
		<p>Please fix the following input errors:</p>
		<ul/>
	</div>

	<div class="row">
		<?php echo EHtml::activeLabelEx($model,'PASSWORD'); ?>
		<?php echo EHtml::activePasswordField($model,'PASSWORD') ?>
	</div>
	<div class="row">
		<?php echo EHtml::activeLabelEx($model,'PASSWORD'); ?>
		<?php echo EHtml::activePasswordField($model,'PASSWORD') ?>
	</div>
	<div class="row button">
		<?php echo EHtml::submitButton('Submit'); ?>
	</div>
	
	<?php echo EHtml::endForm(); ?>

</div><!-- yiiForm -->
