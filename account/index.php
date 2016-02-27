<?php
  include_once('../includes/header.php');
?>

<html>

<head>
  <title>Account Page</title>
  <script>
$(document).ready(function() {
    loadUserData();
});
  </script>
</head>

<body>

<div class="account-settings-container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#profile" aria-controls="profile" data-toggle="tab">Profile</a></li>
    <li><a href="#account" aria-controls="account" data-toggle="tab">Account Settings</a></li>
    <li><a href="#bank" aria-controls="bank" data-toggle="tab">Link Bank Account</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade in active" id="profile">
      <div class="well well-lg"><h2>Change Profile Settings</h2>
        <form class="account-settings" data-toggle="validator">
          <p>Here you can change your profile information, such as your display name, and you can tweak available customization options.</p>
          <div class="input-group">
          <input class="form-control" name="uname" placeholder="Enter your desired username" type="text">
          <span class="input-group-btn"><button class="btn btn-success" type="button">Submit</button></span>
          </div>
        </form>
      </div>
    </div>
    <div class="tab-pane fade" id="account">
      <div class="well well-lg"><h2>Change Account Settings</h2>
        <form class="account-settings" data-toggle="validator">
          <p>Here you can change account settings, such as your account&apos;s associated email and password.</p>
          <div class="input-group">
          <input class="form-control" name="email" placeholder="Enter your replacement email" type="text">
          <span class="input-group-btn"><button class="btn btn-success" type="button">Submit</button></span>
          </div>
<br><br>
          <div class="input-group">
          <input class="form-control" name="pw" placeholder="Enter your new password" type="password">
          <input class="form-control" name="pwconfirm" placeholder="Confirm your new password" type="password">
          <span class="input-group-btn"><button style="height:120%" class="btn btn-success" type="button">Submit</button></span>
          </div>
        </form>
      </div>
    </div>
    <div class="tab-pane fade" id="bank">
      <div class="well well-lg" id="loadUserDataContainer">
        
      </div>
    </div>
  </div>
</div>
</body>

</html>