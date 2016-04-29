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
    // check if current user is admin and he is on his own page
    if (is_user_admin($username)['admin'] == 1) {
        $admin = true;
    } else {
        $admin = false;
    }

    if ($username != $_SESSION['user'][1])
        $admin = false;
?>

<div class="switch">
    <input type="button" class="btn btn-default" value="Tabulaturi încărcate" id="tabs_button" onclick="switch_tabs_requests(0)" disabled="true">
    <input type="button" class="btn btn-default" value="Tabulaturi draft" id="drafts_button" onclick="switch_tabs_requests(1)">
    <input type="button" class="btn btn-default" value="Cereri" id="requests_button" onclick="switch_tabs_requests(2)">
<?php
    if ($admin == true) {
?>
        <input type="button" class="btn btn-default" value="Tabulaturi în așteptare" id="aproves_button" onclick="switch_tabs_requests(3)">
<?php
    }
?>
    <br><br>
</div>

<script>
    display = 0;
    buttons = ["tabs_button", "drafts_button", "requests_button", "aproves_button"];
    divs = ["tabs_div", "drafts_div", "requests_div", "aproves_div"];

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

<div id="drafts_div" style="display:none">
        <?php
    	$all_drafts = get_drafts_of_uploader($username);

    	if (count($all_drafts) != 0) {
        ?>
            <div id="draft_div">
                <div id="draft_title" class="row col-sm-8">
        		  <h4 style="font-weight:bold">Tabulaturi draft</h4>
                </div>
        		<div id="draft_table" class="row col-sm-12">
        			<table id="drafts_table" class="table table-striped">
        		        <thead>
        					<tr>
        						<th class="col-sm-4">Artist</th>
        						<th class="col-sm-4">Piesa</th>
                                <th class="col-sm-4"\>
        					</tr>
        				</thead>
        				<tbody id="draft_table_body">
        					<?php
        						foreach ($all_drafts as $sg){
        					?>
        					<tr id="tr<?php echo $sg['id']?>">
        						<td class="setWidth"><div class="setWidth"><?php print "<a href=\"index.php?artist=".$sg['artist']."\">".$sg['artist']."</a>";?></div></td>
        						<td class="setWidth"><div><?php print "<a href=\"index.php?draft=".$sg['id']."\">".$sg['titlu']."</a>";?></div></td>
                                <td><button class=draftTableButton type=button onclick="button_erase_draft_user_uploads(<?php echo $sg['id']?>, '<?php echo $sg['cale']?>');">Șterge</button></td>
        					</tr>
        					<?php
        						}
        					?>
        				</tbody>
        		    </table>
        		</div>
    		    <br><br><br><br><br>
            </div>

            <script>
                function button_erase_draft_user_uploads(id_draft, cale) {
                    var ajaxurl = 'pages/remove_draft.php';
                    data =  {'id_draft' : id_draft, 'cale_draft' : cale};
                    $.post(ajaxurl, data, function (response) {
                        $("#tr" + id_draft).remove();
                        if ($("#draft_table_body > tr").length == 0) {
                            $("#draft_div").remove();
                            $("#no_drafts_info").css('display', 'block');
                        }
                    });
                }
            </script>
            <div id="no_drafts_info" class='alert alert-info' style='font-size:19px;width:252px;margin-left:0px;display:none'>Nu există drafturi încărcate.</div>

<?php
    	} else {
            print "<div class='alert alert-info' style='font-size:19px;width:252px;margin-left:0px'>Nu există drafturi încărcate.</div>";
        }
?>

</div>

<div id="tabs_div">
    <?php
    	$all_songs = get_songs_by_uploader($username);

    	if (count($all_songs) == 0) {
    	       print "<div class='alert alert-info' style='font-size:19px;width:262px;margin-left:0px'>Nu există tabulaturi încărcate.</div>";
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
?>
</div>


<div id="aproves_div" style="display:none">
    <?php
    # daca sunt admin si daca sunt pe pagina mea
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
            } else {
                print "<div class='alert alert-info' style='font-size:19px;width:282px;margin-left:0px'>Nu există tabulaturi în așteptare.</div>";
            }
    	}
    ?>
</div>

<div id="requests_div" style="display:none">
    <?php
        $result = get_user_requests($username);
        if (count($result) == 0) {
            print "<div class='alert alert-info' style='font-size:19px;width:247px;margin-left:0px'>Nu există abonări la cereri.</div>";
        } else {
    ?>
        <div id="draft_div_table">
            <table padding="10" class="table table-striped">
            	<thead>
            		<tr>
            			<th>Artist</th>
            			<th>Piesa</th>
            			<th></th>
            		</tr>
            	</thead>
            	<tbody id="request_table_body">
            		<?php
            			foreach ($result as $res){
            		?>
            		<tr id="tr<?php print $res['id'] ?>">
            			<td><?php print "<a href=\"index.php?artist=".$res['artist']."\">".$res['artist']."</a>";?></td>
            			<td><?php print $res['titlu'] ?></td>
            			<td><button class=draftTableButton type=button onclick="button_erase_request(<?php echo $res['id']?>);">Dezabonare</button></td>
            		</tr>
            		<?php
            			}
            		?>
            	</tbody>
            </table>
        </div>
        <div id="no_requests_info" class='alert alert-info' style='font-size:19px;width:247px;margin-left:0px;display:none'>Nu există abonări la cereri.</div>
        <script>
            function button_erase_request(id_cerere) {
                var ajaxurl = 'pages/remove_request.php';
                data =  {'id' : id_cerere};
                $.post(ajaxurl, data, function (response) {
                    $("#tr" + id_cerere).remove();
                    if ($("#request_table_body > tr").length == 0) {
                        $("#draft_div_table").remove();
                        $("#no_requests_info").css('display', 'block');
                    }
                });
            }
        </script>
    <?php
        }
    ?>
</div>

</div>
