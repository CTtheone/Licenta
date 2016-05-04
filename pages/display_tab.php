<h3></h3>

<?php
    if(isset($_GET['song'])){
        $id_song = $_GET['song'];
        $query = get_song_by_id($id_song);
?>
        <div class="autoscroll-fixed autoScrollClass" style="margin-left:900px;margin-top:20px" id="autoscrolId">
            <button id="autoscroll" class="btn btn-default" value="Autoscroll reset" onclick="pageScroll(0)">Autoscroll reset</button>
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

        $filename = $query['cale'];
        if($filename) {
            $f1 = fopen($filename, "r");
            if($f1) {
                $contents = fread($f1, filesize($query['cale']));
?>

<!--style="padding-left:20px;padding-top:10px;padding-bottom:15px"-->
<div class="row">
	<div class="col-sm-2" style="padding-top:10px">
		<div id="plus-like" style="float:left;margin-right:3px;margin-top:5px">
			<?php print $query['plus']; ?>
		</div>
			<?php
				if (isset($_SESSION['user'])) {
					$ret = check_already_like($query, $_SESSION['user'][1]);
					if ($ret == 0) {
				?>
					<div style="float:left;margin-bottom:10px;margin-right:3px">
						<img id="like_blue" src="images/like_albastru.jpg" height="20" width="auto" onclick="like_song()" style="cursor:pointer">
					</div>
				<?php }	else if ($ret == 1) {
				?>
					<div style="float:left;margin-bottom:10px;margin-right:3px">
						<img id="like_blue" src="images/like_albastru.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php } else if ($ret == 2) {
				?>
					<div style="float:left;margin-bottom:10px;margin-right:3px">
						<img id="like_blue" src="images/like_gri.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php
					}
				} else {
				?>
					<div style="float:left;margin-bottom:10px;margin-right:3px">
						<img id="like_blue" src="images/like_albastru.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php
					}
				?>
		<div id="minus-like" style="float:left;margin-right:3px;margin-top:5px">
			<?php print $query['minus']; ?>
		</div>

			<?php
				if (isset($_SESSION['user'])) {
					if ($ret == 0) {
				?>
					<div style="float:left;margin-top:5px;margin-bottom:3px">
						<img id="like_red" src="images/like_rosu.jpg" height="20" width="auto" onclick="unlike_song()" style="cursor:pointer">
					</div>
				<?php } else if ($ret == 1) {
				?>
					<div style="float:left;margin-top:5px;margin-bottom:3px">
						<img id="like_red" src="images/unlike_gri.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php
					} else if ($ret == 2) {
				?>
					<div style="float:left;margin-top:5px;margin-bottom:3px">
						<img id="like_red" src="images/like_rosu.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php }} else {
				?>
					<div style="float:left;margin-top:5px;margin-bottom:3px">
						<img id="like_red" src="images/like_rosu.jpg" height="20" width="auto" onclick="false" style="cursor:pointer">
					</div>
				<?php
					}
				?>
	</div>
</div>

<script>
	function like_song() {
		$("#like_red").attr("src", "images/unlike_gri.jpg");
		$("#like_red").prop("onclick", false);
		$("#like_blue").prop("onclick", false);
		likes = parseInt(document.getElementById('plus-like').innerHTML) + 1;
		document.getElementById('plus-like').innerHTML = likes;
		$.ajax({
			type: 'post',
			url: 'pages/update_likes.php',
			data: {uid: <?php echo $id_song;?>, val: <?php echo $query['plus'] + 1;?>, query: <?php echo json_encode($query);?>, username: <?php echo "\"" . $_SESSION['user'][1] . "\""; ?>}
		});
	}

	function unlike_song() {
		$("#like_blue").attr("src", "images/like_gri.jpg");
		$("#like_red").prop("onclick", false);
		$("#like_blue").prop("onclick", false);
		unlikes = parseInt(document.getElementById('minus-like').innerHTML) + 1;
		document.getElementById('minus-like').innerHTML = unlikes;
		$.ajax({
			type: 'post',
			url: 'pages/update_dislikes.php',
			data: {uid: <?php echo $id_song;?>, val: <?php echo $query['minus'] + 1;?>,  query: <?php echo json_encode($query);?>, username: <?php echo "\"" . $_SESSION['user'][1] . "\""; ?>}
		});
	}
</script>

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

		<div class="display-song col-sm-8" id="text"></div>
	</div>

<?php
  if (isset($_SESSION['user']))
?>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
				</div>

				<div class="transpose_tab col-sm-2">
					</br>
					<a  href="index.php?upload=1?
						<?php
							$titlu = $query['titlu'];
							$artist = $query['artist'];
							$categorie = $query['categorie'];
							$all = "titlu=" . $titlu . "&artist=" . $artist . "&categorie=" . $categorie;
							echo $all;
						?>">
						<input type="button" id="upload_new_version" value="Încarcă o versiune mai bună" class="btn-primary">
					</a>
					</br>
					</br>
				</div>
			</div>
		</div>
<?php

 ?>

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

    transpose(0);

	function transpose(mode) {
		if (mode == 1)
			count++;
		else if (mode == 2)
			     count--;
        to_update = "<pre>";
        lines = tab.split("\n");
        for (x = 0; x < lines.length; x++) {
            sublines = lines[x].split('$');
            if (sublines.length == 1) {
                to_update += sublines[0];
            } else {
                to_update += sublines[0];
                chords = sublines[1].split(" ");
                for (y = 0; y < chords.length; y++) {
                    word = chords[y];
                    if (word == "") {
                        to_update += " ";
                    } else {
                        // determine the chord type (normal, b, #)
                        chord = "";
                        letters_taken = 0;
                        if (word.length == 1) {
                            // sure is a normal chord
                            chord = word;
                            letters_taken = 1;
                        } else {
                            if (word[1] == "b" || word[1] == "#") {
                                // is b or #
                                chord = word.substr(0,1);
                                letters_taken = 2;
                            } else {
                                // is normal
                                chord = word[0];
                                letters_taken = 1;
                            }
                        }
                        // appling the proper modifications on the chord
                        if (count > 0) {
                            for (k = 0; k < count; k++)
								chord = up[chord];
                        } else if (count < 0) {
							for (k = 0; k < -count; k++)
								chord = down[chord];
						}
                        // concaternate with the rest of the chord
                        chord += word.substr(letters_taken, word.length);
                        to_update += chord;
                    }
                }
            }
            to_update += "\r\n";
        }
		to_update += "</pre>";
		document.getElementById('text').innerHTML = to_update;
	};
</script>

<div id="comments_song">

	<?php
		if(!isset($_SESSION['user'])) {
			print "<div class='alert alert-info' style='font-size:18px;width:585px;margin-left:200px;margin-top:10px;margin-bottom:15px'>Pentru a putea vota sau adăuga comentarii, e nevoie să te autentifici.</div>";
		} else {
	?>

  <form id="comment-form" action=<?php echo "index.php?song=".$id_song."&addComm=".$id_song; ?> method="POST">
    <div class="row">
      <div class="form-group col-sm-offset-2 col-sm-8">
      	<label for="comment">Adaugă un comentariu:</label>
        <br>
    		<textarea class="form-control" rows="5" id="comment" placeholder="Comentariul dumneavoastră..." name="textcomm" required></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-offset-5" style="padding-left:45px">
        <button type="submit" class="btn btn-default" value="Trimite" name="submitcomm" id="send_comm">Trimite</button>
      </div>
    </div>
  </form>

	<?php
			if(isset($_POST['submitcomm'])) {
				$new_mesaj = $_POST['textcomm'];
				if($new_mesaj) {
					add_new_comm($_SESSION['user'], $query['comments_path'], $new_mesaj);
                    echo '<script type="text/javascript">'
            		   , 'window.scrollTo(0,document.body.scrollHeight);'
            		   , '</script>'
            		;

				} else
					echo "<h5>Introduceti mesajul!</h5>";
			}
		}
	?>
	<?php
		$comments_file = $query['comments_path'];
		display_comm($comments_file);
	?>
</div>
