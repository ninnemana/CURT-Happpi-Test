
$(function()
{

	$(document).on("change", '#lookup select', function(){
		val = $(this).val();
		if(val.length > 0){
			$('#lookup').submit();
		} // end if
	}); // end of change mount








});