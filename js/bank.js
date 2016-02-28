function loadUserData() {
    $.ajax({
	type: "POST",
	url: "/includes/bank/cust.php",
	data: {todo: 'getAccount'},
	success: function(data) {
	    if (data != 'No account on record' && data != 'Invalid ID') {
		data = JSON.parse(data);
		toWrite = '<h2>Current Bank Information<small><a href="#" class="editMode" onclick="editMode()">click here to edit</a></small></h2>';
		toWrite += '<p>Account name on file: ' + data["first_name"] + ' ' + data["last_name"] + '</p>';
		toWrite += '<p>Address on file: ' + data['address']['street_number'] + ' ' + data['address']['street_name'] + ', ' + data['address']['city'] + ', ' + data['address']['state'] + ' ' + data['address']['zip'] + '</p>';

		toWrite += '<p>Unique Customer ID No: ' + data['_id'] + '</p>';
		$('#loadUserDataContainer').html(toWrite);
	    } else {
		toWrite = '<h2>Add Bank Information</h2>';
		toWrite += '<form class="account-settings" data-toggle="validator"><p>Here you can synchronize your bank account information for a seamless shopping experience.</p><div class="input-group">';
		toWrite += '<input class="form-control" name="saddress" placeholder="Enter your street number" type="text">';
		toWrite += '<input class="form-control" name="sname" placeholder="Enter your street name" type="text">';
		toWrite += '<input class="form-control" name="city" placeholder="Enter your city name" type="text">';
		toWrite += '<input class="form-control" name="state" placeholder="Enter your state" type="text">';
		toWrite += '<input class="form-control" name="zip" placeholder="Enter your zip code" type="text">';
		toWrite += '<button class="btn btn-success" onclick="submitUserData(\'create\')" type="button">Submit</button></div></form>';
		$('#loadUserDataContainer').html(toWrite);
	    }
	}
    });
}

function submitUserData(type) {
    var address = [
	$('[name="saddress"]').val(),
	$('[name="sname"]').val(),
	$('[name="city"]').val(),
	$('[name="state"]').val(),
	$('[name="zip"]').val()
	];
    
    for (var i = 0; i < address.length; i++) {
	if (address[i] == "") {
	    $('#generalAlertArea').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Please fill out all portions of your address.</div>');
	    return;
	}
    }

    $.ajax({
	type: "POST",
	url: "/includes/bank/cust.php",
	data: {
	    todo: (type + 'Account'),
	    address: address
	},
	success: function(data) {
	    if (data == 0) {
		$('#generalAlertArea').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>Account ' + type + ' successful!</div>');
	    } else {
		$('#generalAlertArea').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' + data + '</div>');
	    }
	}});

}

function editMode() {
    		toWrite = '<h2>Edit Bank Information<small><a href="#" onclick="loadUserData()" class="editMode">cancel editing</a></small></h2>';
		toWrite += '<form class="account-settings" data-toggle="validator"><p>Please fill out all fields, even those that have not changed.</p><div class="input-group">';
		toWrite += '<input class="form-control" name="saddress" placeholder="Enter your street number" type="text">';
		toWrite += '<input class="form-control" name="sname" placeholder="Enter your street name" type="text">';
		toWrite += '<input class="form-control" name="city" placeholder="Enter your city name" type="text">';
		toWrite += '<input class="form-control" name="state" placeholder="Enter your state" type="text">';
		toWrite += '<input class="form-control" name="zip" placeholder="Enter your zip code" type="text">';
		toWrite += '<button class="btn btn-success" onclick="submitUserData(\'update\')" type="button">Submit</button></div></form>';
		$('#loadUserDataContainer').html(toWrite);

}
