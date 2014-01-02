<?php
$page_name="Login Log Report";
include('header.php');
?>
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
                            <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="medium" name="start_date" />
                        </div>
                    </div>
				</div>
				<div class="col_2">
                    <label>End Date</label>
                    <div class="input">
                       <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="medium" name="end_date" />
                    </div>
                </div>
				<div class="col_2">
                    <label>User Name</label>
                    <div class="input">
                       <input type="text" placeholder="User Name" class="medium" name="user_name" />
                    </div>
                </div>
				<div class="col_2">
                    <label>User IP</label>
                    <div class="input">
                       <input type="text" placeholder="IP Address" class="medium" name="user_ip" />
                    </div>
                </div>
				</div>
				<div class="col_2 last">
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
				<div class="report">
            <div class="col_12">
                <table class='dataTable'>
                <thead>
                        <tr>
								<th class="align-left">Login Date</th>
								<th class="align-left">User Name</th>
								<th class="align-left">User IP</th>
								<th class="align-left">Command</th>
								<th class="align-left">Description</th>
								<th class="align-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:20:00</td>
								<td>admin</td>
								<td>122.1.2.1</td>
								<td>Login</td>
								<td></td>
                                <td>OK</td>
                        </tr>
                        <tr class="gradeX">
								<td>0 Oct 2013 09:33:12</td>
								<td>user1</td>
								<td>122.1.2.1</td>
								<td>Login</td>
                                <td></td>
                                <td>OK</td>
                        </tr>
                        <tr class="gradeX">
								<td>12 Oct 2013 12:11:32</td>
								<td>user2</td>
								<td>122.1.2.1</td>
								<td>Login</td>
								<td></td>
                                <td>OK</td>
                        </tr>
                    </tbody>
                </table>
            </div>
				</div>
            </div>
        </div>
    </div>
</div>
</div><!--container -->
</div>
</div>
<script type="text/javascript">
$("select").multiselect();
$("#summ_select").multiselect({
   multiple: false,
   selectedList: 1,
   minWidth: 150
});
$("#node_select").multiselect({
   multiple: true,
   minWidth: 150
});
$("#node_select").multiselect().multiselectfilter();
</script>
<?php
include('footer.php');
?>