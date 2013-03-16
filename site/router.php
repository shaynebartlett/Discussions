<?php 
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
defined( '_JEXEC' ) or die( 'Restricted access' ); 


function DiscussionsBuildRoute( &$query) { 

    $segments = array(); 
    
	/*    
    if (isset( $query['view'])) { 
        $segments[] = $query['view']; 
        unset( $query['view']); 
    } 
	*/
    unset( $query['view']); 


    if (isset( $query['task'])) { 
        $segments[] = $query['task']; 
        unset( $query['task']); 
    }
        
    if (isset( $query['catid'])) { 
        $segments[] = $query['catid']; 
        unset( $query['catid']); 
    }

    if (isset( $query['thread'])) { 
        $segments[] = $query['thread']; 
        unset( $query['thread']); 
    }

    if (isset( $query['parent'])) { 
        $segments[] = $query['parent']; 
        unset( $query['parent']); 
    }
    
    if (isset( $query['id'])) { 
        $segments[] = $query['id']; 
        unset( $query['id']); 
    }

    if (isset( $query['recent'])) {
        $segments[] = $query['recent'];
        unset( $query['recent']); 
    }
    if (isset( $query['time'])) {
        $segments[] = $query['time'];
        unset( $query['time']); 
    }

    if (isset( $query['limitstart'])) { 
        unset( $query['limitstart']);
    }

    if (isset( $query['catidto'])) { 
        $segments[] = $query['catidto']; 
        unset( $query['catidto']); 
    }

    if (isset( $query['userid'])) { 
        $segments[] = $query['userid']; 
        unset( $query['userid']); 
    }

    if (isset( $query['post'])) { 
        $segments[] = $query['post']; 
        unset( $query['post']); 
    }

    if (isset( $query['format'])) { 
        $segments[] = $query['format']; 
        unset( $query['format']); 
    }

    if (isset( $query['profile'])) {
        $segments[] = $query['profile'];
        unset( $query['profile']);
    }

    if (isset( $query['inbox'])) {
        $segments[] = $query['inbox'];
        unset( $query['inbox']);
    }

    if (isset( $query['outbox'])) {
        $segments[] = $query['outbox'];
        unset( $query['outbox']);
    }

    return $segments; 
    
}


