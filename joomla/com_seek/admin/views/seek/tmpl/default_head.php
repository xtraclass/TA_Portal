<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<th width="5">
		<?php echo JText::_('All Data'); ?>
	</th>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->institutes); ?>);" />
	</th>			
	<th>
		<?php echo JText::_('All Data'); ?>
	</th>
</tr>