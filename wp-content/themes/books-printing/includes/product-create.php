<?php

class Whizzie {

	public function __construct() {
		$this->init();
	}

	public function init()
	{
	
	}

	public static function books_printing_setup_widgets(){

	$books_printing_product_image_gallery = array();
	$books_printing_product_ids = array();

	$books_printing_product_category= array(
		'Product Category'       => array(
			'Product 1',
			'Product 2',
			'Product 3',
			'Product 4',
		),
	);

	$books_printing_k = 1;
	foreach ( $books_printing_product_category as $books_printing_product_cats => $books_printing_products_name ) { 
	// Insert porduct cats Start
	$content = 'This is sample product category';
	$books_printing_parent_category	=	wp_insert_term(
	$books_printing_product_cats, // the term
	'product_cat', // the taxonomy
		array(
		'description'=> $content,
		'slug' => str_replace( ' ', '-', $books_printing_product_cats)
		)
	);

// -------------- create subcategory END -----------------

	$books_printing_n=1;
	// create Product START
	foreach ( $books_printing_products_name as $key => $books_printing_product_title ) {
	$content = '
		<div class="main_content">
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		</div>';

	// Create post object
	$books_printing_my_post = array(
		'post_title'    => wp_strip_all_tags( $books_printing_product_title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'product',
		'post_category' => [$books_printing_parent_category['term_id']]
	);

	// Insert the post into the database

	$books_printing_uqpost_id = wp_insert_post($books_printing_my_post);
	wp_set_object_terms( $books_printing_uqpost_id, str_replace( ' ', '-', $books_printing_product_cats), 'product_cat', true );

	$books_printing_product_price = array('32.36','32.36','32.36','32.36');
	
	update_post_meta( $books_printing_uqpost_id, '_regular_price', $books_printing_product_price[$books_printing_n-1] );
	update_post_meta( $books_printing_uqpost_id, '_price', $books_printing_product_price[$books_printing_n-1] );
	array_push( $books_printing_product_ids,  $books_printing_uqpost_id );

	// Now replace meta w/ new updated value array
	$books_printing_image_url = get_template_directory_uri().'/assets/images/product/'.$books_printing_product_cats.'/' . str_replace(' ', '_', strtolower($books_printing_product_title)).'.png';
	$books_printing_image_name  = $books_printing_product_title.'.png';
	$books_printing_upload_dir = wp_upload_dir();
	// Set upload folder
	$books_printing_image_data = file_get_contents(esc_url($books_printing_image_url));
	// Get image data
	$unique_file_name = wp_unique_filename($books_printing_upload_dir['path'], $books_printing_image_name);
	// Generate unique name
	$books_printing_filename = basename($unique_file_name);
	// Create image file name
	// Check folder permission and define file location
	if (wp_mkdir_p($books_printing_upload_dir['path'])) {
	$books_printing_file = $books_printing_upload_dir['path'].'/'.$books_printing_filename;
	} else {
	$books_printing_file = $books_printing_upload_dir['basedir'].'/'.$books_printing_filename;
	}
	file_put_contents($books_printing_file, $books_printing_image_data);
	// Check image file type
	$wp_filetype = wp_check_filetype($books_printing_filename, null);
	// Set attachment data
	$attachment = array(
	'post_mime_type' => $wp_filetype['type'],
	'post_title'     => sanitize_file_name($books_printing_filename),
	'post_type'      => 'product',
	'post_status'    => 'inherit',
	);
	// Create the attachment
	$books_printing_attach_id = wp_insert_attachment($attachment, $books_printing_file, $books_printing_uqpost_id);

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata($books_printing_attach_id, $books_printing_file);

	// Assign metadata to attachment
	wp_update_attachment_metadata($books_printing_attach_id, $attach_data);
	if ( count( $books_printing_product_image_gallery ) < 3 ) {
		array_push( $books_printing_product_image_gallery, $books_printing_attach_id );
	}
	// // And finally assign featured image to post
	set_post_thumbnail($books_printing_uqpost_id, $books_printing_attach_id);
	++$books_printing_n;
	}
	// Create product END
	++$books_printing_k;
	}
	// Add Gallery in first simple product and second variable product START
	$books_printing_product_image_gallery = implode( ',', $books_printing_product_image_gallery );
	foreach ( $books_printing_product_ids as $books_printing_product_id ) {
	update_post_meta( $books_printing_product_id, 'books_printing_product_image_gallery', $books_printing_product_image_gallery );
	}
}

}
 