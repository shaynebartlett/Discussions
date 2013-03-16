<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 

require_once( JPATH_COMPONENT.DS.'classes/helper.php');

JHTML::_('behavior.tooltip');

$CofiHelper = new CofiBackendHelper();
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
		
		submitform( pressbutton );		
		
	}		
	//]]>
	
</script>



<form action="index.php" method="post" name="adminForm" id="adminForm">

	<fieldset class="adminform">

	<table class="admintable" width="100%">
	
		<tbody>
		
			<tr>
			
				<td valign="top">
									

						<table class="admintable" width="100%">
													
                            <tr>
                                <td colspan="2" valign="top" class="key" style="padding: 10px;">
                                    <legend>
                                        <?php echo JText::_('COFI_USER_FORUM_SETTINGS');?>
                                    </legend>
                                </td>
                            </tr>


							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_USERNAME'); ?>
									</label>
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
                                    <label>
                                        <?php echo JText::_('COFI_POSTS'); ?>
                                    </label>
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
									<label>
										<?php echo JText::_('COFI_TITLE'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="title" id="title" value="<?php echo $this->user->title; ?>" size="50" maxlength="50" />
								</td>
							</tr>							


							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_SHOW_ONLINE_STATUS' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'show_online_status', 'class="inputbox"', $this->user->show_online_status);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>
							
							
							
							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_MODERATOR' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'moderator', 'class="inputbox"', $this->user->moderator);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_EMAIL_NOTIFICATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'email_notification', 'class="inputbox"', $this->user->email_notification);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_APPROVAL_NOTIFICATION' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'approval_notification', 'class="inputbox"', $this->user->approval_notification);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>


							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_MODERATED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'moderated', 'class="inputbox"', $this->user->moderated);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_ROOKIE' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'rookie', 'class="inputbox"', $this->user->rookie);
										echo $html;
										?>
									</fieldset>
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_TRUSTED' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'trusted', 'class="inputbox"', $this->user->trusted);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>

							<tr>		
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_( 'COFI_IMAGES' ).':'; ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<fieldset class="radio">
										<?php
										$html = JHTML::_('select.booleanlist', 'images', 'class="inputbox"', $this->user->images);
										echo $html;
										?>
									</fieldset>	
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_ZIPCODE'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="zipcode" id="zipcode" value="<?php echo $this->user->zipcode; ?>" size="50" maxlength="50" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_CITY'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="city" id="city" value="<?php echo $this->user->city; ?>" size="50" maxlength="150" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_COUNTRY'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="country" id="country" value="<?php echo $this->user->country; ?>" size="50" maxlength="150" />
								</td>
							</tr>
							
							
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_WEBSITE'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="website" id="website" value="<?php echo $this->user->website; ?>" size="50" maxlength="100" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_TWITTER'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="twitter" id="twitter" value="<?php echo $this->user->twitter; ?>" size="50" maxlength="100" />
								</td>
							</tr>
							
							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_FACEBOOK'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="facebook" id="facebook" value="<?php echo $this->user->facebook; ?>" size="50" maxlength="100" />
								</td>
							</tr>

                            <tr>
                                <td class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_GOOGLEPLUS'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <input class="text_area" type="text" name="googleplus" id="googleplus" value="<?php echo $this->user->googleplus; ?>" size="50" maxlength="100" />
                                </td>
                            </tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_FLICKR'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="flickr" id="flickr" value="<?php echo $this->user->flickr; ?>" size="50" maxlength="100" />
								</td>
							</tr>

							<tr>
								<td class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_YOUTUBE'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
									<input class="text_area" type="text" name="youtube" id="youtube" value="<?php echo $this->user->youtube; ?>" size="50" maxlength="100" />
								</td>
							</tr>

							<tr>
								<td valign="top" class="key" style="padding: 10px;">
									<label>
										<?php echo JText::_('COFI_SIGNATURE'); ?>
									</label>
								</td>
								<td style="padding: 10px;">
				 					<textarea name="signature" id="signature" rows="5" cols="50" style="width: 100%;"><?php echo $this->user->signature; ?></textarea>									
								</td>
							</tr>



                            <tr>
                                <td colspan="2" valign="top" class="key" style="padding: 10px;">
                                    <legend>
                                        <?php echo JText::_('COFI_CONFIG_MESSAGES_SETTINGS');?>
                                    </legend>
                                </td>
                            </tr>

                            <tr>
                               <td class="key" style="padding: 10px;">
                                   <label>
                                       <?php echo JText::_('COFI_MESSAGES_NUMBER_INBOX'); ?>
                                   </label>
                               </td>
                               <td style="padding: 10px;">
                                   <b>
                                       <?php
                                        echo $CofiHelper->getNumberOfInboxMessagesByUserId( $this->user->id);
                                       ?>
                                   </b>
                               </td>
                           </tr>

                            <tr>
                               <td class="key" style="padding: 10px;">
                                   <label>
                                       <?php echo JText::_('COFI_MESSAGES_NUMBER_OUTBOX'); ?>
                                   </label>
                               </td>
                               <td style="padding: 10px;">
                                   <b>
                                       <?php
                                        echo $CofiHelper->getNumberOfOutboxMessagesByUserId( $this->user->id);
                                       ?>
                                   </b>
                               </td>
                           </tr>

                            <tr>
                                <td valign="top" class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_MESSAGES_EMAIL_NOTIFICATIONS'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <fieldset class="radio">
                                        <?php
                                        $html = JHTML::_('select.booleanlist', 'messages_email_notifications', 'class="inputbox"', $this->user->messages_email_notifications);
                                        echo $html;
                                        ?>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top" class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_MESSAGES_USE_SIGNATURE'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <fieldset class="radio">
                                        <?php
                                        $html = JHTML::_('select.booleanlist', 'messages_use_signature', 'class="inputbox"', $this->user->messages_use_signature);
                                        echo $html;
                                        ?>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top" class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_MESSAGES_USE_SIGNATURE_FOR_REPLIES'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <fieldset class="radio">
                                        <?php
                                        $html = JHTML::_('select.booleanlist', 'messages_use_signature_for_replies', 'class="inputbox"', $this->user->messages_use_signature_for_replies);
                                        echo $html;
                                        ?>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top" class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_MESSAGES_SIGNATURE'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <textarea name="messages_signature" id="messages_signature" rows="5" cols="50" style="width: 100%;"><?php echo $this->user->messages_signature; ?></textarea>
                                </td>
                            </tr>




                            <tr>
                                <td colspan="2" valign="top" class="key" style="padding: 10px;">
                                    <legend>
                                        <?php echo JText::_('COFI_COMMENTS_SETTINGS');?>
                                    </legend>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top" class="key" style="padding: 10px;">
                                    <label>
                                        <?php echo JText::_('COFI_COMMENTS_ABOUT_AUTHOR'); ?>
                                    </label>
                                </td>
                                <td style="padding: 10px;">
                                    <textarea name="comments_about_author" id="comments_about_author" rows="5" cols="50" style="width: 100%;"><?php echo $this->user->comments_about_author; ?></textarea>
                                </td>
                            </tr>



						</table>



						<input type="hidden" name="option" value="com_discussions" />
						<input type="hidden" name="task" value="" />						
						<input type="hidden" name="cid[]" value="<?php echo $this->user->id; ?>" />
						<input type="hidden" name="view" value="user" />
						
						<?php echo JHTML::_('form.token'); ?>
											
				</td>
				
			</tr>
			
		</tbody>
		
	</table>
		
	</fieldset>
		
</form>



