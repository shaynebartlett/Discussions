<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	plg_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

// jimport('joomla.log.log');


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


        // Add the logger.
        /*
        JLog::addLogger(
            array(
                'text_file' => 'discussions_content_plugin.log.php'
                // 'text_file_path' => '/logs'
            )
        );
        */


    }



	function onContentBeforeDisplay($context, &$row, &$params, $page=0) {

        // logging...
        // JLog::add('onContentBeforeDisplay');
        // JLog::add('catid:' . $row->catid);

        $exclude_categories = $this->params->get('exclude_categories', '');

        if($exclude_categories) {

            $excatarray = explode(",", $exclude_categories);

            if ( in_array($row->catid, $excatarray)) {
                $show_comments = false;
            }
            else {
                $show_comments = true;
            }

        }
        else {
            $show_comments = true;
        }


        if($show_comments == true) {

            // website root directory
            $_root = JURI::root();

            $document = &JFactory::getDocument();
            $_css = $_root . 'components/com_discussions/assets/discussions.css';
            $document->addStyleSheet($_css);

            $db	=& JFactory::getDBO();

            $html = '';

            $html .= '<div class="discussionsCommentsBefore">';

                // get # of replies in this article
                $sql = "SELECT count(*) FROM ".$db->quoteName('#__discussions_comments')." WHERE parent_id=". $db->Quote($row->id) .
                        " AND published='1' AND parent_id <> '0'";

                $db->setQuery( $sql);
                $_counter_comments = $db->loadResult();

                switch ($_counter_comments) {

                    case 1: {
                        $html .= $_counter_comments . " " . JText::_('PLG_CONTENT_DISCUSSIONS_NUMBER_COMMENTS_SINGULAR');
                        break;
                    }
                    default: {
                        $html .= $_counter_comments . " " . JText::_('PLG_CONTENT_DISCUSSIONS_NUMBER_COMMENTS_PLURAL');
                        break;
                    }

                }

            $html .= "</div>";

            return $html;

        } // if show_comments

	}


	function onContentAfterDisplay($context, &$row, &$params, $page=0) {

        // logging...
        // JLog::add('onContentAfterDisplay');
        // JLog::add('catid:' . $row->catid);

        $exclude_categories = $this->params->get('exclude_categories', '');

        if($exclude_categories) {

            $excatarray = explode(",", $exclude_categories);

            if ( in_array($row->catid, $excatarray)) {
                $show_comments = false;
            }
            else {
                $show_comments = true;
            }

        }
        else {
            $show_comments = true;
        }


        if($show_comments == true) {

            if ( $row->fulltext) {

                // website root directory
                $_root = JURI::root();

                $db	=& JFactory::getDBO();

                $document = &JFactory::getDocument();
                $_css = $_root . 'components/com_discussions/assets/discussions.css';
                $document->addStyleSheet($_css);

                require_once(JPATH_SITE.'/components/com_discussions/classes/helper.php');

                $CofiHelper = new CofiHelper();

                $user =& JFactory::getUser();

                $html = '';

                $html .= '<br />';

                $html .= '<div class="discussionsCommentsAfter">';


                $html .= "<h3>";
                    $html .= JText::_('PLG_CONTENT_DISCUSSIONS_ABOUT_AUTHOR');
                $html .= "</h3>";

                $html .= '<div class="discussionsCommentsAboutAuthor">';

                    $_avatar       = $CofiHelper->getAvatarById( $row->created_by);
                    $_about_author = $CofiHelper->getAboutAuthorById( $row->created_by);

                    $html .= "<div class='cofiCommentsAboutAuthorAvatarBox'>";

                        if ( $_avatar == "") { // display default avatar
                            $html .= "<img src='" . $_root . "components/com_discussions/assets/users/user.png' width='128' height='128' class='cofiCategoryDefaultAvatar' alt='$row->created_by_alias' title='$row->created_by_alias' />";
                        }
                        else { // display uploaded avatar
                            $html .= "<img src='" . $_root . "images/discussions/users/".$row->created_by."/large/".$_avatar."' width='128' height='128' class='cofiCategoryAvatar' alt='$row->created_by_alias' title='$row->created_by_alias' />";
                        }

                    $html .= "</div>";


                    $html .= "<div class='cofiCommentAboutAuthorText'>";

                        $html .= $_about_author;

                    $html .= "</div>";


                $html .= '</div>';


                $html .= '<br style="clear: left;" />';

                // show Number of Comments
                // get # of replies in this article
                $sql = "SELECT count(*) FROM ".$db->quoteName('#__discussions_comments')." WHERE parent_id=". $db->Quote($row->id) .
                        " AND published='1' AND parent_id <> '0'";

                $db->setQuery( $sql);
                $_counter_comments = $db->loadResult();

                switch ( $_counter_comments) {

                    case 0: {

                        $html .= "<h3>";
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_NO_COMMENTS_TO_1');
                            $html .= $row->title;
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_NO_COMMENTS_TO_2');
                        $html .= "</h3>";

                        break;

                    }

                    case 1: {

                        $html .= "<h3>";
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_SHOWING_ONE_COMMENT_TO_1');
                            $html .= $row->title;
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_SHOWING_ONE_COMMENT_TO_2');
                        $html .= "</h3>";

                        break;

                    }

                    default: {

                        $html .= "<h3>";
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_SHOWING_COMMENTS_TO_1');
                            $html .= $_counter_comments;
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_SHOWING_COMMENTS_TO_2');
                            $html .= $row->title;
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_SHOWING_COMMENTS_TO_3');
                        $html .= "</h3>";

                        break;

                    }

                }

                // loop through Comments
                $sql_comments = "SELECT user_id, comment, DATE_FORMAT( created_at, '%d.%m.%Y %H:%i') AS comment_date FROM " . $db->quoteName( '#__discussions_comments') .
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

                    $html .= '<br />';
                        $html .= "<h3>";
                            $html .= JText::_('PLG_CONTENT_DISCUSSIONS_PLEASE_LOGIN');
                        $html .= "</h3>";
                    $html .= '<br />';

                }
                else { // registered or above -> comments

                    $html .= "<script type='text/javascript'>";

                    $html .= "Joomla.submitbutton = function confirmnotices(pressbutton) { ";

                    $html .= "var form = document.getElementById('commentform');";

                    $html .= "if (form.comment.value == '') { ";
                    $html .= "alert( '" . JText::_('PLG_CONTENT_DISCUSSIONS_ALERT_COMMENT_MUST_HAVE_TEXT') . "');";
                    $html .= "return false;";
                    $html .= "}";

                    $html .= "if (form.comment.value.length < 5) { ";
                    $html .= "alert( '" . JText::_('PLG_CONTENT_DISCUSSIONS_ALERT_COMMENT_TEXT_TOO_SHORT') . "');";
                    $html .= "return false;";
                    $html .= "}";

                    $html .= "form.submit();";

                    $html .= "}";

                    $html .= "</script>";

                    $html .= '<br />';
                    $html .= "<h3>";
                        $html .= JText::_('PLG_CONTENT_DISCUSSIONS_LEAVE_COMMENT');
                    $html .= "</h3>";

                    $html .= JText::_('PLG_CONTENT_DISCUSSIONS_COMMENT_TEASER');
                    $html .= '<br />';
                    $html .= '<br />';

                    $link = "index.php?option=com_discussions&view=comment";
                    $wdycf = JURI::current();

                    $html .= "<form action='" . $link . "' method='post' name='commentform' id='commentform'>";

                    $html .= "<strong>";
                        $html .= JText::_('PLG_CONTENT_DISCUSSIONS_YOUR_COMMENT');
                    $html .= "</strong>";
                    $html .= '<br />';
                    $html .= '<br />';

                    $html .= "<textarea name='comment' cols='100' rows='10' wrap='VIRTUAL' id='comment' style='width: 500px;'>";

                    $html .= "</textarea>";

                    $html .= "<br />";

                    $html .= "<input type='hidden' name='context_id' id='context_id' value='1'>"; // 1 = Article
                    $html .= "<input type='hidden' name='cat_id' id='cat_id' value='" . $row->catid ."'>";
                    $html .= "<input type='hidden' name='parent_id' id='parent_id' value='" . $row->id ."'>";

                    $html .= "<input type='hidden' name='wdycf' id='wdycf' value='" . $wdycf ."'>";

                    $html .= "<input type='hidden' name='published' id='published' value='0'>";
                    $html .= "<input type='hidden' name='wfm' id='wfm' value='0'>";


                    $html .= "<br />";
                    $html .= "<input class='cofiButton' type='submit' name='submit' onclick='return Joomla.submitbutton()' value='" . JText::_('PLG_CONTENT_DISCUSSIONS_SUBMIT_COMMENT') ."'>";

                    $html .= "</form>";

                }
                // comment form

                $html .= "</div>\n<br />\n";

                $html .= '<br />';
                $html .= '<br />';

                return $html;

            } // if fulltext

        } // if show_comments

	}


}



