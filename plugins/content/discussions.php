<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	plg_discussions
 * @copyright	Copyright (C) 2010-2012 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

//JHTML::_('stylesheet', 'discussions.css', 'components/com_discussions/assets/');


/**
 * Plugin for Codingfish Discussions
 *
 * @package		Joomla
 * @subpackage	Discussions
 */
class plgContentDiscussions extends JPlugin {


    public function __construct(& $subject, $config) {

   		parent::__construct($subject, $config);

   		$this->loadLanguage();

   	}


/*
	function onContentBeforeDisplay($context, &$row, &$params, $page=0) {

        $html = '';

        $html .= '<div class="discussionsCommentsBefore">';
        	$html .= "#Comments:";
		$html .= "</div>\n<br />\n";

        return $html;
	}
*/

	function onContentAfterDisplay($context, &$row, &$params, $page=0) {

        // website root directory
        $_root = JURI::root();

        $db	=& JFactory::getDBO();

        // todo make categories configurable

        if ( $row->fulltext) {

            $document = &JFactory::getDocument();
            $_css = $_root . 'components/com_discussions/assets/discussions.css';
         	$document->addStyleSheet($_css);

            require_once(JPATH_SITE.'/components/com_discussions/classes/helper.php');

            $CofiHelper = new CofiHelper();

            $user =& JFactory::getUser();

            $html = '';

            $html .= '<br />';

            // $html .= '<br />';
            // $html .= "context: " . $context;
            // $html .= '<br />';
            // e.g. com_content.article

            /*
            $html .= '<br />';
            $html .= "id: " . $row->id;
            $html .= '<br />';

            $html .= '<br />';
            $html .= "catid: " . $row->catid;
            $html .= '<br />';
            */

            /*
            $html .= '<br />';
            print_r($row);
            $html .= '<br />';
            */

            $html .= '<div class="discussionsCommentsAfter">';



            // show Number of Comments
            // get # of replies in this thread
			$sql = "SELECT count(*) FROM ".$db->nameQuote('#__discussions_comments')." WHERE parent_id=". $db->Quote($row->id) .
					" AND published='1' AND parent_id <> '0'";

			$db->setQuery( $sql);
			$_counter_comments = $db->loadResult();

            switch ( $_counter_comments) {

                case 0: {
                    $html .= "<h3>There are no comments to \"" . $row->title ."\" yet</h3>";
                    break;
                }

                case 1: {
                    $html .= "<h3>Showing 1 comment to \"" . $row->title . "\"</h3>";
                    break;
                }

                default: {
                    $html .= "<h3>Showing " . $_counter_comments . " comments to \"" . $row->title . "\"</h3>";
                    break;
                }

            }

            // loop through Comments
            $sql_comments = "SELECT user_id, comment, DATE_FORMAT( created_at, '%d.%m.%Y %H:%i') AS comment_date FROM " . $db->nameQuote( '#__discussions_comments') .
      		    		" WHERE parent_id='" . $row->id ."' AND published='1'" .
      		    		" ORDER BY created_at ASC";

            $db->setQuery( $sql_comments);

            $_comments_list = $db->loadAssocList();

            $counter = 0;

    		reset( $_comments_list);
    		while (list($key, $val) = each( $_comments_list)) {

                $counter += 1;

                $_comment_user_id    = $_comments_list[$key]['user_id'];
               	$_comment_comment    = $_comments_list[$key]['comment'];
                $_comment_created_at = $_comments_list[$key]['comment_date'];


                $_username = $CofiHelper->getUsernameById( $_comment_user_id);
                $_avatar   = $CofiHelper->getAvatarById( $_comment_user_id);


                $html .= "<div class='cofiCommentsEntry'>";

                    $html .= "<div class='cofiCommentsEntryRow1'>";

                        $html .= "<div class='cofiCommentsAvatarBox'>";

                        if ( $_avatar == "") { // display default avatar
                            $html .= "<img src='" . $_root . "components/com_discussions/assets/users/user.png' width='32' height='32' class='cofiCategoryDefaultAvatar' alt='$_username' title='$_username' />";
                        }
                        else { // display uploaded avatar
                            $html .= "<img src='" . $_root . "images/discussions/users/".$_comment_user_id."/small/".$_avatar."' width='32' height='32' class='cofiCategoryAvatar' alt='$_username' title='$_username' />";
                        }

                        $html .= "</div>";


                        $html .= "<div class='cofiCommentsUsername'>";
                            $html .= $_username;
                        $html .= "</div>";


                        $html .= "<div class='cofiCommentsCreatedAt'>";
                            $html .= $_comment_created_at;
                        $html .= "</div>";

                        $html .= "<div class='cofiCommentsCounter'>";
                            $html .= $counter;
                        $html .= "</div>";


                    $html .= "</div>"; // row1


                    $html .= "<div class='cofiCommentsEntryRow2'>";

                        $html .= "<div class='cofiCommentsComment'>";
                            // transfer emoticon code into html image code
                            $_comment_comment = $CofiHelper->replace_emoticon_tags( $_comment_comment);
                            $html .= nl2br( $_comment_comment);
                        $html .= "</div>"; // comment

                    $html .= "</div>"; // row2

                $html .= "</div>"; // CommentsEntry

            }



            $html .= '<br />';


            // comment form
            if ( $user->guest == 1) { // guest user -> no comments

                //$html .= JText::sprintf( 'PLG_VOTE_USER_RATING', $img, $rating_count );
                $html .= '<br />';
                $html .= "<h3>Please login and leave a comment</h3>";
                $html .= '<br />';

            }
            else { // registered or above -> comments

                $html .= "<script type='text/javascript'>";

                $html .= "Joomla.submitbutton = function confirmnotices(pressbutton) { ";

                $html .= "var form = document.getElementById('commentform');";

                $html .= "if (form.comment.value == '') { ";
                $html .= "alert( 'A comment must have some text. An empty text is not very helpful :-)');";
                $html .= "return false;";
                $html .= "}";

                $html .= "if (form.comment.value.length < 5) { ";
                $html .= "alert( 'The comment text is too short, please enter at least 5 characters');";
                $html .= "return false;";
                $html .= "}";

                $html .= "form.submit();";

                $html .= "}";

                $html .= "</script>";


                $html .= '<br />';
                $html .= "<h3>Leave a comment</h3>";


                $html .= "Wanna leave a comment? Great idea! You found the right place :-) ";
                $html .= "Please note that my comments are moderated, so don't waste your (and my) time with spam comments. ";
                $html .= "Let's have a nice conversation.";
                $html .= '<br />';
                $html .= '<br />';

                $link = "index.php?option=com_discussions&view=comment";
                $wdycf = JURI::current();

                $html .= "<form action='" . $link . "' method='post' name='commentform' id='commentform'>";

                $html .= "<strong>Your comment</strong>";
                $html .= '<br />';
                $html .= '<br />';

                $html .= "<textarea name='comment' cols='100' rows='10' wrap='VIRTUAL' id='comment'>";

                $html .= "</textarea>";

                $html .= "<br />";


                $html .= "<input type='hidden' name='context_id' id='context_id' value='1'>"; // 1 = Article
                $html .= "<input type='hidden' name='cat_id' id='cat_id' value='" . $row->catid ."'>";
                $html .= "<input type='hidden' name='parent_id' id='parent_id' value='" . $row->id ."'>";

                $html .= "<input type='hidden' name='wdycf' id='wdycf' value='" . $wdycf ."'>";

                $html .= "<input type='hidden' name='published' id='published' value='0'>";
                $html .= "<input type='hidden' name='wfm' id='wfm' value='0'>";


                $html .= "<br />";
                $html .= "<input class='cofiButton' type='submit' name='submit' onclick='return Joomla.submitbutton()' value=' Submit comment '>";

                $html .= "</form>";

            }
            // comment form




            $html .= "</div>\n<br />\n";

            $html .= '<br />';
            $html .= '<br />';

            return $html;

        } // if fulltext

	}


}



