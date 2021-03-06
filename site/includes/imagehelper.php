<?php
/**
 * @package		Codingfish Discussions
 * @subpackage	com_discussions
 * @copyright	Copyright (C) 2010-2013 Codingfish (Achim Fischer). All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.codingfish.com
 */
 
 
function add_image( $user_id, $image, $absolute_path, $db) {

    $af_dir_ads = $absolute_path."/images/discussions/users/";

    $max_image_size = 209715200; // 200 KByte ?
    
    $discussions_folder = $absolute_path."/images/discussions/";
	if ( !is_dir( $discussions_folder)) {
		mkdir($discussions_folder);
	}	

    $users_folder = $absolute_path."/images/discussions/users/";
	if ( !is_dir( $users_folder)) {
		mkdir($users_folder);
	}		    	    
    

    $image_too_big = 0;
    if (isset( $_FILES['avatar'])) {
        if ( $_FILES['avatar']['size'] > $max_image_size) {
            $image_too_big = 1;
        }
    }


    if ( $image_too_big == 1) {
        echo "<font color='#CC0000'>";
        echo "The uploaded image is too big";
        echo "</font>";
        echo "<br>";
        echo "<br>";
    }
    else {
        $af_size = GetImageSize ($_FILES[$image]['tmp_name']);

        switch ($af_size[2]) {
                case 1 : {
                    $thispicext = 'gif';
                    break;
                }
                case 2 : {
                    $thispicext = 'jpg';
                    break;
                }
                case 3 : {
                    $thispicext = 'png';
                    break;
                }
        }


        // if ( $af_size[2] >= 1 && $af_size[2] <= 3) { // 1=GIF, 2=JPG or 3=PNG
        if ( $af_size[2] >= 2 && $af_size[2] <= 3) { // 2=JPG or 3=PNG

            $pict_jpg = $absolute_path."/images/discussions/users/".$user_id."_t.jpg";
            if ( file_exists( $pict_jpg)) {
                unlink( $pict_jpg);
            }
            $pic_jpg = $absolute_path."/images/discussions/users/".$user_id.".jpg";
            if ( file_exists( $pic_jpg)) {
                unlink( $pic_jpg);
            }

            $pict_png = $absolute_path."/images/discussions/users/".$user_id."_t.png";
            if ( file_exists( $pict_png)) {
                unlink( $pict_png);
            }
            $pic_png = $absolute_path."/images/discussions/users/".$user_id.".png";
            if ( file_exists( $pic_png)) {
                unlink( $pic_png);
            }

            $pict_gif = $absolute_path."/images/discussions/users/".$user_id."_t.gif";
            if ( file_exists( $pict_gif)) {
                unlink( $pict_gif);
            }
            $pic_gif = $absolute_path."/images/discussions/users/".$user_id.".gif";
            if ( file_exists( $pic_gif)) {
                unlink( $pic_gif);
            }

            chmod ( $_FILES[$image]['tmp_name'], 0644);
			
			// 1. if directory ./avatars/USERID does not exist, create it 
			// 2. create the subdirs for ORIGINAL, LARGE (128) and SMALL(32)
			if ( !is_dir( $af_dir_ads.$user_id)) {
				mkdir($af_dir_ads.$user_id);
				mkdir($af_dir_ads.$user_id."/original"); // ORIGINAL
				mkdir($af_dir_ads.$user_id."/large"); // LARGE (128)
				mkdir($af_dir_ads.$user_id."/small"); // SMALL (32)
			}


			$original_image = $af_dir_ads.$user_id."/original/".$user_id.".".$thispicext;
			$large_image = $af_dir_ads.$user_id."/large/".$user_id.".".$thispicext;
			$small_image = $af_dir_ads.$user_id."/small/".$user_id.".".$thispicext;


            // copy original image to folder "original"
            move_uploaded_file ( $_FILES[$image]['tmp_name'], $original_image);			

            // create "large" image 128px
            switch ($af_size[2]) {
                case 1 : $src = ImageCreateFromGif(  $original_image); break;
                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
                case 3 : $src = ImageCreateFromPng(  $original_image); break;
            }

            $width_before  = ImageSx( $src);
            $height_before = ImageSy( $src);

            if ( $width_before  >= $height_before) {
                $width_new = min(128, $width_before);
                $scale = $width_before / $height_before;
                $height_new = round( $width_new / $scale);
            }
            else {
                $height_new = min(128, $height_before);
                $scale = $height_before / $width_before;
                $width_new = round( $height_new / $scale);
            }

            $dst = ImageCreateTrueColor( $width_new, $height_new);

            // GD Lib 2
            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            switch ($af_size[2]) {
                case 1 : ImageGIF(  $dst, $large_image); break;
                case 2 : ImageJPEG( $dst, $large_image); break;
                case 3 : ImagePNG(  $dst, $large_image); break;
            }

            imagedestroy( $dst);
            imagedestroy( $src);


            // create "small" image 32px
            switch ($af_size[2]) {
                case 1 : $src = ImageCreateFromGif(  $original_image); break;
                case 2 : $src = ImageCreateFromJpeg( $original_image); break;
                case 3 : $src = ImageCreateFromPng(  $original_image); break;
            }

            $width_before  = ImageSx( $src);
            $height_before = ImageSy( $src);

            if ( $width_before  >= $height_before) {
                $width_new = min(32, $width_before);
                $scale = $width_before / $height_before;
                $height_new = round( $width_new / $scale);
            }
            else {
                $height_new = min(32, $height_before);
                $scale = $height_before / $width_before;
                $width_new = round( $height_new / $scale);
            }

            $dst = ImageCreateTrueColor( $width_new, $height_new);

            // GD Lib 2
            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            switch ($af_size[2]) {
                case 1 : ImageGIF(  $dst, $small_image); break;
                case 2 : ImageJPEG( $dst, $small_image); break;
                case 3 : ImagePNG(  $dst, $small_image); break;
            }

            imagedestroy( $dst);
            imagedestroy( $src);


            // DB update
            $sql = "UPDATE #__discussions_users SET avatar='".$user_id.".".$thispicext."' WHERE id=".$user_id;

            $db->setQuery( $sql);

            if ($db->getErrorNum()) {
                echo $db->stderr();
            } else {
                $db->query();
            }


        }
    }
}



