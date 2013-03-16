<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">

	//<![CDATA[
	Joomla.submitbutton = function(pressbutton) {
		var form = document.adminForm;
    	if (pressbutton == 'cancel') {
        	form.action.value = 'cancel'
        	submitform('cancel');
        	return;
    	}
 
    	submitform(pressbutton);
    	return;
	}	
	//]]>
	
</script>



<form action="index.php" method="post" name="adminForm" id="adminForm">

<fieldset class="adminform">

	<table class="admintable" width="100%">
	
		<tbody>
		
			<tr>
			
				<td valign="top">
									
						<legend>
							<?php echo JText::_('COFI_CONFIGURATION_SOCIAL_MEDIA_CODE');?>
						</legend>

						
						<table class="admintable" width="100%">													


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px; width:30%;">
                     			    <label>
                     				    <?php echo JText::_('COFI_SOCIAL_MEDIA_BUTTON_1'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px; width:70%;">
                     			    <textarea name="social_media_button_1" id="social_media_button_1" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->social_media_button_1; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_SOCIAL_MEDIA_BUTTON_2'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="social_media_button_2" id="social_media_button_2" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->social_media_button_2; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_SOCIAL_MEDIA_BUTTON_3'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="social_media_button_3" id="social_media_button_3" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->social_media_button_3; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_SHARE_CODE'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="share_code" id="share_code" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->share_code; ?></textarea>
                     			</td>
                     		</tr>


							<tr>
								<td class="key" style="padding: 20px 10px 10px 10px;">
									&nbsp;
								</td>
								<td style="padding: 10px;">
									&nbsp;
								</td>
							</tr>


						</table>





                        <legend>
                  			<?php echo JText::_('COFI_CONFIGURATION_HTML_BOXES');?>
                  		</legend>

                        <table class="admintable" width="100%">

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px; width:30%;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_INDEX_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px; width:70%;">
                     			    <textarea name="html_box_index_top" id="html_box_index_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_index_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_INDEX_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_index_bottom" id="html_box_index_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_index_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_CATEGORY_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_category_top" id="html_box_category_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_category_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_CATEGORY_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_category_bottom" id="html_box_category_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_category_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_THREAD_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_thread_top" id="html_box_thread_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_thread_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_THREAD_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_thread_bottom" id="html_box_thread_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_thread_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_PROFILE_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_profile_top" id="html_box_profile_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_profile_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_PROFILE_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_profile_bottom" id="html_box_profile_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_profile_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_POSTING_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_posting_top" id="html_box_posting_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_posting_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_POSTING_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_posting_bottom" id="html_box_posting_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_posting_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_INBOX_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_inbox_top" id="html_box_inbox_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_inbox_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_INBOX_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_inbox_bottom" id="html_box_inbox_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_inbox_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_OUTBOX_TOP'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_outbox_top" id="html_box_outbox_top" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_outbox_top; ?></textarea>
                     			</td>
                     		</tr>

                            <tr>
                     		    <td valign="top" class="key" style="padding: 10px;">
                     			    <label>
                     				    <?php echo JText::_('COFI_HTML_BOX_OUTBOX_BOTTOM'); ?>
                     				</label>
                     			</td>
                     			<td style="padding: 10px;">
                     			    <textarea name="html_box_outbox_bottom" id="html_box_outbox_bottom" rows="5" cols="50" style="width: 100%;"><?php echo $this->configuration->html_box_outbox_bottom; ?></textarea>
                     			</td>
                     		</tr>


                            <tr>
                     		    <td class="key" style="padding: 20px 10px 10px 10px;">
                     			    &nbsp;
                     			</td>
                     			<td style="padding: 10px;">
                     				&nbsp;
                     			</td>
                     		</tr>


                        </table>

												
						<input type="hidden" name="option" value="com_discussions" />
						<input type="hidden" name="task" value="" />						
						<input type="hidden" name="cid[]" value="<?php echo $this->configuration->id; ?>" />
						<input type="hidden" name="view" value="configuration" />
						
						<?php echo JHTML::_('form.token'); ?>
											
				</td>
				
			</tr>
			
		</tbody>
		
	</table>

	</fieldset>
		
</form>



