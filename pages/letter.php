<?php
    //               0    1   2   3   4   5   6   7   8   9   10  11 12  13  14  15  16  17  18  19  20  21  22  23  24  25  26
    $alphabet=array("#", "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

    if(isset($_GET['letter_id'])) {
        $letter_id = $_GET['letter_id'];
        $letter = $alphabet[$letter_id];
        print "<h2>$letter:</h2><br/>";
        $artists = get_artists_by_first_letter($letter);
        if (count($artists) == 0) {
            print "<div class='alert alert-info' style='font-size:19px;width:510px;margin-left:0px;margin-top:0px'>Ne pare rău. Nu există artiști care încep cu această literă.</div>";
        } else {
?>
<table class="table table-striped">
    <thead>
		<tr>
			<th>Artist</th>
			<th>Număr tabulaturi</th>
			<th>Număr cereri</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($artists as $ar){
				$count_tabs = get_numberOf_tabs_by_artist($ar['artist']);
				$count_requests = get_numberOf_requests_by_artist($ar['artist'])
		?>
		<tr>
			<td><?php print "<a href=\"index.php?artist=".$ar['artist']."\">".$ar['artist']."</a>";?></td>
			<td><?php print $count_tabs;?></td>
			<td><?php print $count_requests;?></td>
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
