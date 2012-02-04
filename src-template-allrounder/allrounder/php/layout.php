<style type="text/css">

	/* Template layout parameters */
	

	#wrapper {
		margin-top:<?php echo  htmlspecialchars($this->params->get('wrapperMarginTop'));?>;
	}
	#foot_container {
		margin-bottom:<?php echo  htmlspecialchars($this->params->get('footerMarginBottom'));?>;
	}
	#topmenu ul.menu, #topmenu ul.menu li a, #topmenu ul.menu li span.separator {
		background-image: url('<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/dropdown-<?php echo  htmlspecialchars($this->params->get('dropdownImage'));?>.png');
	}
	
</style>