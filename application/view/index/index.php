<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $this->values["title"]; ?>-<?php echo $this->values["domain"]; ?></title>
  <!--<link href="css/reset.css" rel="stylesheet" type="text/css"> -->
  <!-- <script src='/js/html5.js'></script> -->
</head>
<body>
   <textarea id="text-input" oninput="this.editor.update()"
              rows="6" cols="60">Type **Markdown** here.</textarea>
    <div id="preview"> </div>
    <button>SUBMIT!</button>
    <script src="/js/markdown.js"></script>
    <script>
      function Editor(input, preview) {
        this.update = function () {
          preview.innerHTML = markdown.toHTML(input.value);
        };
        input.editor = this;
        this.update();
      }
      var $ = function (id) { return document.getElementById(id); };
      new Editor($("text-input"), $("preview"));
    </script>
</body>
</html>
