<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
require_once(JPATH_COMPONENT.DS.'classes/helper.php');
$CofiHelper = new CofiHelper();

// get parameters
$params =& JComponentHelper::getParams('com_discussions');

$_showFooter = $params->get('showFooter', '1');
?>

<?php
if ( $_showFooter == '1' ) { // display codingfish footer
    ?>

    <div class="cofiFooter">

        <span id="cofiFooterLeft">

            <a href="http://www.codingfish.com" target="_blank" title="Codingfish" id="cofiFooterLinkCF" >
            <?php
                echo "<img src='" . $_root . "/components/com_discussions/assets/icons/codingfish_16.png' align='top' />";
            ?>
            </a>

        </span>

        <span id="cofiFooterRight">

            <a href="http://www.codingfish.com/products/discussions" target="_blank" title="Discussions v<?php echo $CofiHelper->getVersion(); ?>" id="cofiFooterLinkMP">Discussions</a>

        </span>

    </div>

    <?php
}
else {
    ?>
    <!--
    <?php echo "Codingfish Discussions v" . $CofiHelper->getVersion(); ?> http://www.codingfish.com
    -->
    <?php
}
?>
