<!-- START OF MENU -->

	<div class="menu">

		<ul>
<?php

include_once("../php/pages.php");

foreach ($titleArray as $key => $title) {

	print "			<li><a href=index.php?page=$key>$title</a></li>\n";
}

?>
		</ul>

	</div>

<!-- END OF MENU -->
