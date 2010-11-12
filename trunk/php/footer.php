      <div class="footer">
         <p class="footnote">Copyright &copy; <?php echo date("Y") . " " . getOrgInfo("companyName");?> All rights reserved.</p>
	<?php
		include("../php/footerUrls.php");
	 	echo "<p>";
		insertFooterUrls();
		echo "</p>";
	?>
      </div>

   </body>
</html>
