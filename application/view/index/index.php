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
        <li><a href="/"><span><i class="icon-pencil"></i> Write</span></a></li>
        <li><a href="browse"><span>Browse</span></a></li>
        <li><a href="explore"><span>Explore</span></a></li>
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
      </ul>
    </section>
  </nav><?php echo "<!-- Template End  -->\n"; ; ?>
  <section class="main">
    <div class="row">
      <div class="columns large-6">
        <input type="text" value='Untitled Document'>
        <textarea class='editor' id='editor'>Dillinger
=========

Dillinger is a cloud-enabled HTML5 Markdown editor.

  - Type some Markdown text in the left window
  - See the HTML in the right
  - Magic

Markdown is a lightweight markup language based on the formatting conventions that people naturally use in email.  As [John Gruber] writes on the [Markdown site] [1]:

> The overriding design goal for Markdown's
> formatting syntax is to make it as readable 
> as possible. The idea is that a
> Markdown-formatted document should be
> publishable as-is, as plain text, without
> looking like it's been marked up with tags
> or formatting instructions.

This text your see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right.  

Version
-

2.0

Tech
-----------

Dillinger uses a number of open source projects to work properly:

* [Ace Editor] - awesome web-based text editor
* [Showdown] - a port of Markdown to JavaScript
* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* [node.js] - evented I/O for the backend
* [Express] - fast node.js network app framework [@tjholowaychuk]
* [keymaster.js] - awesome keyboard handler lib by [@thomasfuchs]
* [jQuery] - duh 

Installation
--------------

```sh
git clone [git-repo-url] dillinger
cd dillinger
npm i -d
mkdir -p public/files/{md,html}
node app
```


License
-

MIT

*Free Software, Fuck Yeah!*

  [john gruber]: http://daringfireball.net/
  [@thomasfuchs]: http://twitter.com/thomasfuchs
  [1]: http://daringfireball.net/projects/markdown/
  [showdown]: https://github.com/coreyti/showdown
  [ace editor]: http://ace.ajax.org
  [node.js]: http://nodejs.org
  [Twitter Bootstrap]: http://twitter.github.com/bootstrap/
  [keymaster.js]: https://github.com/madrobby/keymaster
  [jQuery]: http://jquery.com  
  [@tjholowaychuk]: http://twitter.com/tjholowaychuk
  [express]: http://expressjs.com
  

    </textarea>
      </div>
      <div class="columns large-6">
        <div class="preview shadow-box" id='preview'>
          <div class="inner">
            
          </div>
        </div>
      </div>
    </div>
  </section> 
  <?php echo  "<!-- Part Template: script -->\n";?>  <script src='javascripts/vendor/zepto.js'></script>
  <script src='javascripts/vendor/markdown.js'></script>
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

  <script src='javascripts/app.js'></script><?php echo "<!-- Template End  -->\n"; ; ?>
</body>
</html>
