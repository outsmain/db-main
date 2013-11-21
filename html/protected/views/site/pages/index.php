<?php
$page_name="Dashboard1";
if($user = Yii::app()->session['user']==''){
$this->redirect('index.php?r=site/login');
exit;
}
?>

<div class="container" id="actualbody">

<div class="row clearfix">
	<div class="col_12">
		<div class="widget clearfix">
        <h2>Report</h2>
			<div class="widget_inside">
				<h3>Current Statistics</h3>
				
				<div class="report">
					<div class="button up">

						<span class="value">35,331</span>
						<span class="attr">Devices</span>
					</div>
					<div class="button down">
						<span class="value">25</span>
						<span class="attr">Users</span>
					</div>
                    <div class="button">
						<span class="value">65,325</span>
						<span class="attr">Interfaces</span>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
    
           
        </div><!--container -->
    </div>
</div>

