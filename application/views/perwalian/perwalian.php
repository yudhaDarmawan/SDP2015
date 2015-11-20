<?php echo form_open('perwalian/frs');?>
<!--CONTENT-->
	
	<h2 class="text-center">Tahun Ajaran 2015/2016</h2>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<div class="panel panel-default">
					<div class="panel-heading">Form Konfirmasi Perwalian</div>
					<div class="panel-body">
						<?php
						echo 'Nama = ' . $mahasiswa->nama . '<br>';
						echo 'Nrp = ' . $mahasiswa->nrp . '<br>';
						echo 'Semester = ' . $smtr . '<br>';
						echo 'IP Semester lalu = ' . '<br>';
						echo 'IPK = ' . $mahasiswa->ipk . '<br>';
						echo 'Total SKS yang sudah diambil = ' . $mahasiswa->sks . '<br>';
						echo 'Jumlah pengambilan SKS maksimal = 22';
						?>
					</div>
					<!--GARIS PENUTUP HEADER-->
					<hr class="endHeaderTable"></hr>
										
					<!-- SEMESTER 1 SAMPAI 2 -->
					<div class="col-sm-12" style="background:white">
						<div class = "col-sm-4 col-sm-offset-4">
							<h3 class="text-center">Pilih Semester</h3>
							<div id="courseDropdown"><b><?php echo form_dropdown('chooseCourse',$dataCombobox,$smtr-1,'class="form-control"'); ?></b></div>
						<br></div>
						<div class="col-md-10 col-md-offset-1" style="background:transparent">
							<div class="panel panel-default">
						  <!-- Default panel contents -->
								<div class="panel-heading">Semester <b id="semesterSelected"><?php$semesterSelected?></b></div>
								<div class="panel-body" id="courseTable">
									<?php echo $semester;?>
								</div>
							</div>
						</div>
					</div>
					
					<!--KONFIRMASI-->
					<div id="konfirmasi" >
						<pre class="bg-info">
							<p class="pull-right"><b>Jumlah Beban SKS yang akan diambil : <b id="totalSKS"><?php echo $countSKS ?></b></b></p>
							<?php $stylebutton=array('class'=>'btn btn-primary ','name'=>'submit','value'=>'Konfirmasi'); ?>
							<div class="pull-right"><?php echo form_submit($stylebutton);?></div>
						</pre>
					</div>
					<!--LEGEND-->
					<div class="panel-footer">
						<div class="row" style="padding-left:20px">
							<legend>Legend: </legend>
							<div class="col-xs-12"><pre class="bg-active mylegend"></pre><label> = Matakuliah telah lulus dan tidak bisa diambil</label></div>
							<div class="col-xs-12"><pre class="bg-info mylegend"></pre><label> = Matakuliah bisa diambil</label></div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	$(document).on("click",'.checkbox',function(){
		var val = $("#totalSKS").text();
		var id=this.value;
		var target= this;
		var check = false;
		if(this.checked){
			check=true;
		}
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>" + "perwalian/getTotalSks",
			dataType: 'json',
			data: {name:id,status:check,countSKS:val},
			success: function(msg)
			{
				if(target.checked){
					if(val<= 22){
						val = (+val) + (+msg);
						$('#totalSKS').text(val);
					}
				}else{
					val = (+val) - (+msg);
					$('#totalSKS').text(val);
				}
			}
		})
		if(val>23){
			alert('Total SKS anda berlebihan');
			this.checked = false;
		}
	});
	$(document).ready(function(){
		$('#courseDropdown select').change(function(){
			var selCourse =  $(this).find(':selected').text();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('perwalian/setSelectedDropDown'); ?>", 
				data:{index:selCourse},
				dataType:"html",//return type expected as json
				success: function(states){
					$('#courseTable').html(states);
				},
			});
		});
	});
</script>
<?php echo form_close(); ?>