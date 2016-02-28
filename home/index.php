<?php
  include_once('../includes/header.php');
?>

<html>

<title>Auto Order</title>
<head>
</head>
<body>
<div class="carousel slide carousel-fade" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
	<div class="item active">
          <img class="first-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Easy, fast ordering</h1>
              <p>Minimize your ratio of human interaction and effort expended to food acquired</p>
              <p><a class="btn btn-lg btn-primary" href="#" onclick="loadPage('pizza')" role="button">Order today</a></p>
            </div>
          </div>
	</div>
	<div class="item">
          <img class="second-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Doesn't this sandwich look tasty?</h1>
              <p>It would look even tastier in your hands, right this second (Disclaimer: AyO! is not responsible for delays suffered due to non-instantaneous delivery services)</p>
              <p><a class="btn btn-lg btn-primary" href="#" onclick="loadPage('sandwich')" role="button">Succumb to your cravings</a></p>
            </div>
          </div>
	</div>
	<div class="item">
          <img class="third-slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Feeling some Chinese food?</h1>
              <p>Well I sure hope there's a place nearby or else you're S.O.L. buddy</p>
              <p><a class="btn btn-lg btn-primary" href="#" onclick="loadPage('asian')" role="button">Get sum</a></p>
            </div>
          </div>
	</div>
	<div class="item">
	  <img class="fourth-slide">
	  <div class="container">
	    <div class="carousel-caption">
	      <h1>Cookies are a perfect end to any night</h1>
	      <p><a class="btn btn-lg btn-primary" href='#' onclick="loadPage('dessert')" role="button">Survey your selection</a></p>
	    </div>
	  </div>
	</div>
    </div>
</div>

</body>

</html>
