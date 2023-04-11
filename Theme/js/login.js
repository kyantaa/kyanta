function CheckReg() {
    var username = $("#register-form #username").val(),
	    password = $("#register-form #password").val(),
	    confirmpass = $("#register-form #confirm_password").val(),
	    email = $("#register-form #email").val(),
        captcha = $("#register-form #register-verifycode").val();
	if(!username || !password || !confirmpass || !email || !captcha) fx.alertMessage("Lỗi", "Chưa nhập đủ thông tin!", "error");
	else {
		$.post(MAIN_URL + '/ajax', {
			Member_Reg: 1,
			username: username,
			password: password,
			confirmpass: confirmpass,
			email: email,
			captcha: captcha
		}, function (data) {
			data = $.parseJSON(data);
			if(data['status'] != 'done') fx.alertMessage("Lỗi", data['alert'], "error");
			else if(data['status'] == 'done') 
			window.location = MAIN_URL + '/thanh-vien/login/';
			else fx.alertMessage("Lỗi", "Có lỗi xảy ra. Hãy thử lại", "error");
		});
	}
    return false;
};

function CheckLog() {
	var username = $("#login-form #username").val(),
		password = $("#login-form #password").val(),
		remember = $("#login-form #remember:checked").val();
	if(!username || !password) fx.alertMessage("Lỗi", "Chưa nhập đủ thông tin!", "error");
	else {
		$.post(MAIN_URL + '/ajax' , {
			Member_Login: 1,
			username: username,
			password: password,
			remember: remember
		}, function (data) {
			data = $.parseJSON(data);
			if(data['status'] != 'done') 
			fx.alertMessage("Lỗi", data['alert'], "error");
			else if(data['status'] == 'done') 	
		    window.location = PreUrl;
			else fx.alertMessage("Lỗi", "Có lỗi xảy ra. Hãy thử lại", "error");
		});
	}
    return false;
};

function Logout() {
    var d = {
        Member_Logout: 1
    };
    $.post(MAIN_URL + '/ajax', d, function(data) {
        if (data != 1) {
            fx.alertMessage("Lỗi", "Có lỗi xảy ra. Hãy thử lại", "error");
        } else {
            location.reload();
        }
    });
    return false;
}