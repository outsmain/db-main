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
        
		<!-- Use CDN on production server -->
		<script type="text/javascript">
			if(typeof jQuery == 'undefined'){
				var url = '<?=Yii::app()->request->baseUrl?>';	
				document.write('<script src="'+url+'/assets/scripts/jquery-1.6.4.min.js">\x3C/script>');
				document.write('<script src="'+url+'/assets/scripts/jquery-ui.min.js"">\x3C/script>');
			}
		</script>

        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>
        
        <!-- Menu -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/superfish/superfish.js"></script>
		

        <!-- Js used in the theme -->
        <!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/scripts/muse.js"></script> -->

</head>
<body>
<?
$dsubsrep = '';
$dauthrep = '';
switch(strtoupper($_GET['r'])){
	case 'SUBSREP' :
		$dsubsrep = 'class="active iconed"';
		break;
	case 'AUTHREP' :
		$dauthrep = 'class="active iconed"';
		break;
}
?>
<div id="wrap">
	<div id="main">
            <header class="container">
                <div class="row clearfix">
                    <div class="left">
                        <a href="index.html" id="logo">Muse</a>
                    </div>

                    
                    <div class="right">
                        
                        <ul id="toolbar">
                            <li><span>Logged in as</span> <a class="user" href="#">Administrator</a> <a id="loginarrow" href="#"></a></li>
                            <li><a id="messages" href="#">Messages</a></li>
                            <li><a id="settings" href="#">Settings</a></li>

                            <li><a id="search" href="#">Search</a></li>
                        </ul>

                        <div id="logindrop">
                            <ul>
                                <li id="editprofile"><a href="#">Edit Profile</a></li>
                                <li id="logoutprofile"><a href="#">Logout</a></li>
                            </ul>

                        </div>
                        <div id="searchdrop">
                            <input type="text" id="searchbox" placeholder="Search...">
                        </div>
                        
                    </div>  
                </div>
            </header>
            
            <nav class="container">
                <select class="mobile-only row" onchange="window.open(this.options[this.selectedIndex].value,'_top')">

                    <option value="index.html">Dashboard</option>
                </select>

                <ul class="sf-menu mobile-hide row clearfix">
                    <li>
                        <a href="index.html?t=dashboard"><span><img src="<?=Yii::app()->request->baseUrl."/assets/images/header/icon_dashboard.png"?>" /> Dashboard</span></a>
                    </li>
                    <li <?=$dsubsrep?>><a href="/subsrep"><span>Subscriber</span></a>
                        <ul>
                            <li><a href="/subsrep/?serv=online">Online</a></li>
							<li><a href="/subsrep/?serv=wifi">Wi-Fi</a></li>
                        </ul>
                    </li>
					<li <?=$dauthrep?>><a href="/authrep"><span>Authen Log</span></a>
                        <ul>
                            <li><a href="/authrep/?serv=online">User</a></li> 
                            <!-- <li><a href="<?=Yii::app()->createUrl('authrep', array('serv'=>'online',))?>">User</a></li> -->
                        </ul>
                    </li>
					<li><a href="/confrepo"><span>Config Repos.</span></a>
					</li>
					<li><a href="/utilrep"><span>Util Report</span></a>
					</li>
                </ul>
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