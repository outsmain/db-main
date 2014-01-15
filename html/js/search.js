var timer;
function TimeDifferenceCounter(datestart,dateend){ //in > 2013-11-03 00:00:01
	var content = "";
        if(datestart=="-" || dateend=="-"){
            content="-";
        }else{
            var DateTimeStart = datestart.split(' ');
            var DateStart = DateTimeStart[0].split('-');
            var DTS = DateStart[1]+"/"+DateStart[2]+"/"+DateStart[0]+" "+DateTimeStart[1];

            var DateTimeEnd = dateend.split(' ');
            var DateEnd = DateTimeEnd[0].split('-');
            var DTE = DateEnd[1]+"/"+DateEnd[2]+"/"+DateEnd[0]+" "+DateTimeEnd[1];

            var date1 = new Date(DTS);
            var date2 = new Date(DTE);
            var sec = (date2.getTime()/1000.0) - (date1.getTime()/1000.0);

            var t = parseInt(sec);
            var years;var months;var days;
            if(t>31556926){
                    years = parseInt(t/31556926); t = t-(years*31556926);		
            }
            if(t>2629743){
                    months = parseInt(t/2629743); t = t-(months*2629743);	
            }
            if(t>86400){
                    days = parseInt(t/86400); t = t-(days*86400);
            }
            var hours = parseInt(t/3600);
            t = t-(hours*3600);
            var minutes = parseInt(t/60);
            t = t-(minutes*60);
            if(years)content+=years+" y";
            if(months){ if(content)content+=" "; content+=months+" m"; }
            if(days){ if(content)content+=" ";  content+=days+" d"; }
            if(hours||days){ if(content)content+=" "; content+=hours+" hrs"; }
            if(content)content+=" "; content+=minutes+" min "+t+" sec";
        }
	return content;
        
}
  
function formatDate(txtDate){ //in > 2013-11-03 00:00:01 , out > 05 Nov 2013 00:00:01
	var txtDateFormate;
	if(txtDate == "-"){
		txtDateFormate=txtDate;
	}else{
		var DateTime = txtDate.split(' ');
		var txtDateTime = new Date(DateTime[0]).toUTCString().split(' ');
		txtDateFormate = txtDateTime[1]+" "+txtDateTime[2]+" "+txtDateTime[3]+" "+DateTime[1];
	}
	return txtDateFormate;
}

function CheckFormatDate(d) {
    var re = /^(((((0[1-9])|(1\d)|(2[0-8]))-((0[1-9])|(1[0-2])))|((31-((0[13578])|(1[02])))|((29|30)-((0[1,3-9])|(1[0-2])))))-((20[0-9][0-9]))|(29-02-20(([02468][048])|([13579][26])))) (([0-1][0-9])|([2][0-3])):([0-5][0-9]):([0-5][0-9])/;
    //dd-MM-yyyy hh:mm:ss
    return re.test(d);
}
  
function CheckTextNull(txtNull){ 
	var txtValue;
	if(txtNull == "" || txtNull.toUpperCase() == "NULL"){
		txtValue = "-";
	}else{
		txtValue=txtNull;
	}
	return txtValue;
}
  
function onDrop(){                      
    var result = $('#dropDownLists');
	$.ajax({
		url: urlDrop,
		dataType: 'json',
		cache: false,
		type: 'post',
		success: function(data) {
			if(data1.length > 0){
				var tmp = '';		
				tmp += '<select name="service" id="OnlineService">';
				tmp += '<option value="">- - All - -</option>';
				for(var i=0;i<data.length;++i){
					tmp += '<option value="'+data[i].service+'">'+data[i].service+'</option>';
				}
				tmp += '</select>';
			 }
			result.html(tmp);
		}
	});
}

