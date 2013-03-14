<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


$installer = new JInstaller();

$db =& JFactory::getDBO();


// remove the Discussions system plugin
$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "discussions" AND `folder` = "system"');
$id = $db->loadResult();
if($id) {
    $result = $installer->uninstall( 'plugin', $id, 1);
}

// remove the Discussions search plugin
$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "discussions" AND `folder` = "search"');
$id = $db->loadResult();
if($id) {
    $result = $installer->uninstall( 'plugin', $id, 1);
}

// remove the Discussions smart search plugin
$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "discussions" AND `folder` = "finder"');
$id = $db->loadResult();
if($id) {
    $result = $installer->uninstall( 'plugin', $id, 1);
}

// remove the Discussions content plugin
$db->setQuery('SELECT `extension_id` FROM #__extensions WHERE `type` = "plugin" AND `element` = "discussions" AND `folder` = "content"');
$id = $db->loadResult();
if($id) {
    $result = $installer->uninstall( 'plugin', $id, 1);
}

echo "<br />";

echo "Discussions has been deleted.";
echo "<br />";
echo "<br />";
