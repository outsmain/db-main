<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<script src="jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	    $(document).ready(function(){
			resizeWindow();
	        $(window).bind("resize", resizeWindow);
	        function resizeWindow(){    
	          	var newWindowWidth = $(window).width();
				$('#trace').text(newWindowWidth);
				if(newWindowWidth < 600){                
					//$('link[rel=stylesheet]').attr({href : "css/mobile.css"});              
					$('#cssDevice').attr({href : "css/mobile.css"});              
				}else{
					//$('link[rel=stylesheet]').attr({href : "css/style.css"});
					$('#cssDevice').attr({href : "css/style.css"});
				}
	        }
	    });
</script>
<style type=”text/css”>
.columns {
-moz-column-count: 3;
-webkit-column-count: 3;
}
</style>
<style type="text/css">
body{ margin:0px; padding:0px; font-size:14px;}
.colum{ width:600px; margin:auto; background-color:#CCCCCC;}
.colum ul{ margin:0px; padding:0px; list-style:none;}
.colum ul li{ float:left; margin:10px; width:120px; height:200px; line-height:100px; text-align:center; }
</style>

<link href="css/style.css" rel="stylesheet" type="text/css" id="cssDevice" />
<link href="css/base.css" rel="stylesheet"  type="text/css" />
</head>

<body>
<div class="colum">
<ul>
<? for($i = 1; $i<=16; $i++){?>
	<li><?=$i?></li>
<?  } ?>
</ul>
</div>
    	<h1>Flexible Site (custom layout)</h1>
        <p id="intro">Hello this is test flexible site bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra bra </p>
        <div id="wrap-col">
    <div id="left">        
  <?php
  
	for($i=0;$i<=15;$i++){
  ?>
  <input type="checkbox" name="option1" value="Milk"> subsrep/query?serv=online</input>
  <?php } ?>

  
   <?php
	for($i=0;$i<=15;$i++){
  ?>
  <input type="checkbox" name="option1" value="Milk"> subsrep/query?serv=online</input>
  <?php } ?>
  </div>
   <div id="right">
   <?php
  
	for($i=0;$i<=15;$i++){
  ?>
  <input type="checkbox" name="option1" value="Milk"> subsrep/query?serv=online</input>
  <?php } ?>
  </div>
            <div class="clear"></div>
        </div>
        <p>foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot foot </p>

	<div id="trace">
    	trace
    </div>
</body>
</html>
