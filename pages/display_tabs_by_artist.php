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
				<th>Piesa</th>
				<th>Contribuitor</th>
				<th>Rating</th>
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
    if (count($all_requests) == 0) {
?>
    <div id="error_req" class='alert alert-info' style='display: none;font-size:17px;width:255px;margin-left:0px;margin-top:20px'>Ne pare rău. Nu există cereri.</div>
<?php
    } else {
?>
    <table id="requests" style="display: none" class="table table-striped">
        <thead>
			<tr>
				<th>Piesa</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($all_requests as $sg) {
			?>
			<tr>
				<td><?php print "<a style='padding:0px'>".$sg['titlu']."</a>" ?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
    </table>
    <?php } ?>
</div>
<?php
    }
?>
