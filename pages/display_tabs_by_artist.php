<?php
    if(isset($_GET['artist'])) {
        $artist = $_GET['artist'];
        print "<h2>".$artist."</h2><br>";
?>
<script>
    function switch_tabs_requests() {
        var button1 = document.getElementById("display_tabs");
        var button2 = document.getElementById("display_req");

        var table1 = document.getElementById("tabs");
        var table2 = document.getElementById("requests");

        var error_t = document.getElementById("error_tab");
        var error_r = document.getElementById("error_req");

        if(button1.disabled == true) {
            button1.disabled = false;
            button2.disabled = true;
            if(table1 != null)
                table1.style.display = "none";
            if(table2 != null)
                table2.style.display = "table";
            if(error_t != null)
                error_t.style.display="none";
            if (error_r != null)
                error_r.style.display="block";
        } else {
            button1.disabled = true;
            button2.disabled = false;
            if(table1 != null)
                table1.style.display="table";
            if(table2 != null)
                table2.style.display="none";
            if(error_t != null)
                error_t.style.display="block";
            if(error_r != null)
                error_r.style.display="none";
        }
    }
</script>
<div class="switch">
    <input type="button" class="btn btn-default" value="Tabulaturi" id="display_tabs" onclick="switch_tabs_requests()" disabled="true">
    <input type="button" class="btn btn-default" value="Cereri" id="display_req" onclick="switch_tabs_requests()">
</div>

<div class="artist_tabs">
<?php
        $all_songs = get_songs_by_artist($artist);

        if (count($all_songs) == 0) {
?>
    <div id="error_tab" class='alert alert-info' style='display: block;font-size:17px;width:395px;margin-left:0px;margin-top:20px'>Ne pare rău. Nu există melodii ale acestui artist.</div>
<?php
        } else {
?>
    <table width="100%" id="tabs" class="table table-striped">
		<thead>
			<tr>
				<th class="col-sm-4">Piesa</th>
				<th class="col-sm-4">Contribuitor</th>
				<th class="col-sm-4">Rating</th>
			</tr>
		</thead>
		<tbody>
        <?php
            foreach ($all_songs as $sg){
        ?>
			<tr>
				<td><?php print "<a href=\"index.php?song=".$sg['id']."\">".$sg['titlu']."</a>";?></td>
				<td><a href="index.php?user_uploads=1&username=<?php echo $sg['uploader']; ?>"><?php print $sg['uploader'];?></a></td>
				<td><?php print $sg['plus']-$sg['minus'];?></td>
			</tr>
        <?php
            }
        ?>
		</tbody>
    </table>
<?php
    }
    $all_requests = get_requests_by_artist($artist);
    $username = $_SESSION['user'][1];
    $requests = get_user_requests($username);
    if (count($all_requests) == 0) {
?>
    <div id="error_req" class='alert alert-info' style='display: none;font-size:17px;width:255px;margin-left:0px;margin-top:20px'>Ne pare rău. Nu există cereri.</div>
<?php
    } else {
        if ($username != "") {
            $loged_in = true;
        } else {
            $loged_in = false;
        }
?>
    <table id="requests" style="display: none" class="table table-striped">
        <thead>
			<tr>
                <th class="col-sm-4">Artist</th>
				<th class="col-sm-4">Piesa</th>
                <th class="col-sm-4"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($all_requests as $sg) {
			?>
			<tr>
                <td><?php print "<a href=\"index.php?artist=" . $sg['artist'] . "\" style='padding:0px'>" . $sg['artist'] . "</a>"; ?></td>
				<td><?php print $sg['titlu']; ?></td>
                <?php if (loged_in == true) {
                        $found = false;
                        foreach ($requests as $r) {
                            if ($r['id'] == $sg['id']) {
                                $found = true;
                            }
                        }
                        if ($found == true) {
                ?>
                        <td><button id="ab_<?php echo $sg['id']?>" style="display:none" class=draftTableButton type=button onclick="button_add_request(<?php echo $sg['id']?>);">Abonare</button>
                            <button id="dez_<?php echo $sg['id']?>" class=draftTableButton type=button onclick="button_erase_request(<?php echo $sg['id']?>);">Dezabonare</button></td>
                <?php
                    } else {
                ?>
                        <td><button id="ab_<?php echo $sg['id']?>" class=draftTableButton type=button onclick="button_add_request(<?php echo $sg['id']?>);">Abonare</button>
                            <button id="dez_<?php echo $sg['id']?>" style="display:none" class=draftTableButton type=button onclick="button_erase_request(<?php echo $sg['id']?>);">Dezabonare</button></td>
                <?php
                    }
                } ?>
			</tr>
			<?php
				}
			?>
            <script>
                function button_erase_request(id_cerere) {
                    var ajaxurl = 'pages/remove_request.php';
                    data =  {'id' : id_cerere};
                    $.post(ajaxurl, data, function (response) {
                        $("#dez_" + id_cerere).css("display", "none");
                        $("#ab_" + id_cerere).css("display", "block");
                    });
                }
                function button_add_request(id_cerere) {
                    var ajaxurl = 'pages/add_request.php';
                    data =  {'id' : id_cerere, 'user' : '<?php echo $username;?>'};
                    $.post(ajaxurl, data, function (response) {
                        $("#ab_" + id_cerere).css("display", "none");
                        $("#dez_" + id_cerere).css("display", "block");
                    });
                }
            </script>
		</tbody>
    </table>
    <?php } ?>
</div>
<?php
    }
?>
