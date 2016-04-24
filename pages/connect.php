<div class="row">
    <div class="col-sm-offset-4 col-sm-4"><h2>&nbsp;&nbsp;Conectare</h2><br></div>
</div>

<form class="form-horizontal" role="form" id="contact-form" action="index.php?p=connect" method="post">
  <div class="form-group">
    <label class="control-label col-sm-4" for="artist">Nume utilizator:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" placeholder="Nume utilizator" name="username" required>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-4" for="titlu">Parolă:</label>
    <div class="col-sm-3">
      <input type="password" class="form-control" id="titlu" placeholder="Parolă" name="password" required>
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-default" name="connect">Conectare</button>
    </div>
  </div>
</form>

<?php print $mesaj_eroare_login; ?>
