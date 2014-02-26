<?php
$page_name="Subscriber Report";
//include('header.php');
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}

?>
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
 <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/assets/DataTable/js/jquery.dataTables.min.js");?>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<div class="container" id="actualbody">

<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Filter</h2>
			<div class="widget_inside">				
				<div class="col_2">
                    <div class="clearfix">
                        <label>Start Date</label>
                        <div class="input">
                            <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="medium" />
                        </div>
                    </div>
				</div>
				<div class="col_2">
                    <label>End Date</label>
                    <div class="input">
                       <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="medium" />
                    </div>
                </div>
				<div class="col_2">
                    <label>Service</label>
                    <div class="input" id="service_select">
						<select>
							<option>All</option>
							<option>Fixed Line</option>
							<option>ADSL</option>
						</select>
                    </div>
                </div>
				<div class="col_3">
                    <label>Node Name</label>
                    <div class="input">
					<select multiple="multiple" id="node_select">
						<optgroup label="NeList.site_name #1">
							<option value="NeList.ip_addr">NeList.name #1</option>
							<option value="NeList.ip_addr">NeList.name #2</option>
						</optgroup>
						<optgroup label="NeList.site_name #2">
							<option value="NeList.ip_addr">NeList.name #3</option>
							<option value="NeList.ip_addr">NeList.name #4</option>
						</optgroup>
					</select>
                    </div>
                </div>
				<div class="col_2 last">
					<label>&nbsp;</label>
                    <div class="input">
						<input type="submit" class="button blue" value="Submit"></input>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Report</h2>
			<div class="widget_inside">		
			<div id ="tabs">
				  <ul>
					<li><a href="#tabs-1">Split</a></li>
					<li><a href="#tabs-2">Inline</a></li>
				  </ul>
					<div id="tabs-1">			
				<div class="report">
            <div class="col_12">
                <table class='dataTable'>
                <thead>
                        <tr>

                            <th></th>
                                <th class="align-left">Node Name</th>
								<th class="align-left">Start Date</th>
								<th class="align-left">End Date</th>
								<th class="align-left">Duration</th>
								<th class="align-left">Service</th>
                                <th class="align-left">Prov. Subs.</th>
								<th class="align-left">Conn. Subs.</th>
                                <th class="align-left">Min./Line</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
                            <td><input type="checkbox" />
                                <td>DSLAM 1</td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
								<td>50 min.</td>
								<td>All</td>
                                <td>25</td>
                                <td>30</td>
                                <td>41.667</td>
                        </tr>
					    
                    </tbody>
                </table>
            </div>
				</div>
            </div>
			<div id="tabs-2">
			fdsfls;gk;s
			</div>
			</div>
        </div>
    </div>
</div>
</div>
        </div><!--container -->
    </div>
</div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nunc tincidunt</a></li>
    <li><a href="#tabs-2">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
  <div id="tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
  </div>
</div>
 
<script type="text/javascript">
$("select").multiselect({
   minWidth: 150
});
$("select").multiselect().multiselectfilter();
</script>
<?php
//include('footer.php');
?>