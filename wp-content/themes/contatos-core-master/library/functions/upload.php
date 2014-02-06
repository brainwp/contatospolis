<?php
    // if you have this in a file you will need to load "wp-load.php" to get access to WP functions. If you post to "self" with this code then WordPress is by default loaded
    require $_SERVER['DOCUMENT_ROOT'] . "/contatospolis/wp-load.php";
    // require two files that are included in the wp-admin but not on the front end. These give you access to some special functions below.
    require $_SERVER['DOCUMENT_ROOT'] . "/contatospolis/wp-admin/includes/file.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/contatospolis/wp-admin/includes/image.php";
     
    // required for wp_handle_upload() to upload the file
    $upload_overrides = array( 'test_form' => FALSE );
     
    global $current_user;
    get_currentuserinfo();
    $logged_in_user = $current_user->ID;
     
    // count how many files were uploaded
    $count_files = count( $_FILES['files'] );
     
    // load up a variable with the upload direcotry
    $uploads = wp_upload_dir();
     
    // foreach file uploaded do the upload
    foreach ( range( 0, $count_files ) as $i ) {
     
    // create an array of the $_FILES for each file
    $file_array = array(
    'name' => $_FILES['files']['name'][$i],
    'type'	=> $_FILES['files']['type'][$i],
    'tmp_name'	=> $_FILES['files']['tmp_name'][$i],
    'error'	=> $_FILES['files']['error'][$i],
    'size'	=> $_FILES['files']['size'][$i],
    );
     
    // check to see if the file name is not empty
    if ( !empty( $file_array['name'] ) ) {
     
    // upload the file to the server
    $uploaded_file = wp_handle_upload( $file_array, $upload_overrides );
     
    // checks the file type and stores in in a variable
    $wp_filetype = wp_check_filetype( basename( $uploaded_file['file'] ), null );	
     
    // set up the array of arguments for "wp_insert_post();"
    $attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title' => preg_replace('/\.[^.]+$/', '', basename( $uploaded_file['file'] ) ),
    'post_content' => '',
    'post_author' => $logged_in_user,
    'post_status' => 'inherit',
    'post_type' => 'attachment',
    'post_parent' => $_POST['post_id'],
    'guid' => $uploads['baseurl'] . '/' . $file_array['name']
    );
     
    // insert the attachment post type and get the ID
    $attachment_id = wp_insert_post( $attachment );
     
    // generate the attachment metadata
    $attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
     
    // update the attachment metadata
    wp_update_attachment_metadata( $attachment_id, $attach_data );
     
    // this is optional and only if you want to. it is here for reference only.
    // you could set up a separate form to give a specific user the ability to change the post thumbnail
    // set_post_thumbnail( $_POST['post_id', $attachment_id );
     
    }
    }
    // setup redirect. i used the referer so that i can say "file uploaded" in a div if the files query string variable is set.
    header("Location: " . $_SERVER['HTTP_REFERER'] . "/?files=uploaded");
?>