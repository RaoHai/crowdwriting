/*global $, window, document*/
/*
 * JQuery zen-coding
 * e.g.
 * $("div#name")
 *  ==>
 * <div id="name"></div>
 */
String.prototype.Trim = function () {
  return this.replace(/(^\s*)|(\s*$)/g, "");
};

var Zend = (function () {
  var z;
  var token, custom, child, plus, leftBracket, rightBracket, multiplus, index, end;
  var Semantics;
  var semanticsList, curSemantic, domTree;

  domTree = [];
  Semantics = function (semanticType) {
    this.type = semanticType;
    this.tokens = [];
    this.stringing = false;
    this.attrs = {
      dom: [],
      class: [],
      id: []
    };
    this.multiplus = 1;
  };
  Semantics.prototype.getType = function () {
    return this.type;
  };
  Semantics.prototype.setType = function (semanticType) {
    this.type = semanticType;
  };
  Semantics.prototype.add = function (token) {
    this.tokens.push(token);
  };
  Semantics.prototype.customKey = function () {
    var key = this.tokens.join('');
    if (!this.attrs.hasOwnProperty(key)) {
      this.attrs[key] = [];
    }
    this.tokens = [];
    this.type = key;
  };
  Semantics.prototype.startString = function () {
    this.stringing = true;
  };
  Semantics.prototype.endString = function () {
    var type, value, str;
    type = this.type;
    if (this.attrs.hasOwnProperty(type)) {
      str = this.tokens.join('');
      if (str!=='') {
        this.attrs[type].push(str);
      }
    }
    this.stringing = false;
    this.tokens = [];
  };
  Semantics.prototype.isStringing = function () {
    return this.stringing;
  };
  Semantics.prototype.endtokens = function () {
    var type, value;
    type = this.type;
    value = this.tokens.join('');
    if (type === 'multiplus') {
      var number = Number(value.trim());
        if (!isNaN(number) && number > 1) {
          this.multiplus = number;
        }
    }else if (this.attrs.hasOwnProperty(type) && value !== "") {
      this.attrs[type].push(value);
    }
    this.tokens = [];
  };
  Semantics.prototype.toString = function () {
    return this.attrs;
  };
  Semantics.prototype.getMultiplus = function () {
    return this.multiplus;
  };
  Semantics.prototype.create = function () {
    var dom, html, attrs, attr;
    dom = this.attrs.dom[0];
    if (dom === "") {
      dom = "div";
    }
    html = document.createElement(dom);
    attrs = this.attrs;
    for (attr in attrs) {
     if(attrs.hasOwnProperty(attr) && attr !== 'dom' && attr !== 'multiplus' && attrs[attr].length > 0) {
        html.setAttribute(attr, attrs[attr].join(' ').trim());
      }
    }
    return html;
  };
  /*
	var tagDict = {
		'#': 'id',
		'.': 'class',
		'>': child,
		'[': leftBracket,
		']': rightBracket,
		'*': multiplus,
		'$': index,
		'+': plus
	};*/

  z = function (selector) {
    if (typeof selector !== 'string') {
      return;
    }
    return token(selector.trim());
  };
  end = function () {
    var i, j, htmlarr;
    htmlarr = [];
    for (i = 0; i <domTree.length; i++) {
      var times, el;
      el = domTree[i];
      el.endtokens();
      times = el.getMultiplus();
      console.log(times);
      for (var j = 0; j < times; j++) {
        htmlarr.push(el.create());
      }
    }
    if ($) {
      return $(htmlarr);
    }
    return htmlarr;
    //return curSemantic.create();
  };
  token = function (word, index) {
    var t;
    index = index || 0;
    if (index > word.length) {
      return end();
    }
    t = word[index];

    if (!curSemantic) {
      //beginning of word
      var newSemantic = new Semantics('dom');
      domTree.push(newSemantic);
      curSemantic = newSemantic;

    }

    switch (t) {
    case '.':
      curSemantic.endtokens();
      curSemantic.setType('class');
      break;
    case '#':
      curSemantic.endtokens();
      curSemantic.setType('id');
      break;
    case '+':
      curSemantic.endtokens();
      var newSemantic = new Semantics('dom');
      if (!domTree.push) {
        domTree = [curSemantic];
      }
      domTree.push(newSemantic);
      curSemantic = newSemantic;
      break;
    case '*':
      curSemantic.endtokens();
      curSemantic.setType('multiplus');
      break;
    case '[':
      curSemantic.endtokens();
      curSemantic.setType('Custom');
      return custom(word, index + 1);
    default:
      curSemantic.add(t);
    }
    return token(word, index + 1);

  };
  //custom element parser
  //e.g.
  // div[title="hello World"]
  custom = function (word, index) {
    var t;
    index = index || 0;
    if (index > word.length) {
      return end();
    }
    t = word[index];
    if (curSemantic.getType() !== 'Custom') {
      if (t === ']') {
        curSemantic.endtokens();
        return token(word, index + 1);
      }
      switch (t) {
      case '\"':
      case '\'':
        if (curSemantic.isStringing) {
          curSemantic.endString();
        } else {
          curSemantic.startString();
        }
        break;
      case ' ':
        if (!curSemantic.isStringing()) {
          curSemantic.endtokens();
          curSemantic.setType('Custom');
          return custom(word, index + 1); 
        }
        break;
      default:
        curSemantic.add(t);
      }
      return custom(word, index + 1);
    }

    if (t === '=') {
      curSemantic.customKey();
    } else {
      curSemantic.add(t);
    }
    return custom(word, index + 1);

  };


  return z;
})();

window._z = Zend;