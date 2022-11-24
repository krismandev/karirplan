$(document).ready(function(){
	$('#plan_jabfung').change(function(){
		$('#plan_kredit').text($('#plan_jabfung').val())
	})
	
	if ($('#bag_1_a_no_1').val() == "1") {
		$('#bag_1_a_no_2').hide();
	}
})

