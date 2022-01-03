
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url(); ?>manager" class="<?php echo $this->uri->segment(2) == '' ? 'active': '' ?>"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<li><a href="<?php echo base_url(); ?>manager/approval" class="<?php echo $this->uri->segment(2) == 'approval' ? 'active': '' ?>"><i class="lnr lnr-checkmark-circle"></i> <span>Approval</span></a></li>						
						<li><a href="<?php echo base_url(); ?>manager/report" class="<?php echo $this->uri->segment(2) == 'report' ? 'active': '' ?>"><i class="lnr lnr-chart-bars"></i> <span>Report</span></a></li>
						
					</ul>
				</nav>
			</div>
		</div>
	