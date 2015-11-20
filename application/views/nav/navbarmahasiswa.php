<!--MENU BAR-->
<div class="nav navbar navbar-inverse"  style="border-radius:0px;">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="nav navbar-nav">
				<?php $stylebutton=array('class'=>'customNavbar','name'=>'perwalian','value'=>'FRS Online'); ?>
				<li <?php if($this->session->userdata('currentPage') == "frs"){echo "class='active'";} ?>><a href=""><?php echo form_submit($stylebutton) ?></a></li>
				<?php $stylebutton=array('class'=>'customNavbar','name'=>'batal','value'=>'Batal Tambah Drop'); ?>
				<li <?php if($this->session->userdata('currentPage') == "batal"){echo "class='active'";} ?>><a href=""><?php echo form_submit($stylebutton) ?></a></li>
				<?php $stylebutton=array('class'=>'customNavbar','name'=>'jadwal','value'=>'Jadwal Kuliah'); ?>
				<li <?php if($this->session->userdata('currentPage') == "jadwal"){echo "class='active'";} ?>><a href=""><?php echo form_submit($stylebutton) ?></a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a id="notif" data-toggle="dropdown" data-target="#" href="#"><span class="glyphicon glyphicon-bell"></span><span class="badge">4</span>
				<!-- FROM HERE -->
				
				<ul class="dropdown-menu notifications" role="menu" aria-labelledby="notif">
		
					<div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
					</div>
					<li class="divider"></li>
					<div class="notifications-wrapper">
						<a class="content" href="#">				  
							<div class="notification-item">
								<h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
								<p class="item-info">Marketing 101, Video Assignment</p>
							</div>
						</a>
					<a class="content" href="#">
						<div class="notification-item">
							<h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
							<p class="item-info">Marketing 101, Video Assignment</p>
						</div>
					</a>
					<a class="content" href="#">
						<div class="notification-item">
							<h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
							<p class="item-info">Marketing 101, Video Assignment</p>
						</div>
					</a>
					<a class="content" href="#">
						<div class="notification-item">
							<h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
							<p class="item-info">Marketing 101, Video Assignment</p>
						</div>
					</a>
					<a class="content" href="#">
						<div class="notification-item">
							<h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
							<p class="item-info">Marketing 101, Video Assignment</p>
						</div>
					</a>
					<a class="content" href="#">
						<div class="notification-item">
							<h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
							<p class="item-info">Marketing 101, Video Assignment</p>
						</div>
					</a>
					</div>
				</ul>
				</li>
					
					
				
				<li><a id="user" data-toggle="dropdown" data-target="#" href="#"><span class="glyphicon glyphicon-user"></span> Lukas </a>
				<ul class="dropdown-menu users" role="menu" aria-labelledby="user">
						<div class="notifications-wrapper">
							<a class="content" href="#">				  
								<div class="notification-item">
									<h4 class="item-title">Biodata</h4>
								</div>
							</a>
						<a class="content" href="#">
							<div class="notification-item">
								<h4 class="item-title">Poin</h4>
								
							</div>
						</a>
						</div>
						
					</ul>
				</li>
				<?php $stylebutton=array('class'=>'customNavbar','name'=>'logout','value'=>'Logout'); ?>
				<li><a href=""> <span class="glyphicon glyphicon-log-out"></span><?php echo form_submit($stylebutton);?></a></li>
			</ul>
			
		</div>
	</div>
</div>
<?php echo form_close();?>