<html>
<head>
<script src="js/xregexp-min.js"></script>
<script src="js/xregexp-unicode-base.js"></script>
<script src="js/diff_match_patch.js"></script>
<script type="text/javascript">
<!--
	// Snipped from http://www.bytemycode.com/snippets/snippet/400/
	String.prototype.reverse = function(){
		splitext = this.split("");
		revertext = splitext.reverse();
		reversed = revertext.join("");
		return reversed;
    }

	// Strip the string s from all nonletters. We also need to keep track of where the letters came from
	// in the string, so we also return an array with indices.
	function strip(s) {
		// TODO: Use the XRegExp stuff to recognize all Unicode letters
		var re = /\w/g;
		var result = new Object();
		result.str = "";
		result.indices = [];
		var currentIndex = 0;
		var match;
		while (match = re.exec(s)) {
			result.str += match[0];
			result.indices[currentIndex++] = match.index;
		}
		return result;
	}   

	var dmp = new diff_match_patch();
	
	// This is the core. Returns a string that is the reverse of the "letter" characters from src,
	// with the whitespace/punctuation from dest. 
	function palReverse(src, dest) {
		// What needs to be changed in the "dest" text to make it letter equivalent to the 
		// reverse of the text in the "src" text?

		var srcStripped = strip(src);
		var destStripped = strip(dest);   	

		// This helps us handle the situation where stuff is added to the end of dest
		destStripped.indices[destStripped.indices.length] = dest.length;
				
		diff = dmp.diff_main(destStripped.str.toLowerCase(), 
							 srcStripped.str.reverse().toLowerCase());
		var processed = 0;
		var offset = 0;
		console.log("Begin patching.");

		// Go through each diff. 
		for (var i = 0; i < diff.length; i++) {
			console.log("Before this diff: ");
			console.log(diff[i]);
			console.log("we have dest = " + dest);
			
			var operation = diff[i][0];
			var opchars = diff[i][1];
			if (operation == 0) {			// A chunk of unchanged characters
				processed += opchars.length;
			} else if (operation == 1) {	// A chunk of new characters
				index = destStripped.indices[processed] + offset;
				dest = dest.slice(0, index) + opchars + dest.slice(index);
				offset += opchars.length;
			} else if (operation == -1)	{	// A chunk of removed characters
				for (var j = 0; j < opchars.length; j++) {
					index = destStripped.indices[processed] + offset;
					dest = dest.slice(0, index) + dest.slice(index + 1);
					offset--;
					processed++;
				}
			}

		}
		console.log("Afterwards we have dest = " + dest);
		return dest;
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
