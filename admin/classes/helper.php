<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted Access');



/**
 * Helper class
 *
 */
class CofiBackendHelper extends JObject {


	function getNumberOfInboxMessagesByUserId( $id) {

		$db	=& JFactory::getDBO();

		$sql = "SELECT count(*) FROM " . $db->quoteName('#__discussions_messages_inbox') . " WHERE user_id=" . $db->Quote($id);
				
		$db->setQuery( $sql);
		$result = $db->loadResult();

		return $result;

	}


    function getNumberOfOutboxMessagesByUserId( $id) {

   		$db	=& JFactory::getDBO();

   		$sql = "SELECT count(*) FROM " . $db->quoteName('#__discussions_messages_outbox') . " WHERE user_id=" . $db->Quote($id);

   		$db->setQuery( $sql);
   		$result = $db->loadResult();

   		return $result;

   	}



}







