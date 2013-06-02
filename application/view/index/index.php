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
        <textarea class='editor' id='editor'>
* **Shadow DOM**: 图1右边的一系列DOM对象的集合
* **shadow DOM subtrees** ( **Shadow DOM子树** ):  **Shadow DOM** 由多个DOM节点树组成。在渲染时，**Shadow DOM子树** 会把 **shadow host** 的内容替换成 **Shadow DOM子树** 自身的内容进行渲染
* **shadow boundaries** : **Shadow DOM 子树** 之间的封装边界
* **shadow host** : 在文档中承载 **shadow DOM子树** 的节点
* **shadow root** : Shadow DOM 中每一个 **shadow DOM子树** 的根节点
* **insert point** : 为了让 **shadow DOM子树** 和  **shadow host** 的节点组合起来，使用 **insert point** 来指定 **shadow host** 的字节点插入到 **shadow DOM子树** 中的位置
* **distribution** : 将 **shadow host** 的字节点插入到 **shadow DOM子树** 中的 **insert point** ，再用 **shadow DOM子树** 替换掉 **shadow host** 的内容进行渲染，这个过程被成为 **distribution**

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
  <script src='javascripts/vendor/myrkdown.js'></script>
  <?php echo  "<!-- Part Template: script -->\n";?>  <script src='javascripts/vendor/zepto.js'></script>
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
