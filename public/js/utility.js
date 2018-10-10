function copyValue(id,target)
{
	if($('#'+id).attr('checked'))
	{ 
		$("."+target).val($("#"+target+"_1").val());
	} 
	else 
	{
		$("."+target).val("");
	}
}

function up(o)
{
	o.value=o.value.toUpperCase().replace(/([^0-9A-Z-])/g,"");
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	// alert(charCode);
	if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46))
		return false;

	return true;
}

function isNumberKeyNegative(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	// alert(charCode);
	if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46) && (charCode != 45))
		return false;

	return true;
}

function isNumberKeyInt(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	// alert(charCode);
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}

function move_focus(target)
{
	$("#"+target).focus();
}

function calculate(text1,text2,target)
{
	var text1=$("#"+text1).val();
	var text2=$("#"+text2).val();
	
	if(text1=="") {text1=0;}
	if(text2=="") {text2=0;}
	
	var result=text1*text2;
	
	$("#"+target).val(parseFloat(result));
}

function complete_nts(counter)
{
	var value=$("#nts_"+counter).val();
	var str_len=value.length;


	if(parseFloat(value)>0)
	{
		if((value!="")&&(str_len<=3))
		{
			switch(str_len)
			{
				case 3 : value = "NTS-"+value; break;
				case 2 : value = "NTS-0"+value; break;
				case 1 : value = "NTS-00"+value; break;
				default : value = value; break;
			}
			
			$("#nts_"+counter).val(value);
		}
	}
}

function set_select2me_text(element_id,value,text)
{
	if(value !== undefined && value !== null && text !== null)
	{
		$(element_id+" option[value='"+value+"']").remove();
		$(element_id).append
		(
	        $('<option></option>').val(value).html(text)
	    );
		$(element_id).val(value);
		
		$(element_id).select2("val", value);
	}
}