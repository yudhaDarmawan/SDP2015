<nav class="navbar navbar-inverse" style="border-radius: 0px;">
	<div class="container-fluid">
	    <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
			</button>
	    </div>
	    <div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li><?php echo anchor('keuangan', 'Admin BAU', 'style=background:#663344;'); ?></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><?php echo anchor('keuangan/pembayaran_usp', 'Pembayaran USP', ''); ?></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><?php echo anchor('keuangan/pembayaran_upp', 'Pembayaran UPP', ''); ?></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<?php
					echo anchor('bau/userLogout', '<span class="glyphicon glyphicon-log-out"></span> Logout', '');
					?>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a><?php echo 'Welcome, '.$userLoginName ?></a></li>
			</ul>
		</div>
	</div>
</nav>