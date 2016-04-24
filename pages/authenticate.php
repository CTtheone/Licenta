<div class="row">
    <div class="col-sm-offset-4 col-sm-4"><h2>&nbsp;&nbsp;Înregistrare</h2><br></div>
</div>


<form class="form-horizontal" role="form" id="contact-form" action="index.php?p=auth" method="post">
  <div class="form-group">
    <label class="control-label col-sm-4" for="artist">Nume utilizator:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" placeholder="Nume utilizator" name="username" required>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-4" for="artist">Email:</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" placeholder="Email" name="email" required>
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
      <button type="submit" class="btn btn-default" name="auth">Înregistrare</button>
    </div>
  </div>
</form>



<?php
    if(isset($_POST['auth'])){
        $username = $_POST['username'];
        $parola = $_POST['password'];
        $email = $_POST['email'];
        $r = signUp($username, $parola, $email);
        if(!$r)
            print "<div class='alert alert-info' style='font-size:19px;width:220px;margin-left:335px'>Acest user există deja!</div>";
    }
?>