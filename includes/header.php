<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/default.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/login.js"></script>
    <script type="text/javascript" src="/js/validateEmail.js"></script>
  </head>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/home">Auto Order</a>
    </div>
    
    <div class="collapse navbar-collapse" id="navbar">
      <ol class="nav navbar-nav">
<?php
  if ($_COOKIE["loggedIn"] == false) {
      echo '</ol><form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" id="userBox" class="form-control" placeholder="Username">
              <input type="password" id="passBox" class="form-control" placeholder="Password">
           </div>
           <button type="button" id="loginButton" class="btn btn-info">Log in</button>
           </form>
           <p class="noAccountText">Don\'t have an account? Click <a class="noAccountLink" data-toggle="modal" data-target="#accountModal" onclick="requestAccount()">here</a> to create one!</p>
         </div>
        </div>
      </nav>
    <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="accountModalLabel">Create Account</h4>
          </div>
        <center>
          <div id="account-modal-alert"></div>
          <div id="account-modal-body" class="account-modal-body">
          </div>
        </center>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="createAccountButton">Create Account</button>
        </div>
      </div>
    </div>';
} else {
      echo '        <li><a href="/pizza">Pizza</a></li>
	<li><a href="/sandwich">Sandwich</a></li>
<ul class="nav navbar-nav navbar-right">';
      echo '<li class="dropdown"><a href="#" class="accountInfo dropdown-toggle" id="accountInfoDropdown" data-toggle="dropdown">' . $_COOKIE["user"] . '<span class="caret"></span></a>
<ul class="dropdown-menu accountInfoDropdown dropdown-menu-right" aria-labelledby="accountInfoDropdown">
  <li class="dropdown-header">Account Info</li>
  <li class="divider"></li>
  <a href="/account"><li class="accountInfoOption">Settings</li></a>
  <li class="accountInfoOption" onclick="logout()">Logout</li>
</ul></li>';
}
echo '</ul></div></div></nav>';
?>
      </ol>
</div>
</div>

<div id="generalAlertArea"></div>

</html>