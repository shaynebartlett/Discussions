<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 

$db	=& JFactory::getDBO();

$sql = "SELECT share_code FROM ".$db->quoteName( '#__discussions_configuration')." WHERE id='1'";

$db->setQuery( $sql);
$_shareCode = $db->loadResult();

if ( $_shareCode != "") {
	echo "<div class='cofiShareCode'>";
		echo $_shareCode;
	echo "</div>";
}

