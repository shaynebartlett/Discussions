<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	mod_discussions_onliners
 * @copyright	Copyright (C) 2010-2012 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

defined('_JEXEC') or die('Restricted access');
?>

<style type="text/css">

.cofiModCommentsRow {
    margin: 5px 0px 0px 0px;
}
.cofiModCommentsUsername {
    font-weight: bold;
	margin: 0px 0px 0px 0px;
	overflow: hidden;
}
.cofiModCommentsComment {
	margin: 0px 0px 0px 0px;
	overflow: hidden;
}
.cofiModCommentsArticle {
    margin: 0px 0px 10px 0px;
}
.cofiModCommentsPoweredByText {
	margin-top: 5px;
	margin-bottom: 0px;
	color: #777777;
	font-size: 9px;
}

</style>


<?php

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


if (count($comments)) {
	
    foreach ($comments as $comment) {

		echo "<div class='cofiModCommentsRow'>";

            echo "<div>";

                echo "<span class='cofiModCommentsUsername'>";

                    echo $comment->username . ": ";

                echo "</span>";

                echo "<span class='cofiModCommentsComment'>";

                    echo JHTML::_('string.truncate', strip_tags($comment->comment), $_characters);

                echo "</span>";

            echo "</div>";

            echo "<div class='cofiModCommentsArticle'>";

                // get correct Itemid
                $_like = "%&id=" . $comment->cat_id . "%";
                $sqlitemid = "SELECT id FROM ".$db->quoteName( '#__menu')." WHERE component_id=22 AND link LIKE '" . $_like . "' AND published = '1'";

                $db->setQuery( $sqlitemid);
                $_itemid = $db->loadResult();

                $_link = JRoute::_('index.php?option=com_content&view=article&id=' . $comment->coslug .  '&catid=' . $comment->cat_id . '&Itemid=' . $_itemid);

                echo "<a href='" . $_link . "'>". $comment->title . "</a>";

            echo "</div>";

		echo "</div>";
							
	}
		
}


if ( $_show_poweredby == 1) {
	//echo "<br style='clear:left;'/>";
	
	echo "<div class='cofiModCommentsPoweredByText'>";
		echo "Powered by <a href='http://www.codingfish.com/products/discussions' target='_blank' title='Discussions' >Discussions</a>";
	echo "</div>";
}	





