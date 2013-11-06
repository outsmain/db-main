<?php
$page_name="Subscriber Report";
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
                            <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="large" />
                        </div>
                    </div>
				</div>
				<div class="col_3">
                    <label>End Date</label>
                    <div class="input">
                       <input type="text" placeholder="DD/MM/YYYY HH:MM:SS" class="large" />
                    </div>
                </div>
				<div class="col_2">
                    <label>Service</label>
                    <div class="input">
						<select>
							<option>All</option>
							<option>Fixed Line</option>
							<option>ADSL</option>
						</select>
                    </div>
                </div>
				<div class="col_2 last">
                    <label>Node Name</label>
                    <div class="input">
                       <input type="text" placeholder="CLLI or IP Address" class="large" />
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
					    <tr class="gradeX">
                            <td></td>
                                <td></td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
                                <td>50 min.</td>
								<td>Fixed Line</td>
                                <td>5</td>
                                <td>11</td>
                                <td>22.727</td>
                        </tr>
                        <tr class="gradeX">
                            <td></td>
                                <td></td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
                                <td>50 min.</td>
								<td>ADSL</td>
                                <td>23</td>
                                <td>28</td>
                                <td>41.071</td>
                        </tr>
                        <tr class="gradeX">
                            <td><input type="checkbox" />
                                <td>DSLAM 2</td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
                                <td>50 min.</td>
								<td>All</td>
                                <td>28</td>
                                <td>32</td>
                                <td></td>
                        </tr>
					    <tr class="gradeX">
                            <td></td>
                                <td></td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
                                <td>50 min.</td>
								<td>Fixed Line</td>
                                <td>2</td>
                                <td>8</td>
                                <td>12.500</td>
                        </tr>
                        <tr class="gradeX">
                            <td></td>
                                <td></td>
								<td>1 Oct 2013 03:20:00</td>
								<td>1 Oct 2013 04:20:00</td>
                                <td>50 min.</td>
								<td>ADSL</td>
                                <td>27</td>
                                <td>31</td>
                                <td>43.548</td>
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