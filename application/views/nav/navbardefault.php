<?php echo form_open('home/login');
?>

<!--MENU BAR-->
<div class="nav navbar navbar-inverse"  style="border-radius:0px;">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#loginmodal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		</ul>
	</div>
</div>

<!--ROLE MODEL POP UP-->
<div class="modal fade" id = "loginmodal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<p>Login</p>
			</div>
			<div class="modal-body">
				<form class="form-signin">
					<?php
						//id="inputWarning1"
						// class="control-label" for="inputWarning1";
						//echo validation_errors(); 
						echo $divUsername;
							//echo form_label($errorUser);
							echo form_error('username'); 
							echo "<div class='input-group'>";
							echo "<span class=' glyphicon glyphicon-user input-group-addon'></span>";
							echo form_input($userConfig);
							echo "</div>";
						echo "</div>";
						echo $divPass;
							//echo form_label($errorPass);
							echo form_error('pass'); 
							echo "<div class='input-group'>";
							echo "<span class=' glyphicon glyphicon-briefcase input-group-addon'></span>";
							echo form_input($passConfig);
							echo "</div>";
						echo "</div>";
					  ?>
					<div class="checkbox col-md-offset-7">
					  <label>
						<input type="checkbox" value="remember-me"> Remember me
					  </label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<?php
					echo form_submit($btnLogin);
					echo form_submit($btnClose);
				?>
			</div>
		</div>
	</div>
</div>

<?php if($showModal):?>
<script>$('#loginmodal').modal('show');</script>
<?php endif;?>

<?php echo form_close();?>
