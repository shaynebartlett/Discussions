<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
?>


<script type="text/javascript">
function checkboxStateAll() {

  var cbMsg = document.msgform.cb;
  var cbAll = document.msgform.cball;

  var jsMessages = "";


  if( cbAll.checked == true) { // mark all checked
    if(cbMsg.length == undefined) {
        cbMsg.checked = true;
        document.msgform.selectedMessages.value = cbMsg.value;
    }
    else {
        for(i=0; i<cbMsg.length; i++) {
            cbMsg[i].checked = true;
            if( jsMessages == "") {
                jsMessages = cbMsg[i].value;
            }
            else {
                jsMessages += " " + cbMsg[i].value;
            }
        }
        document.msgform.selectedMessages.value = jsMessages;

    }
  }
  else { // mark all unchecked
    if(cbMsg.length == undefined) {
        cbMsg.checked = false;
        document.msgform.selectedMessages.value = "";
    }
    else {
        for(i=0; i<cbMsg.length; i++) {
            cbMsg[i].checked = false;
        }
        document.msgform.selectedMessages.value = "";
    }

  }

}

function checkboxState() {

  var cbMsg = document.msgform.cb;

  var jsMessages = "";

  if( cbMsg.checked == true) { // one checkbox only
        jsMessages = cbMsg.value;
  }
  else if( cbMsg.checked == false) { // one checkbox only
        jsMessages = "";
  }
  else {
    for(i=0; i<cbMsg.length; i++) {
        if( cbMsg[i].checked == true) {
            if( jsMessages == "") {
                jsMessages = cbMsg[i].value;
            }
            else {
                jsMessages += " " + cbMsg[i].value;
            }
        }
    }
  }
  document.msgform.selectedMessages.value = jsMessages;

}
</script>

