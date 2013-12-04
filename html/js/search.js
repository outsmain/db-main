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

$(function() {
	$('#dialog').dialog({
            autoOpen: false,
            width: 600,
            buttons: {
				"Close": function() {
				$(this).dialog("close");
                }
            },
            modal: true
	});
});