<?php
    if(isset($_GET['search'])) {
        $item = $_GET['search'];
        print "<h3>Rezultate pentru: ".$item."</h3><br/>";
        $result = get_result_of_search($item);
        if (count($result) == 0) {
            print "<div class='alert alert-info' style='font-size:19px;width:327px;margin-left:0px'>Nu există rezultate pentru căutare.</div>";
        } else {
?>
<table padding="10" class="table table-striped">
	<thead>
		<tr>
			<th>Artist</th>
			<th>Piesa</th>
			<th>Contribuitor</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($result as $res){
		?>
		<tr>
			<td><?php print "<a href=\"index.php?artist=".$res['artist']."\">".$res['artist']."</a>";?></td>
			<td><?php print "<a href=\"index.php?song=".$res['id']."\">".$res['titlu']."</a>";?></td>
			<td><a href="index.php?user_uploads=1&username=<?php echo $res['uploader']; ?>"><?php print $res['uploader'];?></a></td>
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
