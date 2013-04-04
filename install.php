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


// version of new installed extension
$version = "1.6.1";


$componentInstaller =& JInstaller::getInstance();
$installer = new JInstaller();

$db =& JFactory::getDBO();

// get folder name
$_rootDir = JPATH_ROOT;



// check if Discussions system plugin is already installed
$pathToPlgDiscussionsSystem = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'system';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->quoteName('#__extensions')
			. ' WHERE ' . $db->quoteName('element') . ' = '
			. $db->Quote('discussions')
			. ' AND ' . $db->quoteName('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->quoteName('folder') . ' = '
			. $db->Quote('system');
			
$db->setQuery($query);

$discussionsSystemPluginInstalled = (bool)$db->loadResult();

if ( $discussionsSystemPluginInstalled) {

	// upgrade the Discussions system plugin
	if ( !$installer->install( $pathToPlgDiscussionsSystem)) {
	
		echo "Failed to upgrade the Discussions system plugin!";
		echo "<br />";
	
	} 
	else {
	
		echo "Successfully upgraded the Discussions system plugin";
		echo "<br />";
	
	}
	
} 
else {

	// install the Discussions system plugin
	if ( !$installer->install( $pathToPlgDiscussionsSystem)) {
	
		echo "Failed to install the Discussions system plugin!";
		echo "<br />";
	
	} 
	else {
	
		echo "Successfully installed the Discussions system plugin";
		echo "<br />";
	
	}

}


// enable Discussions system plugin
$query = 'UPDATE ' . $db->quoteName('#__extensions')
       	. ' SET ' . $db->quoteName('enabled') . ' = 1'
       	. ' WHERE ' . $db->quoteName('element') . ' = ' . $db->Quote('discussions')
       	. ' AND ' .   $db->quoteName('type')  . ' = ' . $db->Quote('plugin')
       	. ' AND ' .   $db->quoteName('folder')  . ' = ' . $db->Quote('system');
       	
$db->setQuery($query);

if (!$db->query()) {

    echo "Failed to enable the Discussions system plugin!";
	echo "<br />";
    
} 
else {

    echo "Successfully enabled the Discussions system plugin";
	echo "<br />";
    
}
    


// check if Discussions search plugin is already installed
$pathToPlgDiscussionsSearch = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'search';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->quoteName('#__extensions')
			. ' WHERE ' . $db->quoteName('element') . ' = '
			. $db->Quote('discussions')
			. ' AND ' . $db->quoteName('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->quoteName('folder') . ' = '
			. $db->Quote('search');
			
$db->setQuery($query);

$discussionsSearchPluginInstalled = (bool)$db->loadResult();

if ( $discussionsSearchPluginInstalled) {

	// upgrade the Discussions search plugin
	if ( !$installer->install( $pathToPlgDiscussionsSearch)) {
	
		echo "Failed to upgrade the Discussions search plugin!";
		echo "<br />";
	
	} 
	else {
	
		echo "Successfully upgraded the Discussions search plugin";
		echo "<br />";
	
	}
	
} 
else {

	// install the Discussions search plugin
	if ( !$installer->install( $pathToPlgDiscussionsSearch)) {
	
		echo "Failed to install the Discussions search plugin!";
		echo "<br />";
	
	} 
	else {
	
		echo "Successfully installed the Discussions search plugin";
		echo "<br />";
	
	}

}

// enable Discussions search plugin
$query = 'UPDATE ' . $db->quoteName('#__extensions')
       	. ' SET ' . $db->quoteName('enabled') . ' = 1'
       	. ' WHERE ' . $db->quoteName('element') . ' = ' . $db->Quote('discussions')
       	. ' AND ' .   $db->quoteName('type')  . ' = ' . $db->Quote('plugin')
       	. ' AND ' .   $db->quoteName('folder')  . ' = ' . $db->Quote('search');
       	
$db->setQuery($query);

if (!$db->query()) {

    echo "Failed to enable the Discussions search plugin!";
	echo "<br />";
    
} 
else {

    echo "Successfully enabled the Discussions search plugin";
	echo "<br />";
    
}





// check if Discussions content plugin is already installed
$pathToPlgDiscussionsContent = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'content';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->quoteName('#__extensions')
			. ' WHERE ' . $db->quoteName('element') . ' = '
			. $db->Quote('discussions')
			. ' AND ' . $db->quoteName('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->quoteName('folder') . ' = '
			. $db->Quote('content');

$db->setQuery($query);

$discussionsContentPluginInstalled = (bool)$db->loadResult();

if ( $discussionsContentPluginInstalled) {

	// upgrade the Discussions content plugin
	if ( !$installer->install( $pathToPlgDiscussionsContent)) {

		echo "Failed to upgrade the Discussions content plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully upgraded the Discussions content plugin";
		echo "<br />";

	}

}
else {

	// install the Discussions content plugin
	if ( !$installer->install( $pathToPlgDiscussionsContent)) {

		echo "Failed to install the Discussions content plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully installed the Discussions content plugin";
		echo "<br />";

	}

}
// Note: The content plugin is not enabled by default





// check if Discussions finder plugin is already installed
$pathToPlgDiscussionsFinder = $componentInstaller->getPath('source') . DS . 'plugins' . DS . 'finder';

$query = 'SELECT COUNT(*)'
			. ' FROM ' . $db->quoteName('#__extensions')
			. ' WHERE ' . $db->quoteName('element') . ' = '
			. $db->Quote('discussions')
			. ' AND ' . $db->quoteName('type') . ' = '
			. $db->Quote('plugin')
			. ' AND ' . $db->quoteName('folder') . ' = '
			. $db->Quote('finder');

$db->setQuery($query);

$discussionsFinderPluginInstalled = (bool)$db->loadResult();

if ( $discussionsFinderPluginInstalled) {

	// upgrade the Discussions finder plugin
	if ( !$installer->install( $pathToPlgDiscussionsFinder)) {

		echo "Failed to upgrade the Discussions finder plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully upgraded the Discussions finder plugin";
		echo "<br />";

	}

}
else {

	// install the Discussions finder plugin
	if ( !$installer->install( $pathToPlgDiscussionsFinder)) {

		echo "Failed to install the Discussions finder plugin!";
		echo "<br />";

	}
	else {

		echo "Successfully installed the Discussions finder plugin";
		echo "<br />";

	}

}
// Note: The finder plugin is not enabled by default





// 1. get/set version information
$db->setQuery( 'SELECT COUNT(*) FROM `#__discussions_meta`');

if ( $db->loadResult() == 0) { // no record found = fresh installation

	$db->setQuery( "INSERT INTO `#__discussions_meta` ( id, version) VALUES ('1', '" . $version . "')");
	$db->query();

    $db->setQuery( "INSERT INTO `#__discussions_configuration` ( id) VALUES ('1')");
   	$db->query();

}
else { // upgrade

	// get current version
	$db->setQuery( "SELECT version FROM `#__discussions_meta` WHERE id='1'");
	$_version = $db->loadResult();
			
	switch ( $_version) {
	
		case "1.0": { // upgrade 1.0 -> new version

			echo "Upgrading from 1.0 to " . $version;
			echo "<br />";


			// new fields						
			$sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `show_online_status` tinyint(1) DEFAULT '1'";
			$db->setQuery( $sql);
			$db->query();			


			// new indexes
			$sql = "ALTER TABLE `#__discussions_messages` ADD INDEX `idx_published` (published)";
			$db->setQuery( $sql);
			$db->query();			
				
			$sql = "ALTER TABLE `#__discussions_messages` ADD INDEX `idx_wfm` (wfm)";
			$db->setQuery( $sql);
			$db->query();			

			$sql = "ALTER TABLE `#__discussions_messages` ADD INDEX `idx_date` (date)";
			$db->setQuery( $sql);
			$db->query();			
										
		}


		case "1.1": { // upgrade 1.1 -> new version

			echo "Upgrading from 1.1 to " . $version;
			echo "<br />";

			// new fields						
			$sql = "ALTER TABLE `#__discussions_categories` ADD COLUMN `meta_title` varchar(255) DEFAULT ''";
			$db->setQuery( $sql);
			$db->query();			

			$sql = "ALTER TABLE `#__discussions_categories` ADD COLUMN `meta_description` varchar(255) DEFAULT ''";
			$db->setQuery( $sql);
			$db->query();			

			$sql = "ALTER TABLE `#__discussions_categories` ADD COLUMN `meta_keywords` varchar(255) DEFAULT ''";
			$db->setQuery( $sql);
			$db->query();			
					
			$sql = "ALTER TABLE `#__discussions_categories` ADD COLUMN `banner_top` text DEFAULT ''";
			$db->setQuery( $sql);
			$db->query();			
					
			$sql = "ALTER TABLE `#__discussions_categories` ADD COLUMN `banner_bottom` text DEFAULT ''";
			$db->setQuery( $sql);
			$db->query();			

		}


		case "1.2": { // upgrade 1.2 -> new version

			echo "Upgrading from 1.2 to " . $version;
			echo "<br />";

		}


        case "1.3": { // upgrade 1.3 -> new version

            echo "Upgrading from 1.3 to " . $version;
            echo "<br />";


            // replace older table files because of name conflicts
            $_fileToDelete = $_rootDir . "/administrator/components/com_discussions/tables/forum.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }
            $_fileToDelete = $_rootDir . "/administrator/components/com_discussions/tables/post.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }
            $_fileToDelete = $_rootDir . "/administrator/components/com_discussions/tables/user.php";
            if ( file_exists( $_fileToDelete)) {
                unlink( $_fileToDelete);
            }


            // change fields
            $sql = "ALTER TABLE `#__discussions_categories` MODIFY `description` varchar(1000) DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();

            // new fields
            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `googleplus` varchar(100) DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();

            // new tables
            // create configuration table and insert one row
            $sql = "CREATE TABLE IF NOT EXISTS `#__discussions_configuration` ( " .
                  " `id` int(11) NOT NULL AUTO_INCREMENT, " .
                  " `social_media_button_1` text DEFAULT '', " .
                  " `social_media_button_2` text DEFAULT '', " .
                  " `social_media_button_3` text DEFAULT '', " .
                  " `share_code` text DEFAULT '', " .
                  " `html_box_index_top` text DEFAULT '', " .
                  " `html_box_index_bottom` text DEFAULT '', " .
                  " `html_box_category_top` text DEFAULT '', " .
                  " `html_box_category_bottom` text DEFAULT '', " .
                  " `html_box_thread_top` text DEFAULT '', " .
                  " `html_box_thread_bottom` text DEFAULT '', " .
                  " `html_box_profile_top` text DEFAULT '', " .
                  " `html_box_profile_bottom` text DEFAULT '', " .
                  " `html_box_posting_top` text DEFAULT '', " .
                  " `html_box_posting_bottom` text DEFAULT '', " .
                  " `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP, " .
                  " `modified` timestamp NULL DEFAULT NULL, " .
                  " PRIMARY KEY (`id`) " .
                  " ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
            $db->setQuery( $sql);
            $db->query();

            $sql = "INSERT INTO `#__discussions_configuration` ( id) VALUES ('1')";
            $db->setQuery( $sql);
       	    $db->query();

        }


        case "1.4": { // upgrade 1.4 -> new version

      			echo "Upgrading from 1.4 to " . $version;
      			echo "<br />";

      	}


        case "1.4.1": { // upgrade 1.4.1 -> new version

            echo "Upgrading from 1.4.1 to " . $version;
            echo "<br />";

            // new fields
            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `messages_email_notifications` tinyint(1) NOT NULL DEFAULT '0'";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `messages_use_signature` tinyint(1) NOT NULL DEFAULT '0'";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `messages_use_signature_for_replies` tinyint(1) NOT NULL DEFAULT '0'";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `messages_signature` text";
            $db->setQuery( $sql);
            $db->query();


            $sql = "ALTER TABLE `#__discussions_configuration` ADD COLUMN `html_box_inbox_top` text DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_configuration` ADD COLUMN `html_box_inbox_bottom` text DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_configuration` ADD COLUMN `html_box_outbox_top` text DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_configuration` ADD COLUMN `html_box_outbox_bottom` text DEFAULT ''";
            $db->setQuery( $sql);
            $db->query();


            // new tables
            // create private messages inbox table
            $sql = "CREATE TABLE IF NOT EXISTS `#__discussions_messages_inbox` ( " .
                " `id` 			int(11) NOT NULL AUTO_INCREMENT, " .
         	    " `user_id`		INTEGER UNSIGNED DEFAULT 0, " .
                " `user_from_id`	INTEGER UNSIGNED DEFAULT 0, " .
         	    " `msg_date`      DATE DEFAULT NULL, " .
                " `msg_time`      TIME DEFAULT NULL, " .
         	    " `subject`       VARCHAR(80) DEFAULT NULL, " .
                " `message`       TEXT, " .
         	    " `flag_read`     TINYINT(1) DEFAULT 0, " .
                " `flag_answered` TINYINT(1) DEFAULT 0, " .
         	    " `flag_deleted`  TINYINT(1) DEFAULT 0, " .
                " PRIMARY KEY (`id`), " .
                " KEY `idx_discussions_messages_inbox_user_id` (`user_id`), " .
                " KEY `idx_discussions_messages_inbox_user_from_id` (`user_from_id`), " .
                " KEY `idx_discussions_messages_inbox_msg_date` (`msg_date`), " .
                " KEY `idx_discussions_messages_inbox_msg_time` (`msg_time`) " .
                " ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
            $db->setQuery( $sql);
            $db->query();

            // create private messages outbox table
            $sql = "CREATE TABLE IF NOT EXISTS `#__discussions_messages_outbox` ( " .
                " `id` 			int(11) NOT NULL AUTO_INCREMENT, " .
             	" `user_id`		INTEGER UNSIGNED DEFAULT 0, " .
                " `user_to_id`	INTEGER UNSIGNED DEFAULT 0, " .
             	" `msg_date`      DATE DEFAULT NULL, " .
                " `msg_time`      TIME DEFAULT NULL, " .
             	" `subject`       VARCHAR(80) DEFAULT NULL, " .
                " `message`       TEXT, " .
             	" `flag_read`     TINYINT(1) DEFAULT 0, " .
                " `flag_answered` TINYINT(1) DEFAULT 0, " .
             	" `flag_deleted`  TINYINT(1) DEFAULT 0, " .
                " PRIMARY KEY (`id`), " .
                " KEY `idx_discussions_messages_outbox_user_id` (`user_id`), " .
                " KEY `idx_discussions_messages_outbox_user_to_id` (`user_to_id`), " .
                " KEY `idx_discussions_messages_outbox_msg_date` (`msg_date`), " .
                " KEY `idx_discussions_messages_outbox_msg_time` (`msg_time`) " .
                " ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
            $db->setQuery( $sql);
            $db->query();


            // if Primezilla is installed -> get messages profile settings from Primezilla
            $db->setQuery( 'SELECT COUNT(*) FROM `#__primezilla_users`');

            if ( $db->loadResult() > 0) { // records in users found -> transfer profile data to extended discussions profile

                $db->setQuery( "UPDATE `#__discussions_users d`, `#__primezilla_users p` " .
                                " SET " . $db->quoteName('d.messages_email_notifications') . " = " . $db->quoteName('p.email_notifications') . ", " .
                                        $db->quoteName('d.messages_use_signature') . " = " . $db->quoteName('p.use_signature') . ", " .
                                        $db->quoteName('d.messages_use_signature_for_replies') . " = " . $db->quoteName('p.use_signature_for_replies') . ", " .
                                        $db->quoteName('d.messages_signature') . " = " . $db->quoteName('p.signature') .
                                " WHERE d.id = p.id");
                $db->query();

            }

            // check if Primezilla inbox transfer is needed
            $db->setQuery( 'SELECT COUNT(*) FROM `#__discussions_messages_inbox`');
            if ( $db->loadResult() == 0) { // no records in Discussions inbox found -> transfer them from Primezilla

                // if Primezilla is installed -> get all inbox messages from Primezilla
                $db->setQuery( 'SELECT COUNT(*) FROM `#__primezilla_inbox`');

                if ( $db->loadResult() > 0) { // records in inbox found -> transfer them into new discussions inbox

                    $db->setQuery( "INSERT INTO `#__discussions_messages_inbox` " .
                                        " ( id, user_id, user_from_id, msg_date, msg_time, subject, message) " .
                                        " SELECT id, user_id, user_from_id, msg_date, msg_time, subject, message " .
                                    " FROM `#__primezilla_inbox`");
                    $db->query();

                }

            }

            // check if Primezilla outbox transfer is needed
            $db->setQuery( 'SELECT COUNT(*) FROM `#__discussions_messages_outbox`');
            if ( $db->loadResult() == 0) { // no records in Discussions outbox found -> transfer them from Primezilla

                // if Primezilla is installed -> get all outbox messages from Primezilla
                $db->setQuery( 'SELECT COUNT(*) FROM `#__primezilla_outbox`');

                if ( $db->loadResult() > 0) { // records in outbox found -> transfer them into new discussions outbox

                    $db->setQuery( "INSERT INTO `#__discussions_messages_outbox` " .
                                        " ( id, user_id, user_to_id, msg_date, msg_time, subject, message) " .
                                        " SELECT id, user_id, user_to_id, msg_date, msg_time, subject, message " .
                                    " FROM `#__primezilla_outbox`");
                    $db->query();

                }

            }


        } // 1.4.1


        case "1.5": { // upgrade 1.5 -> new version

            echo "Upgrading from 1.5 to " . $version;
            echo "<br />";

            // new fields
            $sql = "ALTER TABLE `#__discussions_users` ADD COLUMN `comments_about_author` text";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_messages` ADD COLUMN `apikey_id` int(11) NOT NULL DEFAULT '0'";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_messages` ADD COLUMN `latitude` float";
            $db->setQuery( $sql);
            $db->query();

            $sql = "ALTER TABLE `#__discussions_messages` ADD COLUMN `longitude` float";
            $db->setQuery( $sql);
            $db->query();


            // new tables
            // create comments table
            $sql = "CREATE TABLE IF NOT EXISTS `#__discussions_comments` ( " .
                " `id` 			int(11) NOT NULL AUTO_INCREMENT, " .
             	" `parent_id`	int(11) NOT NULL DEFAULT 0, " .
                " `cat_id`	    int(11) NOT NULL DEFAULT 0, " .
                " `context_id`	int(11) NOT NULL DEFAULT 0, " .
                " `user_id`	    int(11) NOT NULL DEFAULT 0, " .
                " `comment`     text NOT NULL, " .
                " `created_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP, " .
                " `updated_at`  timestamp NULL DEFAULT NULL, " .
                " `published`   tinyint(1) NOT NULL DEFAULT 0, " .
                " `wfm`         tinyint(1) DEFAULT 0, " .
                " `apikey_id`   int(11) NOT NULL DEFAULT 0, " .
                " `latitude`    float, " .
                " `longitude`   float, " .
                " PRIMARY KEY (`id`), " .
                " KEY `idx_discussions_comments_parent_id` (`parent_id`), " .
                " KEY `idx_discussions_comments_cat_id` (`cat_id`), " .
                " KEY `idx_discussions_comments_context_id` (`context_id`), " .
                " KEY `idx_discussions_comments_user_id` (`user_id`), " .
                " KEY `idx_discussions_comments_created_at` (`created_at`), " .
                " KEY `idx_discussions_comments_wfm` (`wfm`), " .
                " KEY `idx_discussions_comments_apikey_id` (`apikey_id`) " .
                " ) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
            $db->setQuery( $sql);
            $db->query();


        } // 1.5


        case "1.6": { // upgrade 1.6 -> new version

            echo "Upgrading from 1.6 to " . $version;
            echo "<br />";

        }


		default: {
			break;
		}
		
	}

	// done. set new version
	$db->setQuery( "UPDATE `#__discussions_meta` SET id='1', version='" . $version . "'");
	$db->query();

	echo "Upgrade done";
	echo "<br />";
	
}



// 2. if we are doing a new installation get all users from users table
$db->setQuery( 'SELECT COUNT(*) FROM `#__discussions_users`');

if ( $db->loadResult() == 0) { // no records found = fresh installation

	$db->setQuery( "INSERT INTO `#__discussions_users` ( id, username) SELECT id, username FROM `#__users` ORDER BY id ASC");
	$db->query();

}



// 3. if there are no forums -> install some sample data
$db->setQuery( 'SELECT COUNT(*) FROM `#__discussions_categories`');

if ( $db->loadResult() == 0) { // no records found = fresh installation

	$sql = "INSERT INTO `#__discussions_categories` ( 
				id, parent_id, name, alias, description, show_image, published
			) VALUES (
				'1', '0', 'Demo Container', '', 'Top level forums act like containers', '0', '1'
			)";

	$db->setQuery( $sql);
	$db->query();
	

	$sql = "INSERT INTO `#__discussions_categories` ( 
				id, parent_id, name, alias, description, show_image, published
			) VALUES (
				'2', '1', 'Demo Forum', 'demo-forum', 'Demo Forum', '1', '1'
			)";

	$db->setQuery( $sql);
	$db->query();
		
}



echo "<br />";
echo "Have fun with Discussions " . $version;
echo "<br />";
echo "<br />";















