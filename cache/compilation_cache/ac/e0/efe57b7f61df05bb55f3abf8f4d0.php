<?php

/* index/index.phtml */
class __TwigTemplate_ace0efe57b7f61df05bb55f3abf8f4d0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if IE 8]>         <html class=\"no-js lt-ie9\" lang=\"en\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\" lang=\"en\"> <!--<![endif]-->

<head>
  <meta charset=\"utf-8\" />
  <meta name=\"viewport\" content=\"width=device-width\" />
  <title>Crowd Writing--{\$domain}</title>
  <link href=\"stylesheets/app.css\" rel=\"stylesheet\" type=\"text/css\"> 
  <link href=\"stylesheets/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\"> 
  <script src=\"javascripts/vendor/custom.modernizr.js\"></script>
  <script>
  var require = { baseUrl : \"javascripts\", deps : [ \"write\"] };
  var viewerMode = false;
  var Category = '{\$controller}';
  </script>
  <script src=\"javascripts/lib/require.js\"></script>
  <style>
  #wmd-preview{
    padding: 19px;
    overflow: auto;
  }
  </style>
</head>
<body>
  {\$nav}
  <div id=\"wmd-button-bar\" style='display:none'></div>
  <section class=\"main\">
    <div class=\"row editor\">
      <div class=\"columns large-6\">
        <input type=\"text\" value='Untitled Document' id='ChapterTitle'>
        <textarea class='editor' id='wmd-input'>
        </textarea>
      </div>
      <div class=\"columns large-6\">
        <div class=\"preview shadow-box\" id='wmd-preview'>
          <div class=\"inner\" id='previewInner'>

          </div>
        </div>
      </div>
    </div>
  </section> 
  <textarea id=\"md-section-helper\" class='editor helper'></textarea>
  {\$scripts}
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index/index.phtml";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