function DiscussionsParseRoute( $segments) { 

    $vars = array(); 
        
    $count = count ( $segments);

/*
    echo "count: " . $count;
    echo "<br />";

    echo "segments 0: " . $segments[0];
    echo "<br />";
    echo "segments 1: " . $segments[1];
    echo "<br />";
    echo "segments 2: " . $segments[2];
    echo "<br />";

    die();
*/

    switch ( $count) {
    
		case 1: {			
			
			switch ( $segments[0]) {
			
				case 'profile': {
        			$vars['view'] = "profile"; 				
					break;
				}		

                case 'inbox': {
                    $vars['view'] = "inbox";
                    $vars['task']  = $segments[0];
            		break;
            	}

                case 'outbox': {
                    $vars['view'] = "outbox";
                    $vars['task']  = $segments[0];
            		break;
            	}

                case 'msg_new': {
                    $vars['view'] = "message";
            		$vars['task'] = "msg_new";
            	    break;
            	}

				case 'approve': {
        			$vars['view'] = "moderation";
        			$vars['task']  = $segments[0];
					break;
				}		

                case 'recent': {
                    $vars['view'] = "recent";
                    $vars['task']  = $segments[0];
                    $vars['time']  = "24h";         // default = 24h
                    break;
                }

				case 'feed': {
        			$vars['view']   = "index"; 				
        			$vars['task']   = "feed";
        			$vars['format'] = "feed";
					break;
				}		

				default: {	
					// category view
		        	$vars['view'] = "category"; 			
		        	$vars['catid'] = $segments[0]; // category slug
					break;		        	
        		}
        	}
        				
			break;
		}
    

		case 2: {			
			
			switch ( $segments[0]) {
			
				case 'new': {
        			$vars['view']  = "posting"; 				
        			$vars['task']  = $segments[0];   // task = new 
		        	$vars['catid'] = $segments[1];   // category slug
					break;
				}		

				case 'accept':
				case 'deny': {
        			$vars['view']  = "moderation"; 				
        			$vars['task']  = $segments[0];   // task = accept/deny
        			$vars['post']  = $segments[1];   // post id
					break;
				}		

				case 'delete': {
        			$vars['view']  = "moderation"; 
        			$vars['task']  = $segments[0];   // task = delete
        			$vars['post']  = $segments[1];   // post = post id
        			
					break;
				}		

                case 'recent': {
                    $vars['view'] = "recent";
                    $vars['task']  = $segments[0];
                    $vars['time']  = $segments[1];  // time = xxh
                    break;
                }

                case 'inbox': {
                    $vars['view'] = "message";
                    $vars['task'] = "inbox";
                    $vars['type'] = "inbox";
                    $vars['id']   = $segments[1]; // message id
            		break;
            	}

                case 'outbox': {
                    $vars['view'] = "message";
                    $vars['task'] = "outbox";
                    $vars['type'] = "outbox";
                    $vars['id']   = $segments[1]; // message id
            		break;
            	}

                case 'msg_new': {
                    $vars['view'] = "message";
            		$vars['task'] = "msg_new";
            		$vars['userid'] = $segments[1]; // userid
            	    break;
            	}

                case 'msg_reply': {
                    $vars['view']   = "message";
            		$vars['task'] 	= "msg_reply";
            		$vars['id'] 	= $segments[1]; // message id
            		break;
            	}

                case 'msg_quote': {
                    $vars['view']   = "message";
            		$vars['task'] 	= "msg_quote";
            		$vars['id'] 	= $segments[1]; // message id
            		break;
            	}

                case 'msg_idelete': {
                    $vars['view'] 	= "message";
            		$vars['task'] 	= "msg_idelete";
            		$vars['id'] 	= $segments[1]; // message id
            		break;
            	}

                case 'msg_odelete': {
                    $vars['view'] 	= "message";
            		$vars['task'] 	= "msg_odelete";
            		$vars['id'] 	= $segments[1]; // message id
            		break;
            	}


				default: {	
					// category view
		        	$vars['view']   = "thread"; 			
		        	$vars['catid']  = $segments[0];  // category slug
		        	$vars['thread'] = $segments[1];  // thread slug
					break;		        	
        		}
        	}

			switch ( $segments[1]) {  // category rss feed

				case 'feed': {
	    			$vars['view']   = "category"; 
	    			$vars['task']   = "feed";
	    			$vars['format'] = "feed";
					break;
				}		

			}
        				
			break;
		}


		case 3: {			
			
			switch ( $segments[0]) {
			
				case 'move': {
        			$vars['view']   = "moderation"; 				
        			$vars['task']   = $segments[0];   // task = move
		        	$vars['catid']  = $segments[1];   // category slug
		        	$vars['thread'] = $segments[2];   // thread slug
					break;
				}		

				case 'sticky': 
				case 'unsticky': 
				case 'lock': 
				case 'unlock': {
        			$vars['view']   = "moderation"; 				
        			$vars['task']   = $segments[0];   // task = sticky/unsticky/lock/unlock
		        	$vars['catid']  = $segments[1];   // category slug
		        	$vars['thread'] = $segments[2];   // thread slug
					break;
				}


				default: {	
					break;
        		}
        	}
        				
			break;
		}


		case 4: {			
			
			switch ( $segments[0]) {
			
				case 'move': {
        			$vars['view']    = "moderation"; 				
        			$vars['task']    = $segments[0];   // task = move
		        	$vars['catid']   = $segments[1];   // category slug
		        	$vars['thread']  = $segments[2];   // thread slug
		        	$vars['catidto'] = $segments[3];   // categoryto slug
					break;
				}		

				case 'reply': {
        			$vars['view']    = "posting"; 				
        			$vars['task']    = $segments[0];   // task = reply
		        	$vars['catid']   = $segments[1];   // category slug
		        	$vars['thread']  = $segments[2];   // thread slug
        			$vars['parent']  = $segments[3];   // parent ?
					break;
				}		

				default: {	
					break;
        		}
        	}
        				
			break;
		}


		case 5: {			
			
			switch ( $segments[0]) {
			
				case 'edit':
				case 'quote': {
        			$vars['view']    = "posting"; 
        			$vars['task']    = $segments[0];   // task = edit/quote
		        	$vars['catid']   = $segments[1];   // category slug
		        	$vars['thread']  = $segments[2];   // thread slug
        			$vars['parent']  = $segments[3];   // parent ?
        			$vars['id']      = $segments[4];   // id
					break;
				}		

				default: {	
					break;
        		}
        	}
        				
			break;
		}


    
    	default: {
    		break;
    	}
    
    }
    
    
                
    return $vars; 
    
} 


