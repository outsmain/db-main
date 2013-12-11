<?php
/* @var $this ResetpassController */
/* @var $model UserLogin */
/* @var $form CActiveForm */
?>
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

    <div class="container">
       
            
            <a href="index.php" class="center block"><img src="assets/images/logo.png" /></a>
            
            <div class="col_6 pre_3 padding_top_60">
                <div class="widget clearfix">
                    <h2>Sended Mail</h2>
                    <div class="widget_inside">
                        <p class="margin_bottom_15">Your password be reset please login again</p>
                        

								<div class="clearfix">
								<label>thank you!</label>
                                <div class="input">
                                  <!--  <input type="password" class="xlarge"/> -->
								  
                                </div>
								<div class="clearfix">
								  <div class="input">
	<?php echo "<center>".CHtml::button('go to login', array('onclick' => 'js:document.location.href="index.php"'));?>
								</div>
								</div>
								</div>


	

			</div>
			</div>
					   </div>
							</div>
						</div>
					</div>
				</div>
			


</div>
<!-- form -->