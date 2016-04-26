<div class="row">
	<div class="col-sm-offset-4 col-sm-4"><h3>Încarcă acorduri</h3><br></div>
</div>

<form class="form-horizontal" role="form" id="contact-form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-3" for="artist">Artist:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="artist" placeholder="Artist" name="artist" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-3" for="titlu">Titlul piesei:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="titlu" placeholder="Titlu" name="titlu" required>
    </div>
  </div>

  <div class="form-group">
	  <label class="control-label col-sm-3" for="sel1">Categorie:</label>
	  <div class="col-sm-3">
		  <select class="form-control" id="sel1" name="categorie" onchange="check()">
			<option value="0">Selectare categorie:</option>
			<?php
				connectDB();
				$sql = mysql_query("SELECT DISTINCT categorie FROM melodii WHERE cale is not null ORDER BY categorie ASC");
				while ($row = mysql_fetch_array($sql)){
					echo "<option value=\"" . $row['categorie'] . "\">" . $row['categorie'] . "</option>";
				}
			?>
		  </select>
	  </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-3" for="sel2">Altă categorie:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="sel2" placeholder="Categorie" name="altaCategorie" onchange="check()">
    </div>
  </div>

    <div class="form-group">
		<div class="col-sm-offset-3 col-sm-6">
			<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo">Upload Hint!</button>

			<div id="demo" class="collapse" style="margin-top:5px">
				Pentru ca tabulatura să poată fi transpusă pe site, este necesară formatarea acordurilor conform exemplului:<br><br>
				$[C] &nbsp; $[F#] &nbsp; $[G]m &nbsp; $[B]5 &nbsp; $[Ab]7 <br>
			</div>
		</div>
	</div>

  <div class="form-group">
	<label class="control-label col-sm-3" for="comment">Text:</label>
	<div class="col-sm-6">
		<textarea class="form-control" rows="20" id="comment" name="text" required></textarea>
	</div>
  </div>

  <div class="form-group">
	  <div class="col-sm-offset-3 col-sm-6">
		  <div class="checkbox">
			  <label><input type="checkbox" value="" id="checkbox_comunitate" name="checkbox_comunitate" onchange="check_checkbox()">Încarcă acord în comunitate</label>
		  </div>
	  </div>
	  <div class="col-sm-offset-3 col-sm-6">
		  <div class="checkbox">
			  <label><input type="checkbox" value="" id="checkbox_draft" name="checkbox_draft" onchange="check_checkbox()">Încarcă acord draft</label>
		  </div>
	  </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-4">
      <button id="btn_incarca" type="submit" class="btn btn-default" name="upload">Încarcă</button>
    </div>
  </div>
</form>

<script>
	var titlu = (location.search.split('titlu=')[1]).split('&')[0];
	var artist = (location.search.split('artist=')[1]).split('&')[0];
	var categorie = (location.search.split('categorie=')[1]).split('&')[0];
	if (titlu) {
		document.getElementById('titlu').value = decodeURI(titlu);
	}
	if (artist) {
		document.getElementById('artist').value = decodeURI(artist);
	}
	if (categorie) {
		document.getElementById('sel1').value = decodeURI(categorie);
	}
</script>

<script>
	function check() {
		categorie1 = document.getElementById('sel1');
		categorie2 = document.getElementById('sel2');
		if (categorie1.value != 0) {
			categorie2.disabled = true;
			categorie1.disabled = false;
		} else if (categorie2.value.localeCompare("") != 0) {
			categorie1.disabled = true;
			categorie2.disabled = false;
		} else {
			categorie1.disabled = false;
			categorie2.disabled = false;
		}
	}
	check();

	function check_checkbox() {
		box1 = document.getElementById("checkbox_comunitate").checked;
		box2 = document.getElementById("checkbox_draft").checked;
		if (box1 == false && box2 == false) {
			document.getElementById("btn_incarca").disabled = true;
		} else {
			document.getElementById("btn_incarca").disabled = false;
		}
	}
	check_checkbox();
</script>

<?php
    if(isset($_POST['upload'])){
        $artist = $_POST['artist'];
        $titlu = $_POST['titlu'];
		if(isset($_POST['altaCategorie'])) {
			$categorie = $_POST['altaCategorie'];
		} else {
			$categorie = $_POST['categorie'];
		}
		$username = $_SESSION['user'][1];
        $text = $_POST['text'];

		// Translate to unix encoding
		$text = str_replace("\r\n", "\n", $text);

		if (isset($_POST['checkbox_comunitate'])) {
			$r_upload_file = uploadFile($username, $artist, $titlu, $categorie, $text);
	        if($r_upload_file)
				print ("<div class='alert alert-success' style='font-size:19px;width:660px;margin-left:175px'>Fișierul a fost încărcat. Urmează să fie aprobat de un administrator. Vă mulțumim.</div>");
	        else
				print ("<div class='alert alert-warning' style='font-size:19px;width:500px;margin-left:250px'>Fișierul nu a putut fi încărcat. Vă rugăm încercați mai târziu.</div>");
		}

		if (isset($_POST['checkbox_draft'])) {
			$r_upload_draft = upload_draft($username, $artist, $titlu, $text);
			if ($r_upload_draft)
				print ("<div class='alert alert-success' style='font-size:19px;width:320px;margin-left:340px'>Draftul a fost încărcat. Vă mulțumim.</div>");
			else
				print ("<div class='alert alert-warning' style='font-size:19px;width:500px;margin-left:250px'>Draftul nu a putut fi încărcat. Vă rugăm încercați mai târziu.</div>");
		}

		echo '<script type="text/javascript">'
		   , 'window.scrollTo(0,document.body.scrollHeight);'
		   , '</script>'
		;
    }
?>
