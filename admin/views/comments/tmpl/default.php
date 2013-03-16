<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 



$ordering = ( ($this->lists['order'] == 'ordering' || $this->lists['order'] == 'parent_id, ordering'));
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">

	<table class="adminform">
	
		<tr>
		
			<td width="100%">
			  	<?php echo JText::_( 'SEARCH' ); ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search']; ?>" class="text_area" onChange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'GO' ); ?></button>
				<button onclick="this.form.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'RESET' ); ?></button>
			</td>
			
			<td nowrap="nowrap">
			  <?php
			  echo $this->lists['state'];
				?>
			</td>
			
		</tr>
		
	</table>



	<table class="adminlist" cellspacing="1">
	
	<thead>
	
		<tr>
			<th width="5"><?php echo JText::_( 'NUM' ); ?></th>
			
			<th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $this->rows ); ?>);" /></th>

			<th class="title" style="text-align: left;"><?php echo JText::_( 'COFI_COMMENT' ); ?></th>

            <th class="title" width="10%" nowrap="nowrap"><?php echo JText::_( 'COFI_USER' ); ?></th>

            <th class="title" width="30%" nowrap="nowrap" style="text-align: left;"><?php echo JText::_( 'COFI_COMMENT_TO' ); ?></th>

			<th class="title" width="1%" nowrap="nowrap"><?php echo JText::_( 'COFI_PUBLISHED' ); ?></th>

			<th width="1%" nowrap="nowrap"><?php echo JHTML::_('grid.sort', 'ID', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?></th>
		</tr>
		
	</thead>



	<tfoot>
	
		<tr>
		
			<td colspan="10">
			
				<?php echo $this->pageNav->getListFooter(); ?>
				
			</td>
			
		</tr>
		
	</tfoot>



	<tbody>

		<?php		
		
		$k = 0;
		$i = 0;
		$n = count( $this->rows );
		
		$rows = &$this->rows;
		
		foreach ( $rows as $row) {
				
			$id = JHTML::_('grid.id', $i, $row->id); 
			$published = JHTML::_('grid.published', $row, $i);	
			
			$link 	= JRoute::_( 'index.php?option=com_discussions&view=comment&task=edit&cid[]='. $row->id );
				
			?>

			<tr class="<?php echo "row$k"; ?>">
			
				<td>
					<?php 
					echo $i + 1 + $this->pageNav->limitstart;
					?>
				</td>
				
				<td>
					<?php 
					echo $id; 
					?>
				</td>
				
				<td>
					
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'COFI_EDIT_COMMENT' );?>::<?php echo $this->escape($row->comment); ?>">
						<a href="<?php echo $link; ?>"><?php echo $row->comment; ?></a>
					</span>
					
				</td>

                <td align="center">
            		<?php
                    echo $row->username;
            	    ?>
            	</td>

                <td>
            		<?php
                    echo $row->title;
            	    ?>
            	</td>

				<td align="center">
					<?php 
					echo $published; 						
					?>
				</td>
				
				<td align="center">
					<?php 
					echo $row->id; 
					?>
				</td>

			</tr>
			
			<?php
			$k = 1 - $k;
			$i++;
						
		} 
		?>

	</tbody>

	</table>

	<input type="hidden" name="option" value="com_discussions" />
	<input type="hidden" name="controller" value="comments" />
	<input type="hidden" name="view" value="comments" />
	<input type="hidden" name="boxchecked" value="0" />	
	<input type="hidden" name="task" value="" />
	
	<?php echo JHTML::_( 'form.token' ); ?>
	
</form>


