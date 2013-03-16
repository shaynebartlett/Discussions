<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
  
defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip');


echo "<div>";

	$rows = &$this->messagesInboxQuickStats;

	echo "<br />";
	echo "<h2>";
	echo JText::_('COFI_INBOX_USAGE');
	echo "</h2>";

	echo "<table width='100%' cellspacing='1' cellpadding='3' >";

 				echo "<thead>";

   					echo "<tr>";

   						echo "<td width='150px'>";
   							echo JText::_('COFI_USER');
   						echo "</td>";

   						echo "<td>";
   							echo JText::_('COFI_INBOX_COUNT');
   						echo "</td>";

   					echo "</tr>";

 				echo "</thead>";

 				echo "<tbody>";

		foreach ( $rows as $row) {

			$link = JRoute::_( 'index.php?option=com_discussions&view=user&task=edit&cid[]='. $row->user_id );

			?>

			<tr>

				<td valign="top">
					<?php
					echo "<a href='" . $link . "'>";
						echo $row->username;
					echo "</a>";
					?>
				</td>

				<td valign="top">
					<?php
					echo $row->counter;
					?>
				</td>


			</tr>

			<?php
		}

		echo "</tbody>";

	echo "</table>";



	$rows = &$this->messagesOutboxQuickStats;

	echo "<br />";
	echo "<h2>";
	echo JText::_('COFI_OUTBOX_USAGE');
	echo "</h2>";

	echo "<table width='100%' cellspacing='1' cellpadding='3' >";

 				echo "<thead>";

   					echo "<tr>";

   						echo "<td width='150px'>";
   							echo JText::_('COFI_USER');
   						echo "</td>";

   						echo "<td>";
   							echo JText::_('COFI_OUTBOX_COUNT');
   						echo "</td>";

   					echo "</tr>";

 				echo "</thead>";

 				echo "<tbody>";

		foreach ( $rows as $row) {

			$link = JRoute::_( 'index.php?option=com_discussions&view=user&task=edit&cid[]='. $row->user_id );

			?>

			<tr>

				<td valign="top">
					<?php
					echo "<a href='" . $link . "'>";
						echo $row->username;
					echo "</a>";
					?>
				</td>

				<td valign="top">
					<?php
					echo $row->counter;
					?>
				</td>


			</tr>

			<?php
		}

		echo "</tbody>";

	echo "</table>";



	echo "<br />";
	echo "<h2>";
	echo JText::_('COFI_MAILBOX_USAGE');
	echo "</h2>";

	echo "<table width='100%' cellspacing='1' cellpadding='3' >";

 				echo "<thead>";

   					echo "<tr>";

   						echo "<td width='150px'>";
   							echo JText::_('COFI_MAILBOX');
   						echo "</td>";

   						echo "<td>";
   							echo JText::_('COFI_MAILBOX_COUNT');
   						echo "</td>";

   					echo "</tr>";

 				echo "</thead>";


 				echo "<tbody>";

			echo "<tr>";

				echo "<td>";
					echo JText::_('COFI_INBOX');
				echo "</td>";

				echo "<td>";
					echo "<b>";
					echo $this->messagesTotalInboxCount;
					echo "</b>";
				echo "</td>";

			echo "</tr>";

			echo "<tr>";

				echo "<td>";
					echo JText::_('COFI_OUTBOX');
				echo "</td>";

				echo "<td>";
					echo "<b>";
					echo $this->messagesTotalOutboxCount;
					echo "</b>";
				echo "</td>";

			echo "</tr>";

 				echo "</tbody>";


	echo "</table>";

	echo "<br />";

echo "</div>";





