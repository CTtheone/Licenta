<?php
    if(isset($_GET['category'])) {
        $category = $_GET['category'];
        print "<h2>$category:</h2><br/>";
        $songs = get_songs_by_category($category);
        if (count($songs) == 0) {
            print "<div class='alert alert-info' style='font-size:19px;width:515px;margin-left:200px;margin-top:110px'>Ne pare rău. Nu există melodii în această categorie.</div>";
        } else {
?>
<table class="table table-striped">
    <thead>
		<tr>
			<th>Piesa</th>
			<th>Artist</th>
			<th>Contribuitor</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($songs as $sg){
		?>
		<tr>
			<td><?php print "<a href=\"index.php?song=".$sg['id']."\">".$sg['titlu']."</a>";?></td>
			<td><?php print "<a href=\"index.php?artist=".$sg['artist']."\">".$sg['artist']."</a>";?></td>
			<td><a href="index.php?user_uploads=1&username=<?php echo $sg['uploader']; ?>"><?php print $sg['uploader'];?></a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<?php
        }
    }
?>
