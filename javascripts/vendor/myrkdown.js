/*global window*/
/* 
My markdown parser
*/

(function (expose) {
	var Lexer;

	function noop() {
	}
	var block = {
		newline: /^\n+/,
		code: /^( {4}[^\n]+\n*)+/,
		fences: noop,
		hr: /^( *[-*_]){3,} *(?:\n+|$)/,
		heading: /^ *(#{1,6}) *([^\n]+?) *#* *(?:\n+|$)/,
		nptable: noop,
		lheading: /^([^\n]+)\n *(=|-){3,} *\n*/,
		blockquote: /^( *>[^\n]+(\n[^\n]+)*\n*)+/,
		list: /^( *)(bull) [\s\S]+?(?:hr|\n{2,}(?! )(?!\1bull )\n*|\s*$)/,
		html: /^ *(?:comment|closed|closing) *(?:\n{2,}|\s*$)/,
		def: /^ *\[([^\]]+)\]: *<?([^\s>]+)>?(?: +["(]([^\n]+)[")])? *(?:\n+|$)/,
		table: noop,
		paragraph: /^((?:[^\n]+\n?(?!hr|heading|lheading|blockquote|tag|def))+)\n*/,
		text: /^[^\n]+/
	};

	function count_lines(str) {
		var n = 0, i = -1;
		while ((i = str.indexOf("\n", i + 1)) !== -1) {
			n++;
		}
		return n;
	}
	var mk_block = function (block, line) {
		line = line === undefined ? 0 : line;
		var s =  {block : block, lineNumber: line };
		return s;
	};

	var Markdown = expose.Markdown = function (dialect) {

	};

	expose.parser = function (input) {
		var lexer, lines;
		lines = splitLine(input);
		lexer = new Lexer();
		var tokens = lexer.token(lines[0]);
		for (var i = tokens.length - 1; i >= 0; i--) {
			console.log(lexer.toHtml(tokens[i]));
		};
	};

	var splitLine = expose.splitLine = function (input, startLine) {
		input = input.replace(/(\r\n|\n|\r)/g, "\n");
		var re = /([\s\S]+?)($|\n(?:\s*\n|$)+)/g, blocks = [], m;
		var line_no = 1;
		if ((m = /^(\s*\n)/.exec(input)) !== null) {
			line_no += count_lines(m[0]);
			re.lastIndex = m[0].length;
		}

		while ((m = re.exec(input)) !== null) {
			blocks.push(mk_block(m[1], line_no));
			line_no += count_lines(m[0]);
		}
		return blocks;
	};

	Lexer = function (options) {
		this.tokens = [];
		this.tokens.links = {};
		this.rule = block;
	};

	Lexer.prototype.token = function(line, top) {
		var src = line.block;
		src = src.replace(/^ +$/gm, '');
		console.log(src);
		var cap;
		while (src) {
			if (cap = this.rule.heading.exec(src)) {
				src = src.substring(cap[0].length);
      			this.tokens.push({
	        		type: 'heading',
	        		depth: cap[1].length,
	        		text: cap[2],
	        		lineNumber : line.lineNumber
      			});
      			continue;
			} else {
				break;
			}


		}
		console.log(this.tokens);
		return this.tokens;
	};
	Lexer.prototype.inline = function(token) {
		return token;
	};
	Lexer.prototype.toHtml = function(token) {
		console.log('tohtml:' ,token);
		switch (token.type) {
			case 'heading': {
				 return '<h'
				 + token.depth
				 + ' data-lineNumber="'+token.lineNumber + '"'
				 + '>'
				 + this.inline(token.text, token.lineNumber)
				 + '</h'
				 + token.depth
				 + '>\n';
			}
		}
	};

}((function () {
	if (typeof exports === "undefined") {
		window.markdown = {};
		return window.markdown;
	}
	return exports;
}())));
