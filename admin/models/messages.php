<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class DiscussionsModelMessages extends JModel {


    function getMessagesInboxQuickStats( $count = 5) {

   		$db = & JFactory::getDBO();

   		$query = "SELECT i.user_id, u.username, count(*) AS counter FROM #__discussions_messages_inbox i, #__discussions_users u WHERE i.user_id=u.id GROUP BY i.user_id ORDER BY counter DESC	LIMIT " . $count;
   		$db->setQuery($query);

   		$rows = $db->loadObjectList();


   		return $rows;

   	}


   	function getMessagesOutboxQuickStats( $count = 5) {

   		$db = & JFactory::getDBO();

   		$query = "SELECT i.user_id, u.username, count(*) AS counter FROM #__discussions_messages_outbox i, #__discussions_users u WHERE i.user_id=u.id GROUP BY i.user_id ORDER BY counter DESC	LIMIT " . $count;
   		$db->setQuery($query);

   		$rows = $db->loadObjectList();


   		return $rows;

   	}


   	function getMessagesTotalInboxCount() {

   		$db	=& JFactory::getDBO();

   		$query = "SELECT count(*) FROM #__discussions_messages_inbox";

   		$db->setQuery($query);

   		return $db->loadResult();

   	}


   	function getMessagesTotalOutboxCount() {

   		$db	=& JFactory::getDBO();

   		$query = "SELECT count(*) FROM #__discussions_messages_outbox";

   		$db->setQuery($query);

   		return $db->loadResult();

   	}


}
