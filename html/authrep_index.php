<?php
$page_name="Authentication Report";
include('header.php');
?>
<div class="container" id="actualbody">

<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Filter</h2>
			<div class="widget_inside">				
				<div class="col_3">
                    <div class="clearfix">
                        <label>Start Date</label>
                        <div class="input">
                            <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="large" name="start_date" />
                        </div>
                    </div>
				</div>
				<div class="col_3">
                    <label>End Date</label>
                    <div class="input">
                       <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="large" name="end_date" />
                    </div>
                </div>
				<div class="col_1">
                    <label>Event</label>
                    <div class="input">
						<select name="event">
							<option>All</option>
							<option>Accept</option>
							<option>Reject</option>
						</select>
                    </div>
                </div>
				<div class="col_2">
                    <label>User Name</label>
                    <div class="input">
                       <input type="text" placeholder="User Name" class="medium" name="username" />
                    </div>
                </div>
				<div class="col_2 last">
                    <label>Node Name</label>
                    <div class="input">
                       <input type="text" placeholder="CLLI or IP Address" class="large" name="ne_name" />
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
								<th class="align-left">Node Name</th>
								<th class="align-left">Node IP</th>
								<th class="align-left">User Name</th>
                                <th class="align-left">User IP</th>
                                <th class="align-left">Command</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:20:00</td>
								<td>DSLAM 1</td>
								<td>12.1.2.2</td>
								<td>user1@domain</td>
                                <td>102.2.3.1</td>
                                <td>show</td>
                        </tr>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:20:02</td>
								<td>DSLAM 1</td>
								<td>12.1.2.2</td>
								<td>user1@domain</td>
                                <td>102.2.3.1</td>
                                <td>show conf</td>
                        </tr>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:21:02</td>
								<td>DSLAM 2</td>
								<td>12.1.2.3</td>
								<td>user2@domain</td>
                                <td>102.2.3.1</td>
                                <td>quit</td>
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

<?php
include('footer.php');
?>