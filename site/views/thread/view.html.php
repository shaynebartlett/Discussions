<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');



/**
 * Thread View
 */
class DiscussionsViewThread extends JView {


	/**
     * Renders the view
     *
     */
    function display() {

		$document =& JFactory::getDocument();

		$app 		= JFactory::getApplication();

		$pathway	= &$app->getPathway();

		$CofiHelper = new CofiHelper();


		$postings               =& $this->get('Postings');
        $pagination             =& $this->get('Pagination');

        $categoryId             =& $this->get('CategoryId');
        $categorySlug           =& $this->get('CategorySlug');
        $categoryName           =& $this->get('CategoryName');
        $categoryDescription    =& $this->get('CategoryDescription');
        $categoryImage          =& $this->get('CategoryImage');

        $forumBannerTop         =& $this->get('ForumBannerTop');
        $forumBannerBottom      =& $this->get('ForumBannerBottom');
        
        $subject                =& $this->get('Subject');
        $thread             	=& $this->get('Thread');
        $threadId             	=& $this->get('ThreadId');
        $threadSlug           	=& $this->get('ThreadSlug');

        $stickyStatus           =& $this->get('StickyStatus');
        $lockedStatus           =& $this->get('LockedStatus');

        $metaDescription    	=& $this->get('MetaDescription');
        $metaKeywords          	=& $this->get('MetaKeywords');

        $htmlBoxTop             =& $this->get('HtmlBoxTop');
        $htmlBoxBottom          =& $this->get('HtmlBoxBottom');
        $socialMediaButton1     =& $this->get('SocialMediaButton1');
        $socialMediaButton2     =& $this->get('SocialMediaButton2');
        $socialMediaButton3     =& $this->get('SocialMediaButton3');


		// get parameters
		$params = &$app->getParams();


		$menus	= &JSite::getMenu();
		$menu	= $menus->getActive();

		//set breadcrumbs
		if( is_object($menu) && $menu->query['view'] != 'thread') {
			$pathway->addItem( $categoryName, 'index.php?option=com_discussions&view=category&catid=' . $this->escape( $categorySlug) );			
			$pathway->addItem( $subject, '');
		}

		
		// calculate jump point to last entry
		$_threadListLength 	= $params->get('threadListLength', '20');	
		$_numberOfPosts 	= $CofiHelper->getNumberOfPostsByThreadId( $threadId);
		$_lastPostId 		= $CofiHelper->getLastPostIdByThreadId( $threadId);
				
		if ( ( $_numberOfPosts % $_threadListLength) == 0) {
			$_start = ( $_numberOfPosts / $_threadListLength) - 1;
		}
		else {		
			$_start = floor( $_numberOfPosts / $_threadListLength);
		}

		$_start = $_start * $_threadListLength;					
		
		if ( $_start == 0) {  // first page = no limitstart
			$lastEntryJumpPoint = "#p" . $_lastPostId;		
		}
		else {
			$lastEntryJumpPoint = "&limitstart=" . $_start ."#p" . $_lastPostId;
		}
		

        $this->assignRef('htmlBoxTop', $htmlBoxTop);
        $this->assignRef('htmlBoxBottom', $htmlBoxBottom);
        $this->assignRef('socialMediaButton1', $socialMediaButton1);
        $this->assignRef('socialMediaButton2', $socialMediaButton2);
        $this->assignRef('socialMediaButton3', $socialMediaButton3);

        $this->assignRef('postings', $postings);
		$this->assignRef('pagination', $pagination);

		$this->assignRef('categoryId', $categoryId);
		$this->assignRef('categorySlug', $categorySlug);
		$this->assignRef('categoryName', $categoryName);
		$this->assignRef('categoryDescription', $categoryDescription);
		$this->assignRef('categoryImage', $categoryImage);

		$this->assignRef('forumBannerTop', $forumBannerTop);
		$this->assignRef('forumBannerBottom', $forumBannerBottom);
		
		$this->assignRef('subject', $subject);
		$this->assignRef('thread', $thread);
		$this->assignRef('threadId', $threadId);
		$this->assignRef('threadSlug', $threadSlug);	
		$this->assignRef('stickyStatus', $stickyStatus);
		$this->assignRef('lockedStatus', $lockedStatus);

		$this->assignRef('lastEntryJumpPoint', $lastEntryJumpPoint);

		$this->assignRef('params',		$params);

		$this->assignRef('metaDescription', $metaDescription);
		$this->assignRef('metaKeywords', $metaKeywords);



        // display the view
        parent::display();

    }



}
