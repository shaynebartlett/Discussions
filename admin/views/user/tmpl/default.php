<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">

	//<![CDATA[
	function submitbutton(pressbutton) {
		if ( pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.name.value ) == "") {
			alert( '<?php echo JText::_('COFI_USER_MUST_HAVE_USERNAME', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
	
</script>



<form action="index.php" method="post" name="adminForm" id="adminForm">

	<table class="admintable" width="100%">
	
		<tbody>
		
			<tr>
			
				<td valign="top">
				
					<fieldset class="adminform">
					
						<legend>
							<?php echo JText::_('COFI_USER_DETAILS');?>
						</legend>
						
						<table class="admintable" width="100%">
													


							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_USERNAME'); ?>
								</td>
								<td style="padding: 10px;">
									<b>
										<?php
										echo $this->user->username; 
										?>
									</b>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_TITLE'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="title" id="title" value="<?php echo $this->user->title; ?>" size="50" maxlength="50" />
								</td>
							</tr>							


							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="show_online_status">
										<?php echo JText::_( 'COFI_SHOW_ONLINE_STATUS' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'show_online_status', 'class="inputbox"', $this->user->show_online_status);
									echo $html;
									?>
								</td>
							</tr>
							
							
							
							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="moderator">
										<?php echo JText::_( 'COFI_MODERATOR' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'moderator', 'class="inputbox"', $this->user->moderator);
									echo $html;
									?>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="email_notification">
										<?php echo JText::_( 'COFI_EMAIL_NOTIFICATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'email_notification', 'class="inputbox"', $this->user->email_notification);
									echo $html;
									?>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="approval_notification">
										<?php echo JText::_( 'COFI_APPROVAL_NOTIFICATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'approval_notification', 'class="inputbox"', $this->user->approval_notification);
									echo $html;
									?>
								</td>
							</tr>


							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="moderated">
										<?php echo JText::_( 'COFI_MODERATED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'moderated', 'class="inputbox"', $this->user->moderated);
									echo $html;
									?>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="rookie">
										<?php echo JText::_( 'COFI_ROOKIE' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'rookie', 'class="inputbox"', $this->user->rookie);
									echo $html;
									?>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="trusted">
										<?php echo JText::_( 'COFI_TRUSTED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'trusted', 'class="inputbox"', $this->user->trusted);
									echo $html;
									?>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label for="images">
										<?php echo JText::_( 'COFI_IMAGES' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<?php
									$html = JHTML::_('select.booleanlist', 'images', 'class="inputbox"', $this->user->images);
									echo $html;
									?>
								</td>
							</tr>


							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_POSTS'); ?>
								</td>
								<td style="padding: 10px;">
									<b>
										<?php
										echo $this->user->posts; 
										?>
									</b>
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_ZIPCODE'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="zipcode" id="zipcode" value="<?php echo $this->user->zipcode; ?>" size="50" maxlength="50" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_CITY'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="city" id="city" value="<?php echo $this->user->city; ?>" size="50" maxlength="150" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_COUNTRY'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="country" id="country" value="<?php echo $this->user->country; ?>" size="50" maxlength="150" />
								</td>
							</tr>
							
							
							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_WEBSITE'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="website" id="website" value="<?php echo $this->user->website; ?>" size="50" maxlength="100" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_TWITTER'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="twitter" id="twitter" value="<?php echo $this->user->twitter; ?>" size="50" maxlength="100" />
								</td>
							</tr>
							
							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_FACEBOOK'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="facebook" id="facebook" value="<?php echo $this->user->facebook; ?>" size="50" maxlength="100" />
								</td>
							</tr>
							
							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_FLICKR'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="flickr" id="flickr" value="<?php echo $this->user->flickr; ?>" size="50" maxlength="100" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<?php echo JText::_('COFI_YOUTUBE'); ?>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="youtube" id="youtube" value="<?php echo $this->user->youtube; ?>" size="50" maxlength="100" />
								</td>
							</tr>


						</table>
												
						<input type="hidden" name="option" value="<?php echo $option;?>" />
						<input type="hidden" name="task" value="" />						
						<input type="hidden" name="cid[]" value="<?php echo $this->user->id; ?>" />
						<input type="hidden" name="view" value="user" />
						
						<?php echo JHTML::_('form.token'); ?>
						
					</fieldset>
					
				</td>
				
			</tr>
			
		</tbody>
		
	</table>
		
</form>



