function loadPage(object) {
    var cookies = document.cookie.split(';');
    var cookie;
    for (var i = 0; i < cookies.length; i++) {
	cookie = cookies[i].split('=');
	if (cookie[0].trim() == "loggedIn" && cookie[1].trim() == "true") {
	    window.location.href=("http://ao.jamescorsi.com/" + object);
	    return;
	}
    }
    
    $('#accountModal').modal('show');
    requestAccount();
}

function updateUname() {
    var newUname = $('[name="uname"]').val();
    
    $.ajax({
	type: "POST",
	url: "/includes/user.php",
	data: {
	    todo: 'updateUname',
	    uname: newUname
	},
	success: function(data) {
	    if (data == 0) {
		$('#generalAlertArea').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Username updated successfully! Pages will update to reflect this change the next time you log in.</div>');
	    } else {
		$('#generalAlertArea').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' + data + '</div>');
	    }
	}
    });
}

function updateEmail() {
    var newEmail = $('[name="email"]').val();
    
    $.ajax({
	type: "POST",
	url: "/includes/user.php",
	data: {
	    todo: 'updateEmail',
	    email: newEmail
	},
	success: function(data) {
	    if (data == 0) {
		$('#generalAlertArea').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Email updated successfully!</div>');
	    } else {
		$('#generalAlertArea').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' + data + '</div>');
	    }
	}
    });
}

function updatePass() {
    if ($('[name="pw"]').val() == $('[name="pwconfirm"]').val()) {
	$.ajax({
	    type: "POST",
	    url: "/includes/user.php",
	    data: {
		todo: 'updatePass',
		pass: $('[name="pw"]').val()
	    },
	    success: function(data) {
		if (data == 0) {
		    $('#generalAlertArea').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Password updated successfully!</div>');
		} else {
		    $('#generalAlertArea').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' + data + '</div>');		    
		}
	    }
	});
    }
}
