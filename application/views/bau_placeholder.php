<div class="container-fluid">
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
			<li data-target="#carousel" data-slide-to="3"></li>
		</ol>

		<div class="carousel-inner" role="listbox">
		    <div class="item active">
		    	<img src="<?php echo base_url('assets/images/onodera.png'); ?>" alt="onodera">
		    </div>

		    <div class="item">
				<img src="<?php echo base_url('assets/images/chitoge.jpg'); ?>" alt="chitoge">
		    </div>

		    <div class="item">
				<img src="<?php echo base_url('assets/images/marika.png'); ?>" alt="marika">
		    </div>
	  	</div>

		<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
	  	</a>
		<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>