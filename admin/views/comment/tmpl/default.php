<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C)2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip');
?>


<form action="index.php" method="post" name="adminForm" id="adminForm">

	<fieldset class="adminform">

	<table class="admintable" width="100%">
	
		<tbody>
		
			<tr>
			
				<td valign="top">
									
						<legend>
							<?php echo JText::_('COFI_COMMENT_DETAILS');?>
						</legend>
						
						<table class="admintable" width="100%">
													

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_PUBLISHED');	?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php echo $this->lists['published']; ?>
									</fieldset>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_USER'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
                                    <b>
                           			    <?php
                           			    echo $this->comment->username;
                           			    ?>
                           			</b>
								</td>
							</tr>
							

							<tr>
								<td valign="top" class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_COMMENT'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
				 					<textarea name="comment" id="comment" rows="5" cols="50" style="width: 100%;"><?php echo $this->comment->comment; ?></textarea>
								</td>
							</tr>							


                            <tr>
                                <td class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_COMMENT_TO'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <?php
                                        echo $this->comment->title;
                                    ?>
                                </td>
                            </tr>


						</table>
												
						<input type="hidden" name="option" value="com_discussions" />
						<input type="hidden" name="task" value="" />						
						<input type="hidden" name="cid[]" value="<?php echo $this->comment->id; ?>" />
						<input type="hidden" name="view" value="comment" />
						
						<?php echo JHTML::_('form.token'); ?>
											
				</td>
				
			</tr>
			
		</tbody>
		
	</table>

	</fieldset>
		
</form>



