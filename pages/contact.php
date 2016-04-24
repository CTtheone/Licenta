<div class="row">
    <div class="col-sm-offset-4 col-sm-4"><h2>Trimite un email</h2><br></div>
</div>

<form class="form-horizontal" role="form" id="contact-form" action="index.php?contact=1" method="post">
  <div class="form-group">
    <label class="control-label col-sm-4" for="nume">Nume:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="nume" placeholder="Nume" name="nume" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="email">Email:</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
    </div>
  </div>

  <div class="form-group">
	<label class="control-label col-sm-4" for="comment">Mesaj:</label>
	<div class="col-sm-5">
		<textarea class="form-control" rows="5" id="comment" placeholder="Mesajul dumneavoastră..." name="comment" required></textarea>
	</div>
   </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-default" name="contact">Trimite</button>
    </div>
  </div>
</form>

<?php

// echo shell_exec("ls") . "<br>";
//
// echo shell_exec("curl");
//
// echo shell_exec("./script.sh");

if(isset($_POST['contact'])){
        $name = $_POST['nume'];
        $from = $_POST['email'];
        $comment = $_POST['comment'];

        $txt = 'Comentariu trimis de: ' . $name . "\n" . $comment;

        $command = "curl -s --user 'api:key-3ax6xnjp29jd6fds4gc373sgvjxteol0'     https://api.mailgun.net/v3/samples.mailgun.org/messages " .
        " -F from=" . 'cosmintom@gmail.com' . " -F to=" . 'cosmintom@yahoo.com' . " -F subject=" . "Subiect" . " -F text=" . "Teeext";
        $output = shell_exec($command);
        echo $output;
        //$r = sendEmail('cosmintom@yahoo.com', $from, 'Tabulaturi - mesaj utilizator', $txt);
        //1
        // if($r)
        //     die ("<div class='alert alert-success' style='width:320px;margin-left:340px;font-size:18px'>Mesajul a fost trimis. Vă mulțumim.</div>");
        // else
        //     die ("<div class='alert alert-warning' style='width:501px;margin-left:250px;font-size:18px'>Mesajul nu a putut fi trimis. Vă rugăm încercați mai târziu.</div>");
    }
?>
