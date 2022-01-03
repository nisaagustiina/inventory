
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url(); ?>purchasing" class="<?php echo $this->uri->segment(2) == '' ? 'active': '' ?>"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<li><a href="<?php echo base_url(); ?>purchasing/vendor" class="<?php echo $this->uri->segment(2) == 'vendor' ? 'active': '' ?>"><i class="lnr lnr-users"></i> <span>Vendor</span></a></li>						
						<li><a href="<?php echo base_url(); ?>purchasing/items" class="<?php echo $this->uri->segment(2) == 'items' ? 'active': '' ?>"><i class="lnr lnr-tag"></i> <span>Items</span></a></li>
						<li><a href="<?php echo base_url(); ?>purchasing/request" class="<?php echo $this->uri->segment(2) == 'request' ? 'active': '' ?>"><i class="lnr lnr-pencil"></i> <span>Request</span></a></li>
						<li><a href="<?php echo base_url(); ?>purchasing/order" class="<?php echo $this->uri->segment(2) == 'order' ? 'active': '' ?>"><i class="lnr lnr-cart"></i> <span>Order</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	