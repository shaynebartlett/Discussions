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

JHTML::_('stylesheet', 'discussions.css', 'components/com_discussions/assets/');

//require_once(JPATH_COMPONENT.DS.'helpers'.DS.'discussions.php');
require_once(JPATH_COMPONENT.DS.'classes/user.php');
$user =& JFactory::getUser();
$logUser = new CofiUser( $user->id);
?>

<div class="codingfish">

<?php

$document =& JFactory::getDocument();

// set page description
if ( JText::_( 'COFI_INDEX_META_DESCRIPTION') == "") {
    $pageDescription = "";
    $pageDescriptionSuffix = "";
}


// get parameters
$params = JComponentHelper::getParams('com_discussions');

// website root directory
$_root = JURI::root();


// show username / name?
$showUsernameName = $params->get('showUsernameName', 0);

// RSS feed stuff
$useRssFeeds = $params->get('useRssFeeds', 1);

if ( $useRssFeeds == 1) {

    $_RssTitle = JText::_( 'COFI_RSS_NEW_THREADS' );

    $config =& JFactory::getConfig();
    $_suffix = $config->getValue( 'config.sef_suffix' );

    if ( $_suffix == 0) { // no .html suffix
        $link 		= JRoute::_( 'index.php?option=com_discussions&format=feed');
    }
    else {
        $link 		= JRoute::_( 'index.php?option=com_discussions') . '?format=feed';
    }
    $attribs 	= array('type' => 'application/rss+xml', 'title' => $_RssTitle);

    $document->addHeadLink( $link, 'alternate', 'rel', $attribs);

}
// RSS feed stuff
?>



<!-- HTML Box Top -->
<?php
$_htmlBoxTop = $this->htmlBoxTop;

if ( $_htmlBoxTop != "") {
    echo "<div class='cofiHtmlBoxIndexTop'>";
    echo $_htmlBoxTop;
    echo "</div>";
}
?>
<!-- HTML Box Top -->



<?php
include( 'components/com_discussions/includes/topmenu.php');
?>


<!-- show moderator how many posts wait for approval -->
<?php
if ( $logUser->isModerator() == 1) {

    if ( $logUser->isApprovalNotification() == 1) {

        $countposts = CofiHelper::getPostsWFM();

        if ( $countposts > 0) { // here is something to do for the moderator
            ?>
            <center>
                <div class="cofiPostsWaitingForApproval">

                    <?php

                    $approveLink = JRoute::_('index.php?option=com_discussions&view=moderation&task=approve' );

                    echo "<a href='$approveLink' title='" . JText::_( 'COFI_APPROVE_NEW_POSTS' ) . "'>";
                    echo "<b>";
                    echo $countposts;
                    echo "</b>";

                    if ( $countposts == 1) {
                        echo " " . JText::_( 'COFI_POST_IS_WAITING_FOR_APPROVAL' );
                    }
                    else {
                        echo " " . JText::_( 'COFI_POSTS_ARE_WAITING_FOR_APPROVAL' );
                    }
                    echo "</a>";

                    ?>

                </div>
            </center>
        <?php
        }

    }
}
?>
<!-- show moderator how many posts wait for approval -->




<?php
$_lastParent = -1; // init with impossible value
foreach ( $this->categories as $category ) :

