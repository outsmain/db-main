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
                    <label>Summary Type</label>
                    <div class="input">
						<select id="summ_select" name="event">
							<option>Hourly</option>
							<option>Daily</option>
						</select>
                    </div>
                </div>
				<div class="col_2">
                    <label>Node Name</label>
                    <div class="input">
					<select id="node_select" multiple="multiple">
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
				<div class="report">
            <div class="col_12">
                <table class='dataTable'>
                <thead>
                        <tr>
								<th class="align-left">Update Date</th>
								<th class="align-left">Last Login</th>
								<th class="align-left">Node Name</th>
								<th class="align-left">Node IP</th>
								<th class="align-left">Login Num (Acp / Rej)</th>
								<th class="align-left">Success Rate (%)</th>
								<th class="align-left">Login Req. /s</th>
								<th class="align-left">Cmd Num</th>
								<th class="align-left">Cmd /s</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:20:00</td>
								<td></td>
								<td>DSLAM 1</td>
								<td>12.1.2.1</td>
								<td>283 / 302</td>
								<td>20.102</td>
                                <td>93.708</td>
                                <td>38</td>
								<td>23.2</td>
                        </tr>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:20:02</td>
								<td></td>
								<td>DSLAM 2</td>
								<td>12.1.2.2</td>
								<td>152 / 203</td>
								<td>13.293</td>
                                <td>74.876</td>
                                <td>21</td>
								<td>1.23</td>
                        </tr>
                        <tr class="gradeX">
								<td>1 Oct 2013 01:21:02</td>
								<td></td>
								<td>DSLAM 3</td>
								<td>12.1.2.3</td>
								<td>302 / 352</td>
								<td>9.203</td>
                                <td>85.795</td>
                                <td>65</td>
								<td>4.2</td>
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