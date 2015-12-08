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
                    <li><?= anchor('/','Home');?></li>

                    <?php if ($this->session->userdata('user_role') == 'mahasiswa'){ ?>
                        <li><?= anchor('/','Biodata');?></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perwalian <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><?= anchor('/','FRS');?></li>
                                <li><?= anchor('/','Batal/Tambah/Drop');?></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nilai <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><?= anchor('/','Transkrip Nilai');?></li>
                                <li><?= anchor('/','Nilai Semester');?></li>
                            </ul>
                        </li>
                    <?php }
                    else { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perwalian <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><?= anchor('/','FRS');?></li>
                                <li><?= anchor('/','Batal/Tambah/Drop');?></li>
                            </ul>
                        </li>


                    <?php }
                     if ($this->session->userdata('user_role') == 'kajur'){ ?>
                         <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plotting <span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                 <li><?= anchor('/','Plotting Dosen');?></li>
                                 <li><?= anchor('/','Buka Tutup Kelas');?></li>
                                 <li><?= anchor('/','Gabung Kelas');?></li>
                                 <li><?= anchor('/','Pisah Kelas');?></li>
                             </ul>
                         </li>
                         <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master <span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                 <li><?= anchor('/','Ruangan');?></li>
                                 <li><?= anchor('/','Mata Kuliah');?></li>
                                 <li><?= anchor('/','Jadwal Ruangan');?></li>
                                 <li><?= anchor('/','Dosen');?></li>
                             </ul>
                         </li>
                         <li><?= anchor('/','Daftar Mahasiswa');?></li>
                         <li><?= anchor('confirmation/all','Daftar Kelas');?></li>
						 <li><?= anchor('confirmation/page_prosentase','Report Prosentase Nilai');?></li>
                   
					<?php } ?>
				</ul>


                <!--- Navbar Umum-->
				<ul class="nav navbar-nav navbar-right">
					<li><a id="notif" data-toggle="dropdown" data-target="#" href="#"><span class="glyphicon glyphicon-bell"></span> Notification  </a>
                            <ul class="dropdown-menu notifications" role="menu" aria-labelledby="notif">
                                <div class="notifications-wrapper" id="notifikasi">
                                </div>
                                <div class="notification-footer"><button class="btn btn-primary btn-block" id="notifikasi-viewmore">View More</button></div>
                            </ul>

					</li>



					<li><a id="user" data-toggle="dropdown" data-target="#" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo
$this->session->userdata('username');?> <span class="caret"></span> </a>
					<ul class="dropdown-menu users" role="menu" aria-labelledby="user">
                        <div class="notifications-wrapper">
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Setting</h4>
                                </div>
                            </a>
                            <a class="content" href="<?php echo site_url('home/logout/');?>">
                                <div class="notification-item">
                                    <h4 class="item-title">Logout</h4>
                                </div>
                            </a>
                        </div>
					</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
<script>
    limit = 5;
    start = 0;
    batas = <?php echo $this->notifikasi_model->getCountNotification();?>;
    $.post('<?php echo site_url('notification/get');?>',{limit:limit, start:start}, function(data){
        $('#notifikasi').append(data);
        start = start + limit;
        if (start >= batas){
            $('#notifikasi-viewmore').off('click');
            $('#notifikasi-viewmore').remove();
        }
    });
    $('#notifikasi-viewmore').on('click', function(){
        $.post('<?php echo site_url('notification/get');?>',{limit:limit, start:start}, function(data){
            $('#notifikasi').append(data);
            start = start + limit;
            if (start >= batas){
                $('#notifikasi-viewmore').off('click');
                $('#notifikasi-viewmore').remove();
            }
            $('#notif').dropdown('toggle');
        });
    });
</script>