function del_image( $user_id, $image, $absolute_path, $db) {

	$image_folder = $absolute_path . "/images/discussions/users/" . $user_id . "/";
		
    // get image name
    $sql = "SELECT " . $image . " FROM #__discussions_users WHERE id=" . $user_id;	
	$db->setQuery( $sql);
	$imagename = $db->loadResult();

	if ( $imagename != "") {

		$original_image = $image_folder . "original/" . $imagename;
		$large_image 	= $image_folder . "large/" . $imagename;
		$small_image 	= $image_folder . "small/" . $imagename;

        if ( file_exists( $original_image)) {
            unlink( $original_image);
        }
        if ( file_exists( $large_image)) {
            unlink( $large_image);
        }
        if ( file_exists( $small_image)) {
            unlink( $small_image);
        }
        
	}	

    // remove all existing folders for this user
    if (is_dir( $image_folder . "original/")) {
        rmdir( $image_folder . "original/");
    }
    if (is_dir( $image_folder . "large/")) {
        rmdir( $image_folder . "large/");
    }
    if (is_dir( $image_folder . "small/")) {
        rmdir( $image_folder . "small/");
    }
    if (is_dir( $image_folder)) {
        rmdir( $image_folder );
    }


    // update database
    $sql = "UPDATE #__discussions_users SET avatar='' WHERE id=".$user_id;

    $db->setQuery( $sql);

    if ($db->getErrorNum()) {
    
        echo $db->stderr();
        
    } else {
    
        $db->query();
        
    }


}



