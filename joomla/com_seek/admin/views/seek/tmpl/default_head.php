<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_SEEK_SEEK_HEADING_ID'); ?>
	</th>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->institutes); ?>);" />
	</th>			
	<th>
		<?php echo JText::_('COM_SEEK_SEEK_HEADING_GREETING'); ?>
	</th>
</tr>