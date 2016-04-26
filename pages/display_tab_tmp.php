<h3></h3>

<?php
    $username = $_SESSION['user'][1];
    if (!($username == '') && is_user_admin($username)) {
        if (isset($_GET['tmp-song'])){
            $id_song = $_GET['tmp-song'];
            $query = get_tmp_song_by_id($id_song);
?>
        	<div class="autoscroll-fixed" style="margin-left:900px;margin-top:10px" id="autoscrolId">
        		<button id="autoscroll" class="btn btn-default autoScrollClass" value="Autoscroll reset" onclick="pageScroll(0)">Autoscroll reset</button>
        		</br>
        		<button class="btn btn-default autoScrollClass" id="autoscroll_1" value="1" onclick="pageScrollVeryLow()">1</button>
        		<button class="btn btn-default autoScrollClass" id="autoscroll_2" value="2" onclick="pageScrollLow()">2</button>
        		<button class="btn btn-default autoScrollClass" id="autoscroll_3" value="3" onclick="pageScrollNormal()">3</button>
        		<button class="btn btn-default autoScrollClass" id="autoscroll_4" value="4" onclick="pageScrollHigh()">4</button>
        		<button class="btn btn-default autoScrollClass" id="autoscroll_5" value="5" onclick="pageScrollVeryHigh()">5</button>
        	</div>
<?php
            print "<h2>".$query['titlu'] . " - " . "<a class=\"astext\" href=\"index.php?artist=" . $query['artist'] . "\">" . $query['artist'] . "</a>" . "</h2>";
            print "Contribuitor: " . "<a href=\"index.php?user_uploads=1&username=" . $query['uploader']. "\">" . $query['uploader'] . "</a>";
            print "<br/>";

            $filename = $query['cale_tmp'];
            if($filename) {
                $f1 = fopen($filename, "r");
                if($f1) {
                    $contents = fread($f1, filesize($query['cale_tmp']));
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

print "<form class=\"form-horizontal\" role=\"form\" id=\"contact-form\" action=\"index.php?user_uploads=1&username=" . $username . "\">";
?>
    <div class="form-group" style="margin-bottom:0px">
        <div class="col-sm-offset-3 col-sm-5" style="padding-left:50px">
            <textarea class="form-control" rows="3" id="message" name="text" placeholder="Mesajul catre contribuitor..."></textarea>
        </div>
        <br><br><br><br>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-2" style="padding-left:35px">
            <button id="accept" type="submit" class="btn btn-primary tmp_button" name="accept" value="accept" onclick="return false;">Accept</button>
          </div>
          <div class="col-sm-4" style="padding-left:35px">
            <button id="decline" type="submit" class="btn btn-danger  tmp_button" name="decline" value="decline" onclick="return false;">Refuz</button>
          </div>
        </div>
    </div>
</form>

<div id="succes_message" class='alert alert-info' style='font-size:19px;width:300px;margin-left:320px;margin-top:0px;display:none;'>Operația a fost realizată cu succes!</div>

<?php
} else {
    print "<div class='alert alert-info' style='font-size:19px;width:420px;margin-left:260px;margin-top:0px'>Pentru a putea valida acorduri trebuie să fii admin.</div>";
}
?>

<script>
    $(document).ready(function(){
        $('.tmp_button').click(function(){
            var clickBtnValue = $(this).val();
            var ajaxurl = 'pages/accept_decline_tmp_tab.php';
            var cale_tmp = <?php echo "\"" . $query['cale_tmp'] . "\"";?>;
            var cale = "tab_uploads" + cale_tmp.substring("tmp_upload".length);
            data =  {'action': clickBtnValue, 'id_song' : <?php echo $id_song;?>, 'cale_tmp' : cale_tmp, 'cale' : cale};
            console.log(data);
            $.post(ajaxurl, data, function (response) {
                console.log("i'm back");
                $("#succes_message").show();
    		    window.scrollTo(0,document.body.scrollHeight);

                // Response div goes here.
            });
        });
    });

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
