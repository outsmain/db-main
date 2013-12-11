<div class="page-header">
	<h1>DateTimePicker <small>jQuery plugin select date and time</small></h1>
</div>
<p>
Use this plugin to unobtrusively add a datetimepicker, datepicker or timepicker dropdown to your forms. It's easy to customize options. <a href="https://github.com/xdan/datetimepicker">Source code on GitHub</a> or <a href="https://github.com/xdan/datetimepicker/archive/master.zip">download (zip)</a>.
</p>
<?php echo $this->parse('adsense5')?>
<h3>DateTimepicker</h3>
<input type="text" value="2014/03/15 05:06" id="datetimepicker"/><br/>
<h3>Use mask DateTimepicker</h3>
<input type="text" value="" id="datetimepicker_mask"/><br/>
<h3>TimePicker</h3>
<input type="text" id="datetimepicker1"/><br/>
<h3>DatePicker</h3>
<input type="text" id="datetimepicker2"/><br/>
<h3>Inline DateTimePicker</h3>
<input type="text" id="datetimepicker3"/><br/>
<script>
$(function(){
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59',
});
$('#datetimepicker').datetimepicker();
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:06'});
$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	value:'12:00'
});
$('#datetimepicker2').datetimepicker({
	timepicker:false,
	format:'d/m/Y'
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
});
</script>
</p>
<p>
<a class="btn btn-large btn-primary" href="https://github.com/xdan/datetimepicker/archive/master.zip">Download (zip)</a>
</p>
<h2>How do I use it?</h2>
<p>
First include to page css and js files
<pre><code data-language="html">&lt;!-- this should go after your &lt;/body&gt; --&gt;
&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;jquery.datetimepicker.css&quot;/ &gt;
&lt;script src=&quot;jquery.js&quot;&gt;&lt;/script&gt;
&lt;script src=&quot;jquery.datetimepicker.js&quot;&gt;&lt;/script&gt;</code></pre>
</p>
<h2>Examples</h2>
<h4>Simple init DateTimePicker Example</h4>
<p>HTML</p>
<pre><code data-language="html">&lt;input id=&quot;datetimepicker&quot; type=&quot;text&quot; &gt;</code></pre>
<p>JavaScript</p>
<pre><code data-language="javascript">$('#datetimepicker').datetimepicker();</code></pre>
<p>Result</p>
<p><input id="_datetimepicker" type="text" value="2014/03/15 05:06" /></p>
<script>
$(function(){$('#_datetimepicker').datetimepicker();});
</script>
<h4>i18n DatePicker Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker1&#39;).datetimepicker({
 lang:&#39;de&#39;,
 i18n:{
  de:{
   months:[
    &#39;Januar&#39;,&#39;Februar&#39;,&#39;M&auml;rz&#39;,&#39;April&#39;,
    &#39;Mai&#39;,&#39;Juni&#39;,&#39;Juli&#39;,&#39;August&#39;,
    &#39;September&#39;,&#39;Oktober&#39;,&#39;November&#39;,&#39;Dezember&#39;,
   ],
   dayOfWeek:[
    &quot;So.&quot;, &quot;Mo&quot;, &quot;Di&quot;, &quot;Mi&quot;, 
    &quot;Do&quot;, &quot;Fr&quot;, &quot;Sa.&quot;,
   ]
  }
 },
 timepicker:false,
 format:&#39;d.m.Y&#39;
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker1" type="text" value="15.08.2013" /></p>
<script>$(function(){
$('#_datetimepicker1').datetimepicker({
 lang:'de',
 i18n:{de:{
  months:[
   'Januar','Februar','Marz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'
  ],
  dayOfWeek:["So.", "Mo", "Di", "Mi", "Do", "Fr", "Sa."]
 }},
timepicker:false,
format:'d.m.Y'
});
});
</script>
<h4>Only TimePicker Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker2&#39;).datetimepicker({
	datepicker:false,
	format:&#39;H:i&#39;
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker2" type="text" value="23:16" /></p>
<script>$(function(){
$('#_datetimepicker2').datetimepicker({
  datepicker:false,
  format:'H:i'
});
});
</script>
<h4>Inline DateTimePicker Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker3&#39;).datetimepicker({
  format:&#39;d.m.Y H:i&#39;,
  inline:true,
  lang:&#39;ru&#39;
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker3" type="text" value="10.12.2013 23:45" /></p>
<script>$(function(){
$('#_datetimepicker3').datetimepicker({
 format:'d.m.Y H:i',
 inline:true,
 lang:'en'
});
});
</script>
<h4>Icon trigger</h4>
<p>Click the icon next to the input field to show the datetimepicker</p>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker4&#39;).datetimepicker({
  format:&#39;d.m.Y H:i&#39;,
  lang:&#39;ru&#39;
});</code></pre>
and handler onclick event
<pre><code data-language="javascript">$(&#39;#image_button&#39;).click(function(){
  $(&#39;#datetimepicker4&#39;).datetimepicker(&#39;show&#39;); //support hide,show and destroy command
});</code></pre>
<p>Result</p>
<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <input id="_datetimepicker4" type="text" value="10.12.2013 23:45" class="form-control">
      <span class="input-group-btn">
        <button id="image_button" class="btn btn-default" type="button"><span class="glyphicon glyphicon-calendar"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<script>$(function(){
$('#_datetimepicker4').datetimepicker({
  format:'d.m.Y H:i',
  lang:'en'
});
$('#image_button').click(function(){
	$('#_datetimepicker4').datetimepicker('show'); 
});
});

