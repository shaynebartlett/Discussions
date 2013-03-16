<?php

/**
 * @package		Codingfish Discussions
 * @subpackage	mod_discussions_messages
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

defined('_JEXEC') or die('Restricted access');


// website root directory
$_root = JURI::root();

$user =& JFactory::getUser();
$_user_id = $user->id;


$db		  =& JFactory::getDBO();

$entries 		= 0;
$new_entries 	= 0;


$entries_query = "SELECT count(*) FROM #__discussions_messages_inbox WHERE user_id='" . $_user_id . "' AND flag_deleted='0'";

$db->setQuery($entries_query);
$entries = $db->loadResult();

$new_entries_query = "SELECT count(*) FROM #__discussions_messages_inbox WHERE user_id='" . $_user_id . "' AND flag_read='0' AND flag_deleted='0'";

$db->setQuery($new_entries_query);
$new_entries = $db->loadResult();


// get Discussions itemid
$sql = "SELECT extension_id FROM " . $db->quoteName('#__extensions') . " WHERE " . $db->quoteName('element') . "='com_discussions' AND " . $db->quoteName('type') . "='component'";
$db->setQuery( $sql);
$componentid = $db->loadResult();

if ( !$componentid) {
	$itemid = 0;	
}
else {
	$sql = "SELECT id FROM " . $db->quoteName('#__menu') .
			" WHERE " . $db->quoteName('component_id') . "='" . $componentid . "' AND parent_id='1' AND published='1' ";
			
	$db->setQuery( $sql);
	$itemid = $db->loadResult();

	if ( !$itemid) {
		$itemid = 0;
	}
}

if ( $itemid == 0) { // got no itemid
	$linkMailbox  = JRoute::_( 'index.php?option=com_discussions&view=inbox&task=inbox');
}
else {
	$linkMailbox  = JRoute::_( 'index.php?option=com_discussions&view=inbox&task=inbox&Itemid=' . $itemid);
}
?>


<div style="margin: 5px; border: 0px;">

	<table border="0" cellspacing="0" cellpadding="5" style="border: 0px;">

		<tbody>

			<tr>
			
				<td style="border: 0px;">
					<?php
        			echo "<a href='" . $linkMailbox . "' title='Mailbox' >";
					echo "<img src='" . $_root . "modules/mod_discussions_messages/email_16.png' border='0' alt='Mailbox' align='left' style='margin: 0px 10px 0px 0px;' />";
					echo "</a>";
					?>
				</td>
				
				<td style="border: 0px;">
					<?php
    				echo "<a href='" . $linkMailbox . "' title='Mailbox' >";
					echo "Mailbox";
					echo "</a>";
					?>
				
					<span style="color:#BD192D">
					
					<?php
                    switch ( $new_entries) {

                        case 0: {
                            break; // nothing
                        }
                        case 1: { // 1 new message (singular)
                            echo "<b>";
                            echo "&nbsp;&nbsp;&nbsp;" . $new_entries . " new Message";
                            echo "</b>";
                            break;
                        }
                        default: { // more than 1 new message (plural)
                            echo "<b>";
                            echo "&nbsp;&nbsp;&nbsp;" . $new_entries . " new Messages";
                            echo "</b>";
                            break;
                        }

                    }
					?>			
					
					</span>
					
				</td>
                
			</tr>

		</tbody>

	</table>

</div>




