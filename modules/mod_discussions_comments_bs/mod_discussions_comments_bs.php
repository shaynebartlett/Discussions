<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	mod_discussions_comments_bs
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

defined('_JEXEC') or die('Restricted access');


// get website root directory
$_root = JURI::root();

$_number 			= $params->get( 'number', 5 );
$_characters 		= $params->get( 'characters', 200 );
$_show_poweredby 	= $params->get( 'show_poweredby', 1 );


$db	=& JFactory::getDBO();


if ( $_number == '') { // default show all users online
	
	$query = 'SELECT c.comment, c.cat_id, c.parent_id, c.user_id, u.username, a.title, ' .
            ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', c.parent_id, a.alias) ELSE c.parent_id END as coslug ' .
			' FROM #__discussions_comments c, #__users u, #__content a ' .
			' WHERE c.user_id=u.id AND c.parent_id=a.id AND c.published=1 ' .
			' ORDER BY c.created_at DESC';
			
}
else { // limit the number of comments to show

    $query = 'SELECT c.comment, c.cat_id, c.parent_id, c.user_id, u.username, a.title, ' .
            ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', c.parent_id, a.alias) ELSE c.parent_id END as coslug ' .
   			' FROM #__discussions_comments c, #__users u, #__content a ' .
            ' WHERE c.user_id=u.id AND c.parent_id=a.id AND c.published=1 ' .
   			' ORDER BY c.created_at DESC LIMIT ' . $_number;

}


$db->setQuery($query);
$comments = $db->loadObjectList();

if ($db->getErrorNum()) {
	JError::raiseWarning( 500, $db->stderr() );
}

?>


<div class="well">

<h5 style="margin: 0px 0px 10px 0px;">Recent comments</h5>

<?php

if (count($comments)) {
	
    foreach ($comments as $comment) {

        echo "<div style='margin-bottom: 10px;'>";

            echo JHTML::_('string.truncate', strip_tags($comment->comment), $_characters);

            echo " (" . $comment->username . ")";

            echo "<br>";

            // get correct Itemid
            $_like = "%&id=" . $comment->cat_id . "%";
            $sqlitemid = "SELECT id FROM ".$db->quoteName( '#__menu')." WHERE component_id=22 AND link LIKE '" . $_like . "' AND published = '1'";

            $db->setQuery( $sqlitemid);
            $_itemid = $db->loadResult();

            $_link = JRoute::_('index.php?option=com_content&view=article&id=' . $comment->coslug .  '&catid=' . $comment->cat_id . '&Itemid=' . $_itemid);

            echo "<a href='" . $_link . "'>". $comment->title . "</a>";

        echo "</div>"; // row

	} // foreach
		
}


if ( $_show_poweredby == 1) {

    echo "<div style='margin-top: 5px; font-size: smaller;'>";

		echo "Powered by <a href='http://www.codingfish.com/products/discussions' target='_blank' title='Discussions' >Discussions</a>";

	echo "</div>";

}

?>


</div>