if ( $category->parent_id == 0) { // container

if ( $_lastParent == -1) { // start new table
?>

    <h2 style="padding: 0px; margin: 40px 0px 10px 0px;" >
        <?php echo $category->name; ?>
    </h2>

<table class="table">

<thead>
<tr>
    <td width="53px" align="center">
        &nbsp;
    </td>
    <th align="left"><?php echo JText::_( 'COFI_FORUM' ); ?></td>
    <th width="70px" align="center"><?php echo JText::_( 'COFI_THREADS' ); ?></td>
    <th width="70px" align="center"><?php echo JText::_( 'COFI_POSTS' ); ?></td>
    <th width="150px" align="center"><?php echo JText::_( 'COFI_LAST_ENTRY' ); ?></td>
</tr>
</thead>

<?php
}
else {
?>
</table>

    <h2 style="padding: 0px; margin: 40px 0px 10px 0px;" >
        <?php echo $category->name; ?>
    </h2>

<table class="table">

    <thead>
    <tr>
        <td width="53px" align="center">
            &nbsp;
        </td>
        <th align="left"><?php echo JText::_( 'COFI_FORUM' ); ?></td>
        <th width="70px" align="center"><?php echo JText::_( 'COFI_THREADS' ); ?></td>
        <th width="70px" align="center"><?php echo JText::_( 'COFI_POSTS' ); ?></td>
        <th width="150px" align="center"><?php echo JText::_( 'COFI_LAST_ENTRY' ); ?></td>
    </tr>
    </thead>

    <?php
    }

    $_lastParent=0;

    }
    else { // real forum

        ?>

        <tr>

            <td align="center">

                <?php
                if ( $category->image == "") {  // show default category image
                    echo "<img src='" . $_root . "components/com_discussions/assets/categories/default.png' style='border:0px;margin:5px;' />";
                }
                else {
                    echo "<img src='" . $_root . "components/com_discussions/assets/categories/".$category->image."' style='border:0px;margin:5px;' />";
                }
                ?>
            </td>


            <td>
                <?php
                if ( JText::_( 'COFI_INDEX_META_DESCRIPTION') == "") {
                    $pageDescription .= $category->name . ", ";
                }
                ?>

                <h3 style="margin: 0px 0px 0px 0px;">
                    <?php
                    $catLink = JRoute::_('index.php?option=com_discussions&view=category&catid=' . $this->escape( $category->slug) );
                    echo "<a href='$catLink' title='$category->name'>".$category->name."</a>";
                    ?>
                </h3>

                <?php
                echo $category->description;
                ?>
                <br>
            </td>


            <td align="center">

                <?php echo $category->counter_threads; ?>

            </td>


            <td align="center">

                <?php echo $category->counter_posts; ?>

            </td>


            <td align="center">

                <?php

                if ( $category->counter_posts == 0) {
                    echo JText::_( 'COFI_NO_POSTS' );
                }
                else {
                    echo $category->last_entry_date."";
                    echo "<br />";

                    if ( $showUsernameName == 1) {
                        echo JText::_( 'COFI_BY' ) . " " . $category->realname;
                    }
                    else {
                        echo JText::_( 'COFI_BY' ) . " " . $category->username;
                    }
                }
                ?>
            </td>


        </tr>


        <?php
        $_lastParent=1;
    }


    endforeach;

    ?>

</table>

<?php
// set page description
if ( JText::_( 'COFI_INDEX_META_DESCRIPTION') == "") {
    $document->setDescription( $pageDescription . $pageDescriptionSuffix);
}
?>



<?php
include( 'components/com_discussions/includes/share.php');
?>



<!-- RSS feed icon -->
<?php
$showRssFeedIcon = $params->get('showRssFeedIcon', 1);

if ( $useRssFeeds == 1 && $showRssFeedIcon == 1) {

    echo "<div style='margin: 40px 0px 30px 0px;'>";

    echo "<img src='" . $_root . "/components/com_discussions/assets/icons/rss_16.png' style='margin: 0px 10px 0px 5px;' align='top' />";

    echo "<a href='" . $link .  "'>" . $_RssTitle . "</a>";

    echo "</div>";

}
?>
<!-- RSS feed icon -->



<!-- HTML Box Bottom -->
<?php
$_htmlBoxBottom = $this->htmlBoxBottom;

if ( $_htmlBoxBottom != "") {
    echo "<div class='cofiHtmlBoxIndexBottom'>";
    echo $_htmlBoxBottom;
    echo "</div>";
}
?>
<!-- HTML Box Bottom -->


<?php
include( 'components/com_discussions/includes/footer.php');
?>

</div>


