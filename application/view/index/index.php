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
        <textarea class='editor' id='editor'>### Introduction

#### 功能性封装
在web application开发中经常需要对一系列DOM(包括DOM结构，样式和行为)进行封装，比如类似于JQuery插件这样的一种方式。
但这种方式通常不是最好的。因为在DOM树中有一部分功能性片段是需要独立运作的，传统的封装方法并不能保证这些数据和状态不被任意访问和修改。

**功能性封装** 在限制信息流信任的基础上保证程序中的数据和状态的独立性和完整性，用于建立文档之间的职能界限，通过 ** 功能性边界 ** 重新划分各松散耦合的功能单元

#### Shadow DOM

为了从 **根源上** 解决这个问题，Shadow DOM允许一个在文档中已经存在的DOM节点承载(host)一个或多个特殊的DOM节点。这些特殊的DOM节点在渲染时会 **组合** 成一个大的DOM树。这些特殊的DOM节点被成为 Shadow DOM。
下图： 左边是文档中已经存在的DOM树，右边是创建的一个Shadow DOM，Shadow DOM被承载在左边的DOM树的一个节点上。

图1


在渲染的时候，文档中DOM树承载着Shadow DOM的节点的内容被Shadow DOM的内容所替代

图2



#### 一些概念

根据上面的两个示例图，说明一些概念方便后文叙述

* **Shadow DOM**: 图1右边的一系列DOM对象的集合
* **shadow DOM subtrees** ( **Shadow DOM子树** ):  **Shadow DOM** 由多个DOM节点树组成。在渲染时，**Shadow DOM子树** 会把 **shadow host** 的内容替换成 **Shadow DOM子树** 自身的内容进行渲染
* **shadow boundaries** : **Shadow DOM 子树** 之间的封装边界
* **shadow host** : 在文档中承载 **shadow DOM子树** 的节点
* **shadow root** : Shadow DOM 中每一个 **shadow DOM子树** 的根节点
* **insert point** : 为了让 **shadow DOM子树** 和  **shadow host** 的节点组合起来，使用 **insert point** 来指定 **shadow host** 的字节点插入到 **shadow DOM子树** 中的位置
* **distribution** : 将 **shadow host** 的字节点插入到 **shadow DOM子树** 中的 **insert point** ，再用 **shadow DOM子树** 替换掉 **shadow host** 的内容进行渲染，这个过程被成为 **distribution**

#### 插入点的指定

插入点根据DOM选择器进行DOM匹配，比如以下的Shadow  DOM例子

```html
<div>
    <content select="h1.cool">
      <!-- shadow host中所有h1.cool的子元素将显示在这里 -->
    </content>
    <div class="cool">
        <content select=".cool">
             <!-- shadow host中所有除了h1.cool的.cool子元素将显示在这里 -->
        </content>
    </div>
    <div class="stuff">
        <content>
            <!-- shadow host中所有其他剩下的子元素将显示在这里 -->
        </content>
    </div>
</div>
```

#### Shadow DOM封装

Shadow DOM的封装可以看作是两个问题：
* 上边界封装： **shadow root** 和 **shadow host** 之间的监管边界
* 下边界封装： **shadow point** 和 **shadow host** 之间的监管边界

##### 上边界封装
以下作用域规定对所有 **shadow DOM 子树**  生效

* ownerDocument 属性指向此 **shadow DOM** 的 **shadow host**
* 节点和命名元素无法通过 **shadow host** 的DOM选择器或 window取name的方式来访问
* 节点在文档的节点列表、html集合和DOM Element Map中都不出现
* 节点的样式表(在渲染后可见)，不能被 **shadow host**的 CSSOM extensions访问到
* 节点如果有id或者其他命名属性，也不能在 **shadow root** 的文档树中访问
* 节点如果有id或者其他命名属性，可以在同一 **shadow DOM 子树**中访问
* 选择器不能越过 **shadow boundaries** 访问到其他 **shadow DOM 子树** 中

另外，**shadow root** 维护自身子树的选择器。 **shadow root** 节点的.parentNode和.parentElement必须返回null

##### 下边界封装

* distribution 不会影响文档DOM和 **shadow DOM子树** 的状态
* 每个插入点通过条件匹配决定哪一个节点会被distribution到当前的插入点
* distribution本身不会修改distribution的变量
* 在distribution的变量被修改时，distribution本身必须即时修改

一个简单的Shadow DOM例子

```html
<button> greetings!</button>
<script>
var shadow = document.querySelector('button').webkitCreateShadowRoot();
shadow.textContent = "Hello World";
</script>
```

在文档流中出现的仍然是 **shadow host**的内容，而在浏览器上渲染的已经是 **shadow DOM 子树**的内容了

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
