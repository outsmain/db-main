<?php  
$connection = Yii::app()->db;
 $user = Yii::app()->session['user'];


//$sql = "SELECT P.TITLE, P.NAME, U.GROUPNAME_ID FROM USERNAME U ,GROUPAUTHORIZE G ,PAGENAME P WHERE  U.GROUPNAME_ID = G.GROUPNAME_ID AND G.PAGENAME_ID = P.ID AND  U.NAME = '".$user."'";

//$command = $connection->createCommand($sql);
//$dataReader = $command->query();
//foreach ($dataReader as $row) {    
  //  echo $murl = $row['NAME'];
	// echo $title = $row['TITLE'];
	//echo "<br>";

//}

?>


<html lang="en-us">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

        <title>IPNTM Admin Panel</title>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

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
		<link rel="stylesheet" href="assets/styles/jquery.multiselect.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="assets/styles/jquery.multiselect.filter.css" type="text/css" media="screen" />

        <!-- Use CDN on production server -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        
        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>
		
		<script type="text/javascript" src="assets/scripts/jquery.multiselect.filter.min.js"></script>
		<script type="text/javascript" src="assets/scripts/jquery.multiselect.min.js"></script>
		<script type="text/javascript" src="assets/scripts/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="assets/scripts/flot/jquery.flot.stack.min.js"></script>
        
        <!-- Menu -->
        <link rel="stylesheet" href="assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="assets/scripts/superfish/superfish.js"></script>
		

        <!-- Js used in the theme -->
        <script src="assets/scripts/muse.js"></script>

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
                                <li id="editprofile"><a href="#">Edit Profile</a></li>
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
					//$sql = "SELECT P.TITLE, P.NAME, U.GROUPNAME_ID FROM USERNAME U ,GROUPAUTHORIZE G ,PAGENAME P WHERE  U.GROUPNAME_ID = G.GROUPNAME_ID AND G.PAGENAME_ID = P.ID AND  U.NAME = '".$user."'";
					$sql = "SELECT * FROM PAGENAME LIMIT 2,10";
					$command = $connection->createCommand($sql);
					$dataReader = $command->query();//print_r($dataReader);
						$r = array();
						foreach ($dataReader as $row) {    
						 $ex = explode(' > ',$row['COMMENT']);
						 if(!isset($ex[0])) $r[$ex[0]] = $ex[0];
						 
						 if(!isset($r[$ex[0]][$ex[1]])) {//echo $ex[1]."\n";
							$r[$ex[0]][$ex[1]] = $ex[1];
						 //print_r($r);
						 }
						//echo $ex[1]."\n";
						 //if(isset($ex[1])) {echo"xxx";$r[$ex[0]][$ex[1]] = $ex[1];}
						 
						 //if(isset($ex[2])) $r[$ex[0]][$ex[1]][$ex[2]] = $ex[2];
						 //foreach($ex as $k=>$v){
							//$r[$ex[0]] = $ex[0];
							//$r[$ex[0]][$ex[1]] = $ex[1];
							//echo $ex[$k]."\n";
						 //}
						 
						 //$title = $row['TITLE'];
						//echo $murl = $row['NAME'];
						//echo "<br>";
						} 
						$t['cc']['vv'] = 'xxx';
						print_r($r);
						//foreach($r as $k=>$v){
						//	print_r($v);
						//}
						exit;?>
						
						 <li><a href="<?php echo $murl ?>"><span><?php echo $title ?></span></a>
					<?php
						
						?>
						
                <ul class="sf-menu mobile-hide row clearfix">
                    <li>
                        <a href="index.html?t=dashboard"><span><img src="assets/images/header/icon_dashboard.png" /> Dashboard</span></a>
                    </li>
					
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
</div>
