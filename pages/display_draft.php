<h3></h3>

<?php
    if(isset($_GET['draft'])){
        $id_song = $_GET['draft'];
        $query = get_draft_by_id($id_song);
        print "<div id=\"titlu\" style=\"clear:both\">";
?>
    <div class="autoscroll-fixed" style="float:left;clear:both;margin-top:10px;margin-left:900px" id="autoscrolId">
        <button id="autoscroll" class="btn btn-default autoScrollClass" value="Autoscroll reset" onclick="pageScroll(0)">Autoscroll reset</button>
        </br>
        <button class="btn btn-default autoScrollClass" id="autoscroll_1" value="1" onclick="pageScrollVeryLow()">1</button>
        <button class="btn btn-default autoScrollClass" id="autoscroll_2" value="2" onclick="pageScrollLow()">2</button>
        <button class="btn btn-default autoScrollClass" id="autoscroll_3" value="3" onclick="pageScrollNormal()">3</button>
        <button class="btn btn-default autoScrollClass" id="autoscroll_4" value="4" onclick="pageScrollHigh()">4</button>
        <button class="btn btn-default autoScrollClass" id="autoscroll_5" value="5" onclick="pageScrollVeryHigh()">5</button>
    </div>


<?php
        print "<h2>".$query['titlu']." - ".$query['artist']."</h2></div>";
?>
<?php
        print "Contribuitor: " . "<a href=\"index.php?user_uploads=1&username=" . $query['uploader']. "\">" . $query['uploader'] . "</a>";
        $user_logged_in = $_SESSION['user'][1];

        if ($user_logged_in === $query['uploader']) {
            $user_href = "index.php?user_uploads=1&username=" . $user_logged_in;
?>
            <button class=draftViewButton type=button onclick="button_erase_draft();">Șterge draft</button>
            <script>
                function button_erase_draft() {
                    var ajaxurl = 'pages/remove_draft.php';
                    data =  {'id_draft' : <?php echo $id_song;?>, 'cale_draft' : "<?php echo $query['cale'];?>"};
                    console.log(data);
                    $.post(ajaxurl, data, function (response) {
                        console.log("i'm back");
                        // Response div goes here.
                    });
                    location.href = "<?php echo $user_href?>";
                }
            </script>
            <br/>
<?php
        }
        $filename = $query['cale'];
        if($filename) {
            $f1 = fopen($filename, "r");
            if($f1) {
                $contents = fread($f1, filesize($query['cale']));
?>

<!--style="padding-left:20px;padding-top:10px;padding-bottom:15px"-->
<div class="row">
	<br>
	<br>

	<div class="col-sm-1">
	</div>

	<div class="col-sm-1">

		<br>
	    <input type="image" id="up" src="images/up.png" style="height:25px;width:25px;margin:7px;" onclick="transpose(1)"><br>
		<input type="image" id="down" src="images/down.png" style="height:25px;width:25px;margin:7px;" onclick="transpose(2)">
	</div>

	<div class="display-song col-sm-8" id="text">
		<script>
			var tab = <?php echo json_encode($contents); ?>;
			to_update = "<pre>";
			lines = tab.split("\n");
			for (x = 0; x < lines.length; x++) {
				sublines = lines[x].split('$');
					for (y = 0; y < sublines.length; y++) {
						word = sublines[y];
						if (word) {
							if (word[0].localeCompare('[') == 0) {
								chord_first = word.substring(1, word.indexOf(']'));
								chord_last = word.substring(word.indexOf(']') + 1, word.length);
								to_update += (chord_first + chord_last);
							} else {
								to_update += word;
							}
							to_update += " ";
						}
					}
					to_update += "\r\n";
			}
			to_update += "</pre>";
			document.write(to_update);
		</script>
	</div>



</div>

<?php
                $r2 = fclose($f1);
            }
        }
    }
?>

<script>
	var up = {"C" : "C#", "C#" : "D", "Db" : "D", "D" : "D#", "D#" : "E", "Eb" : "E", "E" : "F", "F" : "F#", "F#" : "G", "Gb" : "G", "G" : "G#", "G#" : "A", "Ab" : "A", "A" : "A#", "A#" : "B", "Bb" : "B", "B" : "C"};
	var down = {"C" : "B", "B" : "A#", "A#" : "A", "Bb" : "A", "A" : "G#", "G#" : "G", "Ab" : "G", "G" : "F#", "F#" : "F", "Gb" : "F", "F" : "E", "E" : "D#", "D#" : "D", "Eb" : "D", "D" : "C#", "C#" : "C", "Db" : "C"};
	count = 0;

	var tab = <?php echo json_encode($contents); ?>;

	scrolldelay = 0;

	function pageScroll() {
		clearInterval(scrolldelay);
	}

	function pageScrollVeryLow() {
		clearInterval(scrolldelay);
		window.scrollBy(0, 1);
		scrolldelay = setTimeout(pageScrollVeryLow, 110);
	}

	function pageScrollLow() {
		clearInterval(scrolldelay);
		window.scrollBy(0, 1);
		scrolldelay = setTimeout(pageScrollLow, 95);
	}

	function pageScrollNormal() {
		clearInterval(scrolldelay);
		window.scrollBy(0, 1);
		scrolldelay = setTimeout(pageScrollNormal, 80);
	}

	function pageScrollHigh() {
		clearInterval(scrolldelay);
		window.scrollBy(0, 1);
		scrolldelay = setTimeout(pageScrollHigh, 65);
	}

	function pageScrollVeryHigh() {
		clearInterval(scrolldelay);
		window.scrollBy(0, 1);
		scrolldelay = setTimeout(pageScrollVeryHigh, 50);
	}

	function transpose(mode) {
		if (mode == 1)
			count++;
		else
			count--;
		to_update = "<pre>";
		lines = tab.split("\n");
		for (x = 0; x < lines.length; x++) {
				sublines = lines[x].split('$');
				for (y = 0; y < sublines.length; y++) {
					word = sublines[y];
					if (word) {
						if (word[0].localeCompare('[') == 0) {
							chord_first = word.substring(1, word.indexOf(']'));
							chord_last = word.substring(word.indexOf(']') + 1, word.length);
							chord_first_updated = chord_first;
							if (count > 0) {
								for (k = 0; k < count; k++)
									chord_first_updated = up[chord_first_updated];
							} else if (count < 0) {
								for (k = 0; k < -count; k++)
									chord_first_updated = down[chord_first_updated];
							}
							to_update += (chord_first_updated + chord_last);
						} else {
							to_update += word;
						}
						to_update += " ";
					}
				}
				to_update += "\r\n";
		}
		to_update += "</pre>";
		document.getElementById('text').innerHTML = to_update;
	};
</script>
