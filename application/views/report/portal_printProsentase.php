<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class='row'>
                <div class="col-md-12">
                    <?php if($this->session->flashdata('alert')){
                        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                    }?>
                    <div class="page-header"><h1>Report Prosentase Nilai</h1></div>
					<?php echo form_open('confirmation/reportProsentase');?>
							<div class = 'row'>
								<div class= "col-md-4">
									<div class = 'row'>
										<div class = "col-md-4">
											<?php echo 'Tahun Ajaran : '; ?>
										</div>
										<div class = "col-md-6">
											<?php echo form_dropdown('ddYear', $ddYear, ' ', 'id = ddYear', 'class = form-control'); ?>
										</div>
										
										<div class = "col-md-4">
											<?php echo 'Pilihan : '; ?>
										</div>
										<div class = "col-md-6">
											<?php echo form_dropdown('pilihan',$pilihan)."<br/><br/>";?>
										</div>
									</div>
								</div>
							
							</div>
							<div class="row">
								<div class="col-md-12">
									<?php
										
										 echo form_submit([
										'id' => 'btnView',
										'name' => 'btnView',
										'class' => 'btn btn-primary'
										], 'View Report');
									
									?>
								</div>
							</div>
					<?php echo form_close(); ?>
					
                </div>
            </div>
		</div>
	</div>
</div>	