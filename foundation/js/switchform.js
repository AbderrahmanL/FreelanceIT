$(document).ready(function()
{
	$("#myselect").change(function()
	{
		if($(this).val() == "societe")
		{
			$(".societe").show();
			$("#fname").prop('required',false);
			$("#lname").prop('required',false);
			$("#sname").prop('required',true);
			$("#at").prop('required',true);
			$(".particulier").hide();
		}
		else
		{
			$(".societe").hide();
			$(".particulier").show();
			$("#fname").prop('required',true);
			$("#lname").prop('required',true);
			$("#sname").prop('required',false);
			$("#at").prop('required',false);
		}
	});
	if($("#myselect").val() == "societe")
	{
		$(".societe").show();
		$("#fname").prop('required',false);
		$("#lname").prop('required',false);
		$("#sname").prop('required',true);
		$("#at").prop('required',true);
		$(".particulier").hide();
	}
	else
	{
		$(".societe").hide();
		$(".particulier").show();
		$$("#fname").prop('required',true);
		$("#lname").prop('required',true);
		$("#sname").prop('required',false);
		$("#at").prop('required',false);
	}
});