function SplitTable(data){
	var result = $('#req_result');
	if(data.length > 0){
		var tmp = [];
		tmp.push('<table class="dataTable"><thead><tr><th class="align-left">Login Date</th><th class="align-left">Node Name</th><th class="align-left">Node IP</th><th class="align-left">User Name</th><th class="align-left">User IP</th><th class="align-left">Command</th></tr></thead><tbody id="detail">');
		var j = data.length;
		var i=0;
		while(i<j){
			tmp.push('<tr class="gradeX" id="dt-'+((data[i].id == null)?'-':data[i].id)+'">');
			tmp.push('<td>'+((data[i].login_date == null)?'-':data[i].login_date)+'</td>');
			tmp.push('<td>'+((data[i].node_name == null)?'-':data[i].node_name)+'</td>');
			tmp.push('<td>'+((data[i].node_ip == null)?'-':data[i].node_ip)+'</td>');
			tmp.push('<td>'+((data[i].user_name == null)?'-':data[i].user_name)+'</td>');
			tmp.push('<td>'+((data[i].user_ip == null)?'-':data[i].user_ip)+'</td>');
			tmp.push('<td>'+((data[i].cmd == null)?'-':data[i].cmd)+'</td>');
			tmp.push('</tr>');
			++i;
		}
		tmp.push('</tbody></table>');
		var Str = tmp.join('');
		result.html(Str);
		$('.dataTable').dataTable({
			"sPaginationType": "full_numbers",
			"bJQueryUI": true
		});	
		SplitDialog(secondurl);
	}else{
		result.html('No Data Found.');
	}
}

function SplitDialog(url){
	$('.dataTable > tbody').click(function(event){
		var tr = $(event.target).parent();
		var id = tr[0].id.split('-');
		$.ajax({
			url: url,
			dataType: 'json',
			cache: false,
			type: 'post',
			data: {'id':id[1]},
			success: function(data){
				ShowDialog(data);					 
			}
		});	
	});
}

function ShowDialog(data){
	var tmp = [];
	if(data.length > 0){
		$.each(data,function(i, val){
			switch(val.is_use){
				case 'null' :
					var use = '-';
					break;
				case '0' :
					var use = 'Not Active';
					break;
				case '1' :
					var use = 'Active';
					break;
				case '2' :
					var use = 'Disable';
					break;
			}
			tmp.push('<p>Add Date : '+((val.add_date == null)?'-':formatDate(val.add_date))+'</p>');
			tmp.push('<p>Update Date : '+((val.update_date == null)?'-':formatDate(val.update_date))+'</p>');
			tmp.push('<p>IP Address : '+((val.ip_addr == null)?'-':val.ip_addr)+'</p>');
			tmp.push('<p>Name : '+((val.name == null)?'-':val.name)+'</p>');
			tmp.push('<p>Comment : '+((val.comment == null)?'-':val.comment)+'</p>');
			tmp.push('<p>Site Name : '+((val.site_name == null)?'-':val.site_name)+'</p>');
			tmp.push('<p>Brand : '+((val.brand == null)?'-':val.brand)+'</p>');
			tmp.push('<p>Model : '+((val.model == null)?'-':val.model)+'</p>');
			tmp.push('<p>Software : '+((val.sw_ver == null)?'-':val.sw_ver)+'</p>');
			tmp.push('<p>Type : '+((val.ne_type == null)?'-':val.ne_type)+'</p>');
			tmp.push('<p>Level : '+((val.level == null)?'-':val.level)+'</p>');
			tmp.push('<p>Status Mapped Values : '+use+'</p>');
			if(i > 0) tmp.push('<p></p>');
		});
	}else{
		tmp.push('No Data Found.');
	}
	$('#dialog').html(tmp.join(''));
	$('#dialog').dialog('open');	
}

function CheckStatus(t, val){
	$.ajax({
		url: urlExportData,
		dataType: 'json',
		cache: false,
		type: 'post',
		data: {'str':t},
		success: function(data){
			if(data === false){
				if(val > 100){
					window.clearTimeout(timer);
					timer = setTimeout(function(){CheckStatus(t,val)},3000);
				}else{	
					window.clearTimeout(timer);
					timer = setTimeout(function(){CheckStatus(t,val)},800);
				}
			}else{
				$("#dia-exp").dialog('close');
			}
		}
	});
}

function OpenGraph(val,id){
	var url = '';
	switch(val){
		case 'nodename' :
			url = urlNodeName;
		break;
		case 'nodeip' :
			url = urlNodeName;
		break;
		case 'success_rate' :
			url = urlSuccessRate;
		break;
		case 'login_num' :
			url = urlSuccessRate;
		break;
		case 'login_rate' :
			url = urlLoginRate;
		break;
		case 'cmd_num' :
			url = urlCmdRate;
		break;
		case 'cmd_rate' :
			url = urlCmdRate;
		break;
	}
	var NodeName = $("#NodeName").val();
	if(NodeName !== null){
		NodeName = (NodeName.length == $("#NodeName option").length) ? "" : NodeName;
		if(NodeName != ""){
			var str = '';
			$.each(NodeName,function(k,v){
				str += v+',';
			});
			NodeName = str.substr(0,(str.length-1));
		}
	}else{
		NodeName = "";
	}
	$.ajax({
		url: url,
		dataType: 'json',
		cache: false,
		type: 'post',
		data: {'str':val,'id':id,'sum_type':$('#summary_type').val(),'node_name':NodeName},
		success: function(data){
			if(data != null){
				var title = 'Node '+data[2][0]+' / '+data[2][1]+' Authentication Statistics';
				if($('body').has('#dia-graph').length > 0){
					$('#dia-graph').remove();				
				}
				$('body').append('<div id="dia-graph" title="'+title+'"><div class="flot-container"><div id="placeholder" class="flot-placeholder"></div></div></div>');
				doPlot(data,"right");
			}
		}
	});
}

function doPlot(data,position) {	 
	var arrData = [];
	var i = 0;
	$.each(data[1],function(k,val){
		if(val != null){
			var j = 0;
			$.each(val,function(key,item){
				if(i > 0){
					arrData.push({data:item, label:key+' ('+data[0][1]+')', yaxis: 2, label2:key});
				}else{
					arrData.push({data:item, label:key+' ('+data[0][0]+')', label2:key});
				}
				j++;
			});
			i++;
		}
	});

	var plot =  $.plot("#placeholder", arrData, {
			xaxes:[{ 
				mode: "time",
				timezone: null,		
				timeformat: "%H:%I:%S",	
				twelveHourClock: true,	
				monthNames: null	
			}] ,
			grid: {
				backgroundColor: '#ffffff',
				hoverable: true, 
				clickable: true,
			},
			yaxes: [{ min: 0 },{
			   alignTicksWithAxis: true,
			   position: "right",
			}],
			points: {
				radius: 5,
				symbol: "circle",
				show: true
			},
			lines: {show: true}
		}
	);
	var container = $("#placeholder");
	var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text(data[0][0]).appendTo(container); 
	yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
	var yaxisLabel_r = $("<div id='axisLabel-right' class='axisLabel-right yaxisLabel-right'></div>").text(data[0][1]).appendTo(container); 
	yaxisLabel_r.css("margin-top", yaxisLabel_r.width() / 2 - 20);
	if($('body').has('#tooltip').length < 1){
		$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			padding: "8px",
			"font-size":"14px",
			zIndex: 2000,
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");
	}
	$("#placeholder").bind("plothover", function (event, pos, item) {
		if (item) {
			var d = new Date(item.series.data[item.dataIndex][0]);
			var e = d.toUTCString().split(' ');
			var t = d.toTimeString().split(' ');
			var strDate = '<b>'+e[1]+' '+e[2]+'  '+e[3]+' '+t[0]+'</b>';
			var y = item.datapoint[1];
			if(item.series.label2 === 'Success Rate %') y = item.datapoint[1].toFixed(2);
			if(item.series.label2 === 'Login Req./s') y = item.datapoint[1].toFixed(3);
			if(item.series.label2 === 'Login Num (Acp/Rej)') y = item.datapoint[1].toFixed(3);
			var str = strDate+'<p style="margin-top:5px;">'+item.series.label2+' = '+y+'</p>';
			$("#tooltip").html(str)
				.css({top: item.pageY+5, left: item.pageX+5})
				.fadeIn(200);
		} else {
			$("#tooltip").hide();
		}
	});

	$('#dia-graph').dialog({
		autoOpen: false,
		width: 900,
		height: 'auto',
		closeOnEscape: true,
		buttons: {
			"Close": function() {
			$(this).dialog("close");
			}
		},
		modal: true
	});
	$('#dia-graph').dialog('open');
}

function OpenDialogBox(ip){
	$.ajax({
		url: secondurl,
		dataType: 'json',
		cache: false,
		type: 'post',
		data: {'ip':ip},
		success: function(data) {
			ShowDialog(data);
		}
	});
}
$(function() {
	if($('body').has('#dialog').length > 0){
		$('#dialog').dialog({
			autoOpen: false,
			width: 600,
			closeOnEscape: true,
			buttons: {
				"Close": function() {
				$(this).dialog("close");
				}
			},
			modal: true
		});
	}
});