function loadUserData() {
    $.ajax({
	type: "POST",
	url: "/includes/bank/cust.php",
	data: {todo: 'getAccount'},
	success: function(data) {
	    if (data != 'No account on record' && data != 'Invalid ID') {
		data = JSON.parse(data);
		alert(data);
	    } else {
		toWrite = '<h2>Add Bank Information</h2>';
		toWrite += '<form class="account-settings" data-toggle="validator"><p>Here you can synchronize your bank account information for a seamless shopping experience.</p><div class="input-group">';
		toWrite += '<input class="form-control" name="saddress" placeholder="Enter your street number" type="text">';
		toWrite += '<input class="form-control" name="sname" placeholder="Enter your street name" type="text">';
		toWrite += '<input class="form-control" name="city" placeholder="Enter your city name" type="text">';
		toWrite += '<input class="form-control" name="zip" placeholder="Enter your zip code" type="text">';
		toWrite += '<button class="btn btn-success" onclick="submitUserData()" type="button">Submit</button></div></form>';
		$('#loadUserDataContainer').html(toWrite);
	    }
	}});
}

function submitUserData() {
    
}
