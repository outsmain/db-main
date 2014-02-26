<!doctype html>  

<?php 
Yii::app()->user->logout();
  ?>

<html lang="en-us">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8">
	<title>Muse Admin Panel | Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

	<!-- The Columnal Grid and mobile stylesheet -->
	<link rel="stylesheet" href="assets/styles/columnal/columnal.css" type="text/css" media="screen" />

	<!-- Fixes for IE -->
	<!--[if lt IE 9]>
            <link rel="stylesheet" href="assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->

	<!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="assets/styles/global.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="assets/styles/config.css" type="text/css" media="screen" />
        
</head>
<body id="login">
<!--<div class="form">-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'action'=>'index.php?r=site/login',
)); ?>
    <div class="container">
        <div class="row">
            
            <a href="index.php" class="center block"><img src="assets/images/logo.png" /></a>
            
            <div class="col_6 pre_3 padding_top_60">
                <div class="widget clearfix">
                    <h2>Login</h2>
                    <div class="widget_inside">
                        <p class="margin_bottom_15">No need to enter any username or password for this demo.</p>
                        <div class="form">
                            <div class="clearfix">
                                <label>Username</label>
                                <div class="input">
                                <!--    <input type="text" class="xlarge"/> -->
								<?php echo $form->textField($model,'username'); ?>
								<?php echo $form->error($model,'username'); ?>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label>Password</label>
                                <div class="input">
                                  <!--  <input type="password" class="xlarge"/> -->
								  <?php echo $form->passwordField($model,'password'); ?>
								  <?php echo $form->error($model,'password'); ?>
                                </div>
                            </div>
                            <div class="clearfix">
							<div class="input" style="padding-left:90px;">
                            <?php echo $form->checkBox($model,'rememberMe'). "  Remember me "; ?>
                          
						   
						  <?php echo "<a href=index.php?r=resetpass/repass>  forgot your password</a>"; ?> 
						  </div>
							<?php echo $form->error($model,'rememberMe'); ?>
							
							
							</div>
							 <div class="clearfix">
							 <div class="input" style="padding-left:120px;">
                            
							</div>
							</div>
                            <div class="clearfix grey-highlight">
                                <div class="input no-label ">
                                  <!--  <a href="index.php" class="button blue"><span>Login</span></a> -->
								  <?php echo CHtml::submitButton('Login'); ?>
                                    <a href="index.php" class="button"><span>Reset</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->endWidget(); ?>
	</div>
	
</body>
</html>