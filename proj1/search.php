<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>


    <div class="top-bar-container" data-sticky-container>
        <div class="sticky" data-sticky data-options="anchor: page; marginTop: 0; stickyOn: small;">
          <div class="top-bar">
            <div class="row column">
              <div class="top-bar-left">
                <ul class="dropdown menu" data-dropdown-menu>
                  <li class="menu-text">Site Title</li>
                  <li class="has-submenu">
                    <a href="#">One</a>
                    <ul class="submenu menu vertical" data-submenu>
                      <li><a href="#">One</a></li>
                      <li><a href="#">Two</a></li>
                      <li><a href="#">Three</a></li>
                  </ul>
              </li>
              <li><a href="#">Two</a></li>
              <li><a href="#">Three</a></li>
          </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li>
            <input type="search" placeholder="Search">
        </li>
        <li>
            <button type="button" class="button">Search</button>
        </li>
    </ul>
</div>
</div>
</div>
</div>
</div>


<div id="hide_form">

<form id='location'>
    <input name='location' id='city' type='textbox' placeholder='City'>
    <input name='location' id='state' type='textbox' placeholder="State"> 
    <button type='submit' id='sub' placeholder='SUBMIT' value='Submit'> </button>
<!--     <div class="large-12 columns">
    <a href="my_outfit.php" type="submit" name="location" class="button expand large">Submit</a>
    </div> -->

</form>

<!-- <div class="row">
  <div class="small-6 large-centered columns">6 centered</div>
</div> -->
</div>

<div id='results'>
<!-- <p> 'hello' </p> -->
</div>

<div id='divThat'>
<!-- <p> 'hello' </p> -->
</div>

<script>
//maybe make a global results array
</script>
<script src="js/jquery-3.1.1.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="js/script.js"></script>


<?php

// include 'js/script.js.php';


?>



</body>
</html>