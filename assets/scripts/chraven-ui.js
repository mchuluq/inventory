$(document).ready(function(){	
	$.ajaxSetup({
	  timeout: 10000,
	  cache: false,
		error:function(x,e){
			if(x.status==0){
			alert('You are offline!\nplease check your connection!');
			}else if(x.status==404){
			alert('URL Requested was not found!');
			}else if(x.status==500){
			alert('Internal Server Error!');
			}else if(e=='parsererror'){
			alert('Error.\nParsing JSON Request failed!');
			}else if(e=='timeout'){
			alert('Request Time out!');
			}else {
			alert('Error unknown: \n'+x.responseText);
			}
		}
	});	
	$('#chraven-loader').ajaxStart(function(){
		$(this).fadeIn();
	}).ajaxStop(function(){
		$(this).fadeOut();
	});

	
	$('#chraven-alert-container .chv-alert .closer').click(function(){
		$(this).parent().hide('blind');
	});
});
function alertSuccess(text)
{
	$('.chv-alert success').show('blind');
}