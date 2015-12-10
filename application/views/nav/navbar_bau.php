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
				<li><?php echo anchor('login', 'Login BAU', 'style=background:#663344;'); ?></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a data-toggle="modal"data-target="#modalLogin"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
		</div>
	</div>
</nav>

<div id="modalLogin" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Login</h4>
				<?php 
				if($this->session->flashdata('error_login') != '')
					echo '<h5 class=modal-title style=color:red;>'.$this->session->flashdata('error_login').'</h5>';
                if($this->session->flashdata('error_access') != '')
					echo '<h5 class=modal-title style=color:red;>'.$this->session->flashdata('error_access').'</h5>';
				
				?>
			</div>
			<div class="modal-body">
				<?php echo form_open('bau/userLogin') ?>
				<div class="form-group">
					<label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					<input type="text" class="form-control" name="txtUsername" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label for="pws"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					<input type="password" class="form-control" name="txtPassword" placeholder="Enter Password">
				</div>
				<div class="checkbox">
                    <label><input type="checkbox" name="cbRemember">Remember me</input></label>
				</div>
				<?php
					$attributes = array('name'=>'btnLogin', 'value'=>'Login', 'class'=>'btn btn-default btn-block');
					echo form_submit($attributes);
				?>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>
	<?php if($this->session->flashdata('error_login') != ''){ ?>
		<script> $('#modalLogin').modal('show');</script>
	<?php } ?>
    <?php if($this->session->flashdata('error_access') != ''){ ?>
		<script> $('#modalLogin').modal('show');</script>
	<?php } ?>