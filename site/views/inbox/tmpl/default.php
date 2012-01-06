<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2011 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('stylesheet', 'discussions.css', 'components/com_discussions/assets/');

include( 'components/com_discussions/includes/functions.php');


require_once(JPATH_COMPONENT.DS.'classes/user.php'); 
require_once(JPATH_COMPONENT.DS.'classes/helper.php');

echo "<script type='text/javascript'>";
	echo "function confirmdelete() { ";
 		echo "return confirm('" . JText::_( 'COFI_CONFIRM_DELETE_MARKED_MESSAGES' ) . "');";
	echo "}"; 	
echo "</script>";
?>

<div class="codingfish">

<?php
$app = JFactory::getApplication();

// set page title and description
$document =& JFactory::getDocument(); 

$title = $document->getTitle();
$siteName = $app->getCfg('sitename');

$document->setTitle( $title); 



$user =& JFactory::getUser();
$logUser = new CUser( $user->id);

$cHelper = new CHelper();

// get parameters
$params = JComponentHelper::getParams('com_primezilla');

$_useDiscussionsAvatars = $params->get('useDiscussionsAvatars', 0);


// website root directory
$_root = JURI::root();
?>





<?php 
if ( $this->params->def( 'show_page_title', 1 ) ) : 
	?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php 
endif; 
?>



<!-- HTML Box Top -->
<?php
$htmlBoxInboxTop = $params->get('htmlBoxInboxTop', '');

if ( $htmlBoxInboxTop != "") {
	echo "<div class='cofiHtmlBoxCategoryTop'>";
		echo $htmlBoxInboxTop;
	echo "</div>";
}
?>
<!-- HTML Box Top -->



<?php
include( 'components/com_primezilla/includes/topmenu.php');
?>



<!-- Box name and description -->
<table width="100%" class="noborder">
    <tr>

        <!-- box name and description -->
        <td align="left" class="noborder">
            <?php
            echo "<h2>";
            	echo JText::_( "COFI_INBOX");
            echo "</h2>";
            ?>
        </td>
        <!-- box name and description -->


    </tr>
</table>
<!-- Box name and description -->



<?php
	echo "<table width='50%'  class='noborder' style='margin:20px 0px 20px 0px; border: 0px;'>";
    	echo "<tr>";       	

        	echo "<td width='16' align='center' valign='middle' class='noborder' style='border: 0px;'>";
            	echo "<img src='" . $_root . "/components/com_primezilla/assets/system/new.gif' style='margin-left: 5px; margin-right: 5px; border:0px;' />";
        	echo "</td>";
        	echo "<td align='left' valign='middle' class='noborder' style='border: 0px;'>";
            	$menuLinkNewTMP = "index.php?option=com_primezilla&view=message&task=new";
            	$menuLinkNew = JRoute::_( $menuLinkNewTMP);
            	echo "<a href='".$menuLinkNew."'>" . JText::_( 'COFI_NEW_MESSAGE' ) . "</a>";
        	echo "</td>";        
        	
    	echo "</tr>";
	echo "</table>";
?>



<!-- Pagination Links -->
<div class="pagination">

<table width="100%" class="noborder" style="margin-bottom:10px; border: 0px;">
    <tr>
        <td class="noborder" style="border: 0px;">
            <?php
            echo $this->pagination->getPagesLinks();
            ?>
        </td>
        <td class="noborder" style="border: 0px;">
            <p class="counter">
            <?php
            echo $this->pagination->getPagesCounter();
            ?>
            </p>
        </td>

    </tr>
</table>
    
</div>
<!-- Pagination Links -->




