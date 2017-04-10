<?php virtual("/includes/header.php"); ?>
<body>
	<div id="content">
		<div class="well">
			<p>
				<?php
					# check for empty variables in GET request
					foreach($_GET as $name => $value) {
						if($value == "") {
							$exit = True;
						}
					}
					if ($exit) {
						echo "Error: Invalid JSON";
					} else {
						# extract variables from GET request
						extract($_GET);
						# runs python script
						exec("sudo /var/www/html/cgi-bin/gpio-ctl.cgi $gpio $time", $output);
						# displays action
						echo "Holding the power switch for $time second(s)";
					}
				?>
			</p>
			<?php
				# print error if applicable
				if ($output) {
					echo "<code>";
					foreach ($output as $i => $l) {
						if ($i > 0) { echo "</br>$l"; } else { echo "$l"; }
					}
					echo "</code>";
				}
			?>
			<a class="btn btn-primary" href="/index.php">Home</a>
		</div>
	</div>
<?php virtual("/includes/footer.php"); ?>
