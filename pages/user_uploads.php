<div class="artist_tabs">
<style>
.setWidth {
    max-width: 330px;
    padding: 0px;
    margin: 0px;
}
</style>
<?php
	$username = $_GET['username'];
	print "<h1>".$username."</h1>";
	$email = get_email_of_user($username);
	print "<h5>".$email."</h5><br>";

	$all_drafts = get_drafts_of_uploader($username);

	if (count($all_drafts) != 0) {
?>
        <div class="row col-sm-8">
		  <h4 style="font-weight:bold">Tabulaturi draft</h4>
        </div>
		<div class="row col-sm-12">
			<table id="drafts_table" class="table table-striped">
		        <thead>
					<tr>
						<th class="col-sm-4">Artist</th>
						<th class="col-sm-4">Piesa</th>
                        <th class="col-sm-4"\>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($all_drafts as $sg){
					?>
					<tr>
						<td class="setWidth"><div class="setWidth"><?php print "<a href=\"index.php?artist=".$sg['artist']."\">".$sg['artist']."</a>";?></div></td>
						<td class="setWidth"><div><?php print "<a href=\"index.php?draft=".$sg['id']."\">".$sg['titlu']."</a>";?></div></td>
                        <td><button class=myButton type=\button\>Șterge</button></td>
					</tr>
					<?php
						}
					?>
				</tbody>
		    </table>
		</div>
		<br><br><br><br><br>

<?php
	}
	$all_songs = get_songs_by_uploader($username);

	if (count($all_songs) == 0) {
	// <p id="error_tab" style="display: block">Ne pare rau. Userul selectat nu are contributii.</p>
?>
<?php
	} else {
?>
    <div class="row col-sm-8">
        <h4 style="font-weight:bold">Tabulaturi încărcate</h4>
    </div>
	<div class="row col-sm-12">
	<table id="tabs" class="table table-striped">
		<thead>
			<tr>
				<th class="col-sm-4">Artist</th>
				<th class="col-sm-4">Piesa</th>
				<th class="col-sm-4">Rating</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($all_songs as $sg){
			?>
			<tr>
				<td><?php print "<a href=\"index.php?artist=".$sg['artist']."\">".$sg['artist']."</a>";?></td>
				<td><?php print "<a href=\"index.php?song=".$sg['id']."\">".$sg['titlu']."</a>";?></td>
				<td><?php print $sg['plus']-$sg['minus'];?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	</div>
<?php
		}
	// check if current user is admin
	$admin = is_user_admin($username);
	if ($admin == true) {
		$all_tmp_songs = get_all_tmp_songs();
		if (count($all_tmp_songs) != 0) {
?>
        <div class="row col-sm-8">
            <h4 style="font-weight:bold">Tabulaturi în așteptare</h4>
        </div>
		<div class="row col-sm-12">
		<table id="tabs" class="table table-striped">
	        <thead>
				<tr>
					<th class="col-sm-4">Artist</th>
					<th class="col-sm-4">Piesa</th>
					<th class="col-sm-4">Contibuitor</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($all_tmp_songs as $sg){
				?>
				<tr>
					<td><?php print "<a href=\"index.php?artist=".$sg['artist']."\">".$sg['artist']."</a>";?></td>
					<td><?php print "<a href=\"index.php?tmp-song=".$sg['id']."\">".$sg['titlu']."</a>";?></td>
					<td><a href="index.php?user_uploads=1&username=<?php echo $res['uploader']; ?>"><?php print $sg['uploader'];?></a></td>
				</tr>
				<?php
					}
				?>
			</tbody>
	    </table>
	</div>
<?php
		}
	}
?>
</div>