<form action="" method="post" name="msgform" id="msgform">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder">

    <tr> 
    
		<td width="20px"  align="center" class="cofiTableHeader">
		
			<input type="checkbox" name="cball" onclick="checkboxStateAll()" class="inputbox" />
			
		</td>

		<?php
		if ( $_useDiscussionsAvatars == 1) {
			?>		
			
			<td width="200px" align="left" class="cofiTableHeader"><?php echo JText::_( 'COFI_FROM' ); ?></td>

		<?php
		}
		else {
			?>
		
			<td width="150px" align="left" class="cofiTableHeader"><?php echo JText::_( 'COFI_FROM' ); ?></td>
		
			<?php
		} 
		?>
		
        <td align="left" class="cofiTableHeader"><?php echo JText::_( 'COFI_SUBJECT' ); ?></td>
        
        
		<td width="170px" align="center" class="cofiTableHeader"><?php echo JText::_( 'COFI_DATE' ); echo " / "; echo JText::_( 'COFI_TIME' ); ?></td> 
						
    </tr> 



	<?php 
	$rowColor = 1;
	
	foreach ( $this->messages as $message ) : ?>

    	<tr> 

			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexTableRowReplies">	
			
				<input type="checkbox" name="cb" value="<?php echo $message->id; ?>" onclick="checkboxState()" class="inputbox" />
				
			</td> 

			<?php
			if ( $_useDiscussionsAvatars == 1) {
				?>					

				<td align="left" class="cofiIndexTableRowAvatar<?php echo $rowColor; ?> cofiIndexTableRowTopic">	
			
				<?php
			}
			else {
				?>

				<td align="left" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexTableRowTopic">			
			
				<?php
			} 
			?>
									
				
				<?php
				
				$_username = $cHelper->getUsernameById( $message->user_from_id);
				
                if ( $_useDiscussionsAvatars == 1) {
                    $_avatar   = $cHelper->getAvatarFromDiscussionsById( $message->user_from_id);
                }

                echo "<table width='100%' cellspacing='0' cellpadding='0' border='0' class='noborder'>";
                    echo "<tr>";

                        if ( $_useDiscussionsAvatars == 1) {

                            echo "<td width='32' align='left' class='noborder'>";

                                echo "<div class='cofiAvatarBox'>";
                                    if ( $_avatar == "") { // display default avatar
                                        echo "<img src='" . $_root . "components/com_discussions/assets/users/user.png' width='32px' height='32px' class='cofiCategoryDefaultAvatar' alt='$_username' title='$_username' />";
                                    }
                                    else { // display uploaded avatar
                                        echo "<img src='" . $_root . "images/discussions/users/".$message->user_from_id."/small/".$_avatar."' width='32px' height='32px' class='cofiCategoryAvatar' alt='$_username' title='$_username' />";
                                    }
                                echo "</div>";

                            echo "</td>";

                        }

                        if ( $_useDiscussionsAvatars == 1) {
                            echo "<td align='left' valign='center' class='noborder' style='padding-left: 5px;'>";
                        }
                        else {
                            echo "<td align='left' valign='center' class='noborder'>";
                        }


						if ( $message->flag_read == 0) { // new message
							                        
							echo "<span class='cofiMessageUnread'>";
	                        	echo $_username;
							echo "</span>";
	                        
						}
						else {

							echo "<span class='cofiMessageRead'>";
	                        	echo $_username;
							echo "</span>";
						
						}

                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
				
				?>
								
			</td> 


			<td align="left" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexTableRowTopic">

                <?php
                
            	$_hoverSubject = $message->subject;
            	$_hoverSubject = str_replace( '\'', '"', $_hoverSubject);
            	//$_hoverSubject = addslashes($thread->subject);
                                            
                $messageLink = JRoute::_('index.php?option=com_primezilla&view=message&task=inbox&id='.$message->id);

				if ( $message->flag_read == 0) {// new message
                	echo "<a href='$messageLink' title='".$_hoverSubject."' class='cofiMessageUnread'>".$message->subject."</a>";					
				}
				else {
                	echo "<a href='$messageLink' title='".$_hoverSubject."' class='cofiMessageRead'>" . $message->subject . "</a>";
                }
					
                ?>

			</td> 

									
			<td align="center" class="cofiIndexTableRow<?php echo $rowColor; ?> cofiIndexTableRowLastPost">

                <?php
				if ( $message->flag_read == 0) {// new message
					echo "<span class='cofiMessageUnread'>";
            			echo $message->msg_date;
					echo "</span>";
				}
				else {
					echo "<span class='cofiMessageRead'>";
            			echo $message->msg_date;
					echo "</span>";
                }                			                			

				echo "&nbsp;";

				if ( $message->flag_read == 0) {// new message
					echo "<span class='cofiMessageUnread'>";
            			echo $message->msg_time;
					echo "</span>";
				}
				else {
					echo "<span class='cofiMessageRead'>";
            			echo $message->msg_time;
					echo "</span>";
                }                			                			
                ?>

			</td> 
		
		
    	</tr> 




		<?php 
		// toggle row color
		if ( $rowColor == 1) {
			$rowColor = 2;
		}
		else {
			$rowColor = 1;
		}

	endforeach; 
	?>

</table>


<div style="text-align: left;">

	<div class="cofiTextButton">
	
		<input type="hidden" name="selectedMessages" value="" />
		
		<input type="submit" name="submit" class="cofiButton" value="<?php echo JText::_( 'COFI_BUTTON_DELETE' );?>" onclick="return confirmdelete();" />
		&nbsp;
		<input type="submit" name="submit" class="cofiButton" value="<?php echo JText::_( 'COFI_BUTTON_MARK_READ' );?>" />
		&nbsp;
		<input type="submit" name="submit" class="cofiButton" value="<?php echo JText::_( 'COFI_BUTTON_MARK_UNREAD' );?>" />
	
	</div>

</div>

</form>



<!-- Pagination Links -->
<div class="pagination">

<table width="100%" class="noborder" style="margin-top:10px; border: 0px;">
    <tr> 
        <td class="noborder" style="border: 0px;">
            <?php
            echo $this->pagination->getPagesLinks();
            ?>
        </td>
        <td class="noborder" style="border: 0px;">
            <p class="counter">
            <?php
            echo $this->pagination->getPagesCounter();
            ?>
            </p>
        </td>

    </tr>
</table>

</div>
<!-- Pagination Links -->



<!-- HTML Box Bottom -->
<?php
$htmlBoxInboxBottom = $params->get('htmlBoxInboxBottom', '');		

if ( $htmlBoxInboxBottom != "") {
	echo "<div class='cofiHtmlBoxInboxBottom'>";
		echo $htmlBoxInboxBottom;
	echo "</div>";
}
?>
<!-- HTML Box Bottom -->


<br />
<br />
 
<?php
include( 'components/com_primezilla/includes/footer.php');
?>

</div>


