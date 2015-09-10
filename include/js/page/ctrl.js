function loginEven(){
	var parm = $("#loginInfo").serialize();
	//console.log(parm);
	$.ajax({
		url: 'login',
		data: parm,
		type:"POST",
		async: false,
		success: function(rs){
			console.log(rs);
			var result = $.parseJSON(rs);
			if(result.status){
				//location.href = './';
			}else{
				
			}
		}
	});
}
function logoutEven(){
	$.ajax({
		url: 'login/logout',
		type:"POST",
		async: false,
		success: function(rs){
			location.href = './';
		}
	});
}