<table class="main_table">
    <tr>
        <td class="banner"></td>
        <td>
            <div class="search-and-connect">
                <a class="user_connected" href="index.php?user_uploads=1&username=<?php echo $_SESSION['user'][1]; ?>"><?php echo $_SESSION['user'][1]; ?></a>
                <a href="index.php?disconnect=1" class="logout">Deconectare</a>
                <input type="search" class="search" id="search" placeholder="Caută.." onfocus="if(this.placeholder == 'Caută..') {this.placeholder=''}" onblur="if(this.placeholder == ''){this.placeholder ='Caută..'}" onkeypress="return searchKeyPress(event);"/>
                <a id="search-link">
                    <img src="images/search.png" alt="search.png" class="searchButton" id="searchButton" onclick="get_search_item()">
                </a>
            </div></td>
    </tr>
    <tr>
        <td colspan="2" class="navigation">
            <ul class="clearfix">
                <li><a href="index.php">Acasă</a></li>
                <li><a href="#">Artiști<span class="arrow">&#9660;</span></a>
                    <ul class="sub-menu" id="artisti">
                        <li><a href="index.php?letter_id=0">#</a></li>
                        <li><a href="index.php?letter_id=1">A</a></li>
                        <li><a href="index.php?letter_id=2">B</a></li>
                        <li><a href="index.php?letter_id=3">C</a></li>
                        <li><a href="index.php?letter_id=4">D</a></li>
                        <li><a href="index.php?letter_id=5">E</a></li>
                        <li><a href="index.php?letter_id=6">F</a></li>
                        <li><a href="index.php?letter_id=7">G</a></li>
                        <li><a href="index.php?letter_id=8">H</a></li>
                        <li><a href="index.php?letter_id=9">I</a></li>
                        <li><a href="index.php?letter_id=10">J</a></li>
                        <li><a href="index.php?letter_id=11">K</a></li>
                        <li><a href="index.php?letter_id=12">L</a></li>
                        <li><a href="index.php?letter_id=13">M</a></li>
                        <li><a href="index.php?letter_id=14">N</a></li>
                        <li><a href="index.php?letter_id=15">O</a></li>
                        <li><a href="index.php?letter_id=16">P</a></li>
                        <li><a href="index.php?letter_id=17">Q</a></li>
                        <li><a href="index.php?letter_id=18">R</a></li>
                        <li><a href="index.php?letter_id=19">S</a></li>
                        <li><a href="index.php?letter_id=20">T</a></li>
                        <li><a href="index.php?letter_id=21">U</a></li>
                        <li><a href="index.php?letter_id=22">V</a></li>
                        <li><a href="index.php?letter_id=23">W</a></li>
                        <li><a href="index.php?letter_id=24">X</a></li>
                        <li><a href="index.php?letter_id=25">Y</a></li>
                        <li><a href="index.php?letter_id=26">Z</a></li>
                    </ul>
                </li>
                <li><a href="#">Categorii<span class="arrow">&#9660;</span></a>
                    <ul class="sub-menu">
						<?php
							connectDB();
							$sql = mysql_query("SELECT DISTINCT categorie FROM melodii WHERE cale is not null ORDER BY categorie ASC");
							while ($row = mysql_fetch_array($sql)){
								echo "<li><a id=\"categorii\" href=\"index.php?category=" . $row['categorie'] . "\">" . $row['categorie'] . "</a></li>";
							}
						?>
                    </ul>
                </li>
                <li><a href="index.php?upload=1">Încarcă acorduri</a></li>
                <li><a href="index.php?request_chord=1">Cere acorduri</a></li>
                <li><a href="index.php?acorduri=1">Acorduri</a></li>
                <li><a href="index.php?contact=1">Contact</a></li>
            </ul>
        </td>
    </tr>
    <tr><td colspan="2">
        <div class="content">
            <?php
                if(isset($_GET['letter_id'])) {
                    $letter = $_GET['letter_id'];
                    //process_letter
                    require_once 'pages/letter.php';
                } else if(isset($_GET['category'])) {
                    $category = $_GET['category'];
                    //process_category
                    require_once 'pages/category.php';
                } else if(isset($_GET['upload'])) {
                    require_once 'pages/upload.php';
                } else if(isset($_GET['contact'])) {
                    require_once 'pages/contact.php';
                } else if (isset($_GET['request_chord'])) {
                    require_once 'pages/request_chords.php';
                } else if(isset($_GET['song'])) {
                    require_once 'pages/display_tab.php';
                } else if(isset($_GET['tmp-song'])) {
                    require_once 'pages/display_tab_tmp.php';
                }  else if(isset($_GET['draft'])) {
                    require_once 'pages/display_draft.php';
                } else if(isset($_GET['artist'])) {
                    require_once 'pages/display_tabs_by_artist.php';
                } else if (isset($_GET['search'])) {
                    require_once 'pages/search_in_site.php';
				} else if (isset($_GET['user_uploads'])) {
                    require_once 'pages/user_uploads.php';
				} else if (isset($_GET['acorduri'])) {
                    require_once 'pages/acorduri.php';
				} else
                    require_once 'pages/home.php';
            ?>
        </div>
    </td></tr>
</table>
