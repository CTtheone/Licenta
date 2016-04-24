<div class="row">
    <div class="col-sm-offset-4 col-sm-4"><h3>Cere acorduri</h3><br></div>
</div>


<form class="form-horizontal" role="form" id="contact-form" action="index.php?request_chord=1" method="post">
  <div class="form-group">
    <label class="control-label col-sm-4" for="artist">Artist:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="artist" placeholder="Artist" name="artist" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="titlu">Titlul piesei:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="titlu" placeholder="Titlu" name="titlu" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-default" name="cere">Trimite cererea</button>
    </div>
  </div>
</form>

<?php
	if(isset($_POST['cere'])){
        $artist = $_POST['artist'];
        $titlu = $_POST['titlu'];
		$r = requestChords($artist, $titlu);
		if($r)
      die ("<div class='alert alert-success' style='font-size:19px;width:345px;margin-left:270px'>Cererea a fost trimisă. Vă mulțumim.</div>");
    else
      die ("<div class='alert alert-warning' style='font-size:19px;width:750px;margin-left:90px'>Cererea nu a putut fi trimisă. Verificați cererile deja existente sau încercați mai târziu.</div>");
	}
?>
