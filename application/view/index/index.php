<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Crowd Writing--<?php echo $this->values["domain"]; ?></title>
  <link href="stylesheets/app.css" rel="stylesheet" type="text/css"> 
  <link href="stylesheets/font-awesome.css" rel="stylesheet" type="text/css"> 
  <script src="javascripts/vendor/custom.modernizr.js"></script>
  <script>
  var require = { baseUrl : "javascripts", deps : [ "main"] };
  var viewerMode = false;
  </script>
  <script src="javascripts/lib/require.js"></script>
  <style>
  #wmd-preview{
    padding: 19px;
    overflow: auto;
  }
  </style>
</head>
<body>
  <?php echo  "<!-- Part Template: nav -->\n";?><nav class="top-bar">
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <h1><a href="#"><img  class='logo' src='/img/logo.png'></a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>
    <section class="top-bar-section">
      <ul class="left">
        <li><a href="/" class='active'><span><i class="icon-pencil"></i> Write</span></a></li>
        <li class="split"></li>
        <li><a href="browse"><span>Browse</span></a></li>
        <li class="split"></li>
        <li><a href="explore"><span>Explore</span></a></li>
        <li class="split"></li>
        <li><a href="about"><span>About</span></a></li>
      </ul>
      <ul class="right">
        <li>
          <a class='avatar'>
            <span>Ruly</span>
            <img src='img/avatar.jpg'>
            <span><i class="icon-angle-down"></i></span>
          </a>

          <ul class="action-dropdown">
            <span class="arrow"></span>
            <li class='top'>
              <img src='img/avatar1.jpg'>
              <span class="user-name">Ruly</span>
              <span class="user-email">surgesoft@gmail.com</span>
            </li>
            <li class='normal'><a href='#'><i class="icon-info"></i>Manager Profile</a></li>
            <li class='normal'><a href='#'><i class="icon-envelope"></i>Mail</a></li>
            <li class="split"></li>
            <li class='normal'><a href='#'>Invite someone to CW</a></li>
            <li class="split"></li>
            <li class='normal'><a href='#'><i class="icon-question"></i>Help</a></li>
            <li class="split"></li>
            <li class='normal'><a href='#'><i class="icon-signout"></i>Log Out</a></li>
            <span class="shadow shadow-left"></span>
            <span class="shadow shadow-right"></span>
            <span class="shadow shadow-bottom"></span>
          </ul>
        </li>
        <li>
          <a></a>
        </li>
      </ul>
    </section>
  </nav><?php echo "<!-- Template End  -->\n"; ; ?>
  <div id="wmd-button-bar" style='display:none'></div>
  <section class="main">
    <div class="row">
      <div class="columns large-6">
        <input type="text" value='Untitled Document'>
        <textarea class='editor' id='wmd-input'>
        </textarea>
      </div>
      <div class="columns large-6">
        <div cl ass="preview shadow-box" id='wmd-preview'>
          <div class="inner" id='previewInner'>

          </div>
        </div>
      </div>
    </div>
  </section> 
  <textarea id="md-section-helper" class='editor helper'></textarea>
   <?php echo  "<!-- Part Template: script -->\n";?><script src="javascripts/vendor/jquery.js"> </script>
<script src="javascripts/foundation/foundation.js"></script>
<script src="javascripts/foundation/foundation.alerts.js"></script>
<script src="javascripts/foundation/foundation.clearing.js"></script>
<script src="javascripts/foundation/foundation.cookie.js"></script>
<script src="javascripts/foundation/foundation.dropdown.js"></script>
<script src="javascripts/foundation/foundation.forms.js"></script>
<script src="javascripts/foundation/foundation.joyride.js"></script>
<script src="javascripts/foundation/foundation.magellan.js"></script>
<script src="javascripts/foundation/foundation.orbit.js"></script>
<script src="javascripts/foundation/foundation.placeholder.js"></script>
<script src="javascripts/foundation/foundation.reveal.js"></script>
<script src="javascripts/foundation/foundation.section.js"></script>
<script src="javascripts/foundation/foundation.tooltips.js"></script>
<script src="javascripts/foundation/foundation.topbar.js"></script>
<script src="javascripts/app.js"></script><?php echo "<!-- Template End  -->\n"; ; ?>
</body>
</html>
