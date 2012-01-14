<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->institutes as $i => $institute): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $institute->id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $institute->id); ?>
		</td>
		<td>
			<?php echo $institute->abbreviation; ?>
		</td>
	</tr>
<?php endforeach; ?>