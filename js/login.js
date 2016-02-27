function requestAccount() {
    var form = '<p>Please fill out the following form in order to create an account.  This account is necessary to use our services so that you can keep track of past orders and retain your banking information.</p>';

    //Username box
    form += '<form role="form" id="accountCreateForm" data-toggle="validator"><div class="input-group form-group" id="unameErr"><span class="input-group-addon" id="basic-addon">Username</span><input id="unameCheck" type="text" class="form-control" name="uname" placeholder="Username" aria-describedby="basic-addon" required></div></div>';

    //First Name box
    form += '<div class="input-group form-group" id="fnameErr"><span class="input-group-addon" id="basic-addon">First Name</span><input id="fnameCheck" type="text" class="form-control" name="fname" placeholder="First Name" aria-describedby="basic-addon"></div>';

    //Last Name box
    form += '<div class="input-group form-group" id="lnameErr"><span class="input-group-addon" id="basic-addon">Last Name</span><input id="lnameCheck" type="text" class="form-control" name="lname" placeholder="Last Name" aria-describedby="basic-addon"></div>';

    //Email box
    form += '<div class="input-group form-group" id="emailErr"><span class="input-group-addon" id="basic-addon">Email</span><input id="emailCheck" type="email" class="form-control" name="email" placeholder="Email" aria-describedby="basic-addon"></div>';

    //Password box
    form += '<div class="input-group form-group" id="pwErr"><span class="input-group-addon" id="basic-addon">Password</span><input id="pwCheck" type="password" class="form-control" name="pw" placeholder="Password" aria-describedby="basic-addon"></div>';

    //Password Confirmation box
    form += '<div class="input-group form-group" id="pwconfirmErr"><span class="input-group-addon" id="basic-addon">Confirm Password</span><input id="pwconfirmCheck" type="password" class="form-control" name="pwconfirm" placeholder="Confirm password" aria-describedby="basic-addon"></div>';

document.getElementById("account-modal-body").innerHTML = form;

}

$(document).ready(function() {
    $( '#userbox, #passBox' ).keypress(function(e) {
	if (e.which == 13) {
	    $( '#loginButton' ).click();
	}
	e.stopPropagation();
    });

    $( '#loginButton' ).on('click', function() {
	$.ajax({
	    type: "POST",
	    url:"/includes/loginRequest.php",
	    data: {
		user: $('#userBox').val(),
		pass: $('#passBox').val()
	    },
	    success: function(data) {
		var message = '';
		if (data == 0) {
		    message += '<div class="alert alert-incorrect alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Username or password incorrect, please try again.</div>';
		} else if (data == 1) {
		    message += '<div class="alert alert-incorrect alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Your account has not yet been verified.  Please check your email or contact the <a href="mailto:james@jamesnc.me">webhost</a> directly.</div>';
		} else if (data == 2) {
		    message += '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Login successful!</div>';
		    setTimeout(function(){ window.location.href="http://ao.jamescorsi.com"; }, 2000);
		}
		$('#generalAlertArea').html(message);
	    }
	});
    });
});

$(document).ready(function() {
    $( '#createAccountButton' ).on('click', function() {
	var valid = Boolean(isValid());

	var message = '';

	if (valid) {
	    $.ajax({
		type: "POST",
		url:"/includes/register.php",
		data: {
		    user: $(' #unameCheck ').val(),
		    fname: $(' #fnameCheck ').val(),
		    lname: $(' #lnameCheck ').val(),
		    email: $(' #emailCheck ').val(),
		    pass: $(' #pwCheck ').val()
		    },
		success: function(data) {
		    message += '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' + data + '</div>';
		    $('#accountModal').modal('hide');
		    $('#generalAlertArea').html(message);
		    setTimeout(function(){ window.location.href="http://ao.jamescorsi.com"; }, 10000);
		},
		error: function() {
		    message += '<div class="alert alert-incorrect alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>An unexpected error has occurred; please try again or contact the <a href="mailto:james@jamesnc.me">webhost</a> if the problem persists.</div>';
		    console.log(data);
		    $('#generalAlertArea').html(message);
		}


	    });
	} 
    });
});

$(document).on('input', 'input', function() {
    
    switch (this.id) {
	case 'unameCheck':
	case 'fnameCheck':
	case 'lnameCheck':
	var lengthCheck = !(this.value.length < 2 || this.value.length > 30);
	$(this).parent().toggleClass('has-success', lengthCheck);
	$(this).parent().toggleClass('has-error', !lengthCheck);
	break;
	case 'emailCheck':
	var emailRegex = new RegExp('^[^@]+@[^@]+\.[^@]+$');
	var emailCheck = emailRegex.test(this.value);
	$(this).parent().toggleClass('has-success', emailCheck);
	$(this).parent().toggleClass('has-error', !emailCheck);
	break;
	case 'pwCheck':
	var lengthCheck = !(this.value.length < 8)
	$(this).parent().toggleClass('has-success', lengthCheck);
	$(this).parent().toggleClass('has-error', !lengthCheck);
	break;
	case 'pwconfirmCheck':
	var pwconfirmed = ($('#pwCheck').val() == $('#pwconfirmCheck').val());
	$(this).parent().toggleClass('has-success', pwconfirmed);
	$(this).parent().toggleClass('has-error', !pwconfirmed);
	break;
    }
});

function unameExists() {
    
    var taken = false;

    $.ajax({
	type: "GET",
	async: false,
	url: "/includes/users.php",
	success: function(data) {
	    var users = JSON.parse(data);
	    for (var i = 0; i < users.length; i++) {
		var uname = JSON.parse(users[i]);
		var dbuname = new String(uname['uname']).toLowerCase();
		var subuname = new String($('#unameCheck').val()).toLowerCase();
		if (dbuname === subuname) {
		    taken = true;
		}
	    }
	}});
    
    return taken;
}

function emailExists() {

    
    var taken = false;

    $.ajax({
	type: "GET",
	async: false,
	url: "/includes/users.php",
	success: function(data) {
	    var users = JSON.parse(data);
	    for (var i = 0; i < users.length; i++) {
		var uname = JSON.parse(users[i]);
		var dbuname = new String(uname['email']).toLowerCase();
		var subuname = new String($('#emailCheck').val()).toLowerCase();
		if (dbuname === subuname) {
		    taken = true;
		}
	    }
	}});
    
    return taken;
    
}

function isValid() {
    var alert = "";
    $('#accountCreateForm>div.has-error').removeClass("has-error");
    
    var confirm = true;
 
    
    if (unameExists()) {
	alert += '<div class="alert alert-danger">Sorry, this username is already taken.</div>';
	$('#unameErr').addClass('has-error');
	confirm = false;
    } else 
	$('#unameErr').addClass('has-success');
    if (emailExists()) {
	alert += '<div class="alert alert-danger">Sorry, this email is already registered with an account.</div>';
	$('#emailErr').addClass('has-error');
	confirm = false;
    } else
	$('#emailErr').addClass('has-success');
    if ($( '#fnameCheck' ).val().length < 2) {
	$('#fnameErr').addClass('has-error');
	alert += '<div class="alert alert-danger">Please enter a valid first name</div>';
	confirm = false;
    } else
	$('#fnameErr').addClass('has-success');
    if ($( '#lnameCheck' ).val().length < 2) {
	$('#lnameErr').addClass('has-error');
	alert += '<div class="alert alert-danger">Please enter a valid last name</div>';
	confirm = false;
    } else
	$('#lnameErr').addClass('has-success');
    if ($( '#pwCheck' ).val().length < 8) {
	$('#pwErr').addClass('has-error');
	alert += '<div class="alert alert-danger">Password must be at least eight characters long</div>';
	confirm = false;
    } else if ($( '#pwCheck' ).val() != $( '#pwconfirmCheck' ).val()) {
	$('#pwErr').addClass('has-error');
	$('#pwconfirmErr').addClass('has-error');
	alert += '<div class="alert alert-danger">Password and confirmation don\'t match</div>';
	confirm = false;
    } else 
	$('#pwErr').addClass('has-success');

    $('#account-modal-alert').html(alert);

    return confirm;
}

function logout() {
	$.ajax({
	    type: "GET",
	    url: "/includes/logout.php",
	    async: false
	});
    window.location.reload();
}
