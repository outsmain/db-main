<?php  
$connection = Yii::app()->db;
$user = Yii::app()->session['user'];
$user_id =Func::to_edit($user);
//$user_id = Yii::app()->session['user_id'];
Yii::import('application.components.UserIdentity');
$user_id_en = base64_encode($user_id);

?>


<html lang="en-us">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

        <title>IPNTM Admin Panel</title>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

	<!-- The Columnal Grid and mobile stylesheet -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/columnal/columnal.css" type="text/css" media="screen" />
	

	<!-- Fixes for IE -->
        
	<!--[if lt IE 9]>
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->        
        
	
	<!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/config.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/jquery.multiselect.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/styles/jquery.multiselect.filter.css" type="text/css" media="screen" />

        <!-- Use CDN on production server -->
       <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->

		<script type="text/javascript">
			 if(typeof jQuery == 'undefined') { 
				var url = '<?=Yii::app()->request->baseUrl?>';	
				document.write('<script src="'+url+'/js/jquery.min.js">\x3C/script>');	
				document.write('<script src="'+url+'/assets/scripts/jquery-ui.min.js">\x3C/script>');
			}else{
				if(typeof jQuery.ui == 'undefined'){ 
					var url = '<?=Yii::app()->request->baseUrl?>';	
					document.write('<script src="'+url+'/assets/scripts/jquery-ui.min.js">\x3C/script>');	
				}
			}
		</script>
        
        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
       <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>
		
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/jquery.multiselect.filter.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/jquery.multiselect.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/flot/jquery.flot.stack.min.js"></script>
        
        <!-- Menu -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/superfish/superfish.js"></script>
		

        <!-- Js used in the theme -->
       <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/muse.js"></script>

</head>
<body>
<?php  ?>
<div id="wrap">
	<div id="main">
            <header class="container">
                <div class="row clearfix">
                    <div class="left">
                        <a href="index.html" id="logo">Muse</a>
                    </div>

                    
                    <div class="right">
                        
                        <ul id="toolbar">
                            <li><span>Logged in as</span> <a class="user" href="#"><?php echo $user ?></a> <a id="loginarrow" href="#"></a></li>
							
                            <li><a id="messages" href="#">Messages</a></li>
                            <li><a id="settings" href="#">Settings</a></li>
	
                            <li><a id="search" href="#">Search</a></li>
                        </ul>

                        <div id="logindrop">
                            <ul>
                                <li id="editprofile"><a href="index.php?r=userLogin/update&id=<?php echo $user_id_en; ?>">Edit Profile</a></li>
                                <li id="logoutprofile"><a href="index.php?r=site/logout">Logout</a></li>
                            </ul>

                        </div>
                        <div id="searchdrop">
                            <input type="text" id="searchbox" placeholder="Search...">
                        </div>
                        
                    </div>  
                </div>
            </header>
           
            <nav class="container">
                <!-- <select class="mobile-only row" onchange="window.open(this.options[this.selectedIndex].value,'_top')">

                    <option value="index.html">Dashboard</option>
                </select>
				-->
				<?php
				// call function show menu
				Func::display_menus($user);
				
				?>
				
				
            </nav>

<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <h1><?php echo $page_name ?></h1>
            </div>
        </div>
    </div>
</div>
