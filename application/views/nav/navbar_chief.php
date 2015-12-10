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
				<li><?php echo anchor('laporan', 'Chief BAU', 'style=background:#663344;'); ?></li>
			</ul>
			<ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('laporan/laporan_usp', 'Laporan USP', ''); ?></li>
                        <li><?php echo anchor('laporan/laporan_upp', 'Laporan UPP', ''); ?></li>
                        <li><?php echo anchor('laporan/laporan_dispensasi_beasiswa', 'Laporan Dispensasi & Beasiswa', ''); ?></li> 
                    </ul>
                </li>
			</ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('masterbau/master_biaya', 'Master Biaya', ''); ?></li>
                        <li><?php echo anchor('masterbau/master_keuangan', 'Master Keuangan', ''); ?></li> 
                        <li><?php echo anchor('masterbau/master_beasiswa', 'Master Beasiswa', ''); ?></li> 
                    </ul>
                </li>
			</ul>
            <ul class="nav navbar-nav">
                 <li <?php if($currentTab == 'dispensasi') echo 'class=active'; ?>><?php echo anchor('masterbau/dispensasi', 'Dispensasi', ''); ?></li> 
            </ul>
            <ul class="nav navbar-nav">
                 <li  <?php if($currentTab == 'beasiswa') echo 'class=active'; ?>><?php echo anchor('masterbau/beasiswa', 'Beasiswa', ''); ?></li> 
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