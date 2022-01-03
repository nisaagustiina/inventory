<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url(); ?>warehouse" class="<?php echo $this->uri->segment(2) == '' ? 'active': '' ?>"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<li><a href="<?php echo base_url(); ?>warehouse/incoming" class="<?php echo $this->uri->segment(2) == 'incoming' ? 'active': '' ?>"><i class="lnr lnr-enter"></i> <span>Incoming</span></a></li>						
						<li><a href="<?php echo base_url(); ?>warehouse/stock" class="<?php echo $this->uri->segment(2) == 'stock' ? 'active': '' ?>"><i class="lnr lnr-database"></i> <span>Stock</span></a></li>
						<li><a href="<?php echo base_url(); ?>warehouse/out" class="<?php echo $this->uri->segment(2) == 'out' ? 'active': '' ?>"><i class="lnr lnr-exit"></i> <span>Used</span></a></li>
						<li><a href="<?php echo base_url(); ?>warehouse/request" class="<?php echo $this->uri->segment(2) == 'request' ? 'active': '' ?>"><i class="lnr lnr-pencil"></i> <span>Request</span></a></li>
						<li><a href="<?php echo base_url(); ?>warehouse/report" class="<?php echo $this->uri->segment(2) == 'report' ? 'active': '' ?>"><i class="lnr lnr-chart-bars"></i> <span>Report</span></a></li>
						
					</ul>
				</nav>
			</div>
		</div>