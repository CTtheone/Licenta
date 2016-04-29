<?php
    if(isset($_GET['search'])) {
        $item = $_GET['search'];
        print "<h3 style=\"margin-bottom:15px\">Rezultate pentru: ".$item."</h3>";
?>

<div class="switch">
    <input type="button" class="btn btn-default" value="Tabulaturi încărcate" id="tabs_button" onclick="switch_tabs_requests(0)" disabled="true">
    <input type="button" class="btn btn-default" value="Cereri" id="requests_button" onclick="switch_tabs_requests(1)">
    <input type="button" class="btn btn-default" value="Utilizatori" id="users_button" onclick="switch_tabs_requests(2)">
</div>

<script>
    display = 0;
    buttons = ["tabs_button", "requests_button", "users_button"];
    divs = ["tabs_div", "requests_div", "users_div"];

    function switch_tabs_requests(id) {
        console.log(id);
        console.log("display " + display);
        $("#" + buttons[display]).attr("disabled", false);
        $("#" + divs[display]).css('display', 'none')

        display = id;

        $("#" + buttons[display]).attr("disabled", true);
        $("#" + divs[display]).css('display', 'block')
    }
</script>

<div id="tabs_div">
    <br>
<?php
    $result = get_result_of_search_tabs($item);
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
?>
</div>

<div id="requests_div" style="display: none;">
    <br>
<?php
    $result = get_result_of_search_requests($username);
    if (count($result) == 0) {
        print "<div class='alert alert-info' style='font-size:19px;width:327px;margin-left:0px'>Nu există rezultate pentru căutare.</div>";
    } else {
?>
    <table padding="10" class="table table-striped">
    	<thead>
    		<tr>
    			<th>Artist</th>
    			<th>Piesa</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
    			foreach ($result as $res){
    		?>
    		<tr>
    			<td><?php print "<a href=\"index.php?artist=".$res['artist']."\">".$res['artist']."</a>";?></td>
    			<td><?php print $res['titlu'] ?></td>
    			<td></td>
    		</tr>
    		<?php
    			}
    		?>
    	</tbody>
    </table>
<?php
    }
?>
</div>


<div id="users_div" style="display: none;">
    <br>
<?php
    $result = get_result_of_search_users($item);
    if (count($result) == 0) {
        print "<div class='alert alert-info' style='font-size:19px;width:327px;margin-left:0px'>Nu există rezultate pentru căutare.</div>";
    } else {
?>
    <div id="draft_table" class="row col-sm-8">
        <table padding="10" class="table table-striped">
        	<thead>
        		<tr>
        			<th class="col-sm-4">Utilizator</th>
        			<th class="col-sm-4">Email</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php
        			foreach ($result as $res){
        		?>
        		<tr>
        			<td><?php print "<a href=\"index.php?user_uploads=1&username=".$res['username']."\">".$res['username']."</a>";?></td>
        			<td><?php print $res['email'] ?></td>
        		</tr>
        		<?php
        			}
        		?>
        	</tbody>
        </table>
    </div>
<?php
    }
?>
</div>

<?php
    }
?>
