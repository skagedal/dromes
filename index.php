<html>
<head>
<script type="text/javascript">
<!--
	// Snipped from http://www.bytemycode.com/snippets/snippet/400/
	String.prototype.reverse = function(){
		splitext = this.split("");
		revertext = splitext.reverse();
		reversed = revertext.join("");
		return reversed;
    }

	function strip(s) {
		var re = /\w/g;
		var resultString = "";
		var resultIndexes = [];
		var match;
		while (match = re.exec(s)) {
			resultString += match[0];
			resultIndexes += [match.index];
		}
		return [resultString, resultIndexes];
	}   

	// This is the core. Returns a string that is the reverse of the "letter" characters from src,
	// with the whitespace/punctuation from dest. 
	function palReverse(src, dest) {
		var srcStripped = strip(src);
		var destStripped = strip(dest);   	
		/* CODE GOES HERE */
		return srcStripped[0].reverse();
	}

	function updatePal(src, dest) {
		var srcObj = document.getElementById(src);
		var destObj = document.getElementById(dest);
		destObj.value = palReverse(srcObj.value, destObj.value); 
	}
 // -->
</script>
</head>
<body>
<!-- Catching these three events seems to work; influenced by http://onnoz.home.xs4all.nl/maanrag/sater.html -->
<textarea rows="3" cols="50" id="pal1" 
	  onblur  = 'updatePal("pal1", "pal2");' 
	  onclick = 'updatePal("pal1", "pal2");' 
	  onkeyup = 'updatePal("pal1", "pal2");' ></textarea><br />
<textarea rows="3" cols="50" id="pal2" 
	  onblur  = 'updatePal("pal2", "pal1");'
	  onclick = 'updatePal("pal2", "pal1");'
	  onkeyup = 'updatePal("pal2", "pal1");' ></textarea><br />

<button onClick='helloWorld();'>FOO</button>
</body>
</html>
