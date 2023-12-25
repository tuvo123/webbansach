<?php
	the_posts_pagination( array(
		'prev_text' => esc_html__( 'Previous page', 'books-printing' ),
		'next_text' => esc_html__( 'Next page', 'books-printing' ),
	) );