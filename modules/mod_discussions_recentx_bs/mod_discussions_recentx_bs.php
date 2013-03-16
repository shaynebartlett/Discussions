<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	mod_discussions_recentx_bs
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

defined('_JEXEC') or die('Restricted access');


$_number 			= $params->get( 'number', 5 );
$_replies 			= $params->get( 'replies', 'replies' );
$_show_history 	    = $params->get( 'show_history', 1 );
$_history 			= $params->get( 'history', 'History' );
$_hours 			= $params->get( 'hours', 'h' );
$_show_poweredby 	= $params->get( 'show_poweredby', 1 );


$db		  =& JFactory::getDBO();

$posts = null;

$query = 'SELECT m.id as msg_id, m.alias, m.cat_id, c.id, c.alias, c.name, m.thread, m.subject,' .
			' CASE WHEN CHAR_LENGTH(m.alias) THEN CONCAT_WS(\':\', m.thread, m.alias) ELSE m.thread END as mslug,' .
			' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END as cslug,' .
			' DATE_FORMAT( m.last_entry_date, "%d.%m.%Y %k:%i") AS createdate' .
			' FROM #__discussions_messages m, #__discussions_categories c' .
			' WHERE m.parent_id=0 AND m.cat_id=c.id AND m.published=1 AND c.private = 0' .
			' ORDER BY m.last_entry_date DESC LIMIT ' . $_number;

$db->setQuery($query);
$posts = $db->loadObjectList();

if ($db->getErrorNum()) {
	JError::raiseWarning( 500, $db->stderr() );
}
?>


<div class="well">


<h5 style="margin: 0px 0px 10px 0px;">Recent Active Forum Topics</h5>


<?php

if (count($posts)) {
	
    foreach ($posts as $post) {

		// get Discussions Itemid	
		$sqlitemid = "SELECT id FROM ".$db->quoteName( '#__menu')." WHERE link LIKE '%com_discussions%' AND level = '1' AND published = '1'";
		$db->setQuery( $sqlitemid);
		$itemid = $db->loadResult();	

	
		// get # of replies for this thread	
		$sql = "SELECT count(*) FROM ".$db->quoteName( '#__discussions_messages')." WHERE thread='".$post->msg_id."' AND parent_id != '0' AND published = '1'";
		$db->setQuery( $sql);
		$replies = $db->loadResult();	
	



			echo "<div style='margin-bottom: 5px;'>";
	

                $link = JRoute::_('index.php?option=com_discussions&view=thread&catid=' . $post->cslug . '&thread=' . $post->mslug . '&Itemid=' . $itemid);

                $_subject = strip_tags( $post->subject);

                // echo "<a href='" . $link . "' title='" . $_subject . "'>";
                echo "<a href='" . $link . "' title='" . htmlentities($_subject, ENT_QUOTES, "UTF-8") . "'>";

                    echo $_subject;

                echo "</a>";

                echo "<br>";

                echo $post->createdate;

                echo "&nbsp;&nbsp;";

                $forum_link = JRoute::_('index.php?option=com_discussions&view=category&catid=' . $post->cslug . '&Itemid=' . $itemid);
                echo "<a href='" . $forum_link . "' title=\"" . $post->name . "\" style='color: #777777;' >";
                    echo $post->name;
                echo "</a>";



            echo "</div>";


	}


}




if ( $_show_history == 1) {

	echo "<div style='margin-top: 10px;'>";

        $_linkTime4h  = JRoute::_( 'index.php?option=com_discussions&view=recent&task=recent&time=4h&Itemid=' . $itemid);
        $_linkTime8h  = JRoute::_( 'index.php?option=com_discussions&view=recent&task=recent&time=8h&Itemid=' . $itemid);
        $_linkTime12h = JRoute::_( 'index.php?option=com_discussions&view=recent&task=recent&time=12h&Itemid=' . $itemid);
        $_linkTime24h = JRoute::_( 'index.php?option=com_discussions&view=recent&task=recent&time=24h&Itemid=' . $itemid);

        echo $_history . ":&nbsp;&nbsp;&nbsp;";
    
		echo "<a href='" . $_linkTime4h . "' title='4" . $_hours ."' >4" . $_hours . "</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href='" . $_linkTime8h . "' title='8" . $_hours ."' >8" . $_hours . "</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href='" . $_linkTime12h . "' title='12" . $_hours ."' >12" . $_hours . "</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href='" . $_linkTime24h . "' title='24" . $_hours ."' >24" . $_hours . "</a>";

    echo "</div>";
}



if ( $_show_poweredby == 1) {

	echo "<div style='margin-top: 10px; font-size: smaller;'>";

		echo "Powered by <a href='http://www.codingfish.com/products/discussions' target='_blank' title='Discussions' >Discussions</a>";

	echo "</div>";

}

?>


</div>