</script>
<h4>allowTimes options TimePicker Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker5&#39;).datetimepicker({
 datepicker:false,
 allowTimes:[
  &#39;12:00&#39;, &#39;13:00&#39;, &#39;15:00&#39;, 
  &#39;17:00&#39;, &#39;17:05&#39;, &#39;17:20&#39;, &#39;19:00&#39;, &#39;20:00&#39;
 ]
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker5" type="text" value="23:45" /></p>
<script>$(function(){
$('#_datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00']
});
});
</script>
<h4>handler changeDateTime Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker6&#39;).datetimepicker({
	timepicker:false,
	onChangeDateTime:function(dp,$input){
		alert($input.val())
	}
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker6" type="text" value="" /></p>
<script>$(function(){
$('#_datetimepicker6').datetimepicker({
 timepicker:false,
 onChangeDateTime:function(current_time,$input){
	alert($input.val())
 }
});
});
</script>

<h4>minDate and maxDate Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker7&#39;).datetimepicker({
 timepicker:false,
 formatDate:&#39;Y/m/d&#39;,
 minDate:&#39;-1970/01/02&#39;,//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate:&#39;+1970/01/02&#39;//tommorow is maximum date calendar
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker7" type="text" value="" /></p>
<script>$(function(){
$('#_datetimepicker7').datetimepicker({
	timepicker:false,
	formatDate:'Y/m/d',
	minDate:'-1970/01/02', // yesterday is minimum date
	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
});
</script>
<h4>Use mask input Example</h4>
<p>JavaScript</p>
<pre><code data-language="javascript">$(&#39;#datetimepicker_mask&#39;).datetimepicker({
 timepicker:false,
 mask:true, // &#39;9999/19/39 29:59&#39; - digit is the maximum possible for a cell
});</code></pre>
<p>Result</p>
<p><input id="_datetimepicker_mask" type="text" value="" /></p>
<script>$(function(){
$('#_datetimepicker_mask').datetimepicker({
	timepicker:false,
	mask:'9999/19/39'
	format:'Y/m/d'
});
});
</script>
<h2>Full options list</h2>
<table class="table table-condensed table-bordered table-striped">
	<thead>
		<tr>
			<th style="text-align: center;"><strong>Name</strong></th>
			<th style="text-align: center;"><strong>&nbsp;default</strong></th>
			<th style="text-align: center;"><strong>Descr</strong></th>
			<th style="text-align: center;"><strong>Ex.</strong></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>value</td>
			<td>null</td>
			<td>Current value datetimepicker. If it is set, ignored input.value</td>
			<td>
			<pre><code data-language="javascript">{value:&#39;12.03.2013&#39;,
 format:&#39;d.m.Y&#39;}</code></pre>
			</td>
		</tr>
		<tr>
			<td>lang</td>
			<td>en</td>
			<td>Language i18n (en,ru,de,nl)</td>
			<td>
			<pre><code data-language="javascript">{lang:&#39;ru&#39;}</code></pre>
			</td>
		</tr>
		<tr>
			<td>format</td>
			<td>Y/m/d H:i</td>
			<td>Format datetime. <a href="http://php.net/manual/ru/function.date.php" target="_blank">More</a>&nbsp;</td>
			<td>
			<pre><code data-language="javascript">{format:&#39;H&#39;}
{format:&#39;Y&#39;}</code></pre>
			</td>
		</tr>
		<tr>
			<td>formatDate</td>
			<td>Y/m/d</td>
			<td>Format date for minDate and maxDate</td>
			<td><pre><code data-language="javascript">{formatDate:&#39;d.m.Y&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>formatTime</td>
			<td>H:i</td>
			<td>&nbsp;Similarly, formatDate . But for minTime and maxTime</td>
			<td><pre><code data-language="javascript">{formatTime:&#39;H&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>step</td>
			<td>60</td>
			<td>Step time</td>
			<td>
			<pre><code data-language="javascript">{step:5}</code></pre>
			</td>
		</tr>
		<tr>
			<td>closeOnDateSelect</td>
			<td>0</td>
			<td>
			
			</td>
			<td><pre><code data-language="javascript">{closeOnDateSelect:true}</code></pre></td>
		</tr>
		<tr>
			<td>closeOnWithoutClick</td>
			<td>true</td>
			<td></td>
			<td><pre><code data-language="javascript">{ closeOnWithoutClick :false}</code></pre></td>
		</tr>
		<tr>
			<td>timepicker</td>
			<td>true</td>
			<td></td>
			<td><pre><code data-language="javascript">{timepicker:false}</code></pre></td>
		</tr>
		<tr>
			<td>datepicker</td>
			<td>true</td>
			<td></td>
			<td><pre><code data-language="javascript">{datepicker:false}</code></pre></td>
		</tr>
		<tr>
			<td>minDate</td>
			<td>false</td>
			<td></td>
			<td><pre><code data-language="javascript">{minDate:0} // today
{minDate:&#39;2013/12/03&#39;}
{minDate:&#39;-1970/01/02&#39;} // yesterday
{minDate:&#39;05.12.2013&#39;,formatDate:&#39;d.m.Y&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>maxDate</td>
			<td>false</td>
			<td></td>
			<td><pre><code data-language="javascript">{maxDate:0,}
{maxDate:&#39;2013/12/03&#39;}
{maxDate:&#39;+1970/01/02&#39;} // tommorrow
{maxDate:&#39;05.12.2013&#39;,formatDate:&#39;d.m.Y&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>minTime</td>
			<td>false</td>
			<td></td>
			<td><pre><code data-language="javascript">{minTime:0,}// now
{minTime:&#39;12:00&#39;}
{minTime:&#39;13:45:34&#39;,formatTime:&#39;H:i:s&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>maxTime</td>
			<td>false</td>
			<td></td>
			<td><pre><code data-language="javascript">{maxTime:0,}
{maxTime:&#39;12:00&#39;}
{maxTime:&#39;13:45:34&#39;,formatTime:&#39;H:i:s&#39;}</code></pre></td>
		</tr>
		<tr>
			<td>allowTimes</td>
			<td>[]</td>
			<td></td>
			<td><pre><code data-language="javascript">{allowTimes:[
	&#39;09:00&#39;,
	&#39;11:00&#39;,
	&#39;12:00&#39;,
	&#39;21:00&#39;
]}</code></pre></td>
		</tr>
		<tr>
			<td>mask</td>
			<td>false</td>
			<td>Use mask for input. true - automatically generates a mask on the field &#39;format&#39;, Digit from 0 to 9, set the highest possible digit for the value. For example: the first digit of hours can not be greater than 2, and the first digit of the minutes can not be greater than 5</td>
			<td><pre><code data-language="javascript">
				{mask:'9999/19/39',format:'Y/m/d'}
				{mask:true,format:'Y/m/d'} // automatically generate a mask 9999/99/99
				{mask:'29:59',format:'H:i'} //
				{mask:true,format:'H:i'} //automatically generate a mask 99:99
			</code></pre></td>
		</tr>
		<tr>
			<td>opened</td>
			<td>false</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>inline</td>
			<td>false</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>timepickerScrollbar</td>
			<td>true</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>onSelectDate</td>
			<td>function(){}</td>
			<td></td>
			<td><pre><code data-language="javascript">onSelectDate:function(current_time,$input){
  alert(current.dateFormat(&#39;d/m/Y&#39;))
}</code></pre></td>
		</tr>
		<tr>
			<td>onSelectTime</td>
			<td>function(){}</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>onChangeMonth</td>
			<td>function(){}</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>onChangeDateTime</td>
			<td>function(){}</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>onShow</td>
			<td>function(){}</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>onClose</td>
			<td>function(){}</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>withoutCopyright</td>
			<td>true</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>inverseButton</td>
			<td>false</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>hours12</td>
			<td>false</td>
			<td></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>dayOfWeekStart</td>
			<td>0</td>
			<td>
			<p>Star week DatePicker. Default Sunday - 0.</p>

			<p>Monday - 1 ...</p>
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>