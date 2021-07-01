<?php

    //  custom rest api endpoint
    //  wp-json/custom/v1/custom

    add_action( 'rest_api_init', 'custom_rest_api' );
    function custom_rest_api() {
        register_rest_route( 'custom/v1', '/custom', array(
            'methods' => 'GET',
            'callback' => 'custom_rest_api_callback',
            'permission_callback' => '__return_true'
        ));
    }
    function custom_rest_api_callback( $request ) {
        $posts_data = array();
        $paged = $request->get_param( 'page' );
        $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1;
        $posts = get_posts( array(
                'paged' => $paged,
                'post__not_in' => get_option( 'sticky_posts' ),
                'posts_per_page' => 100,
                'post_type' => array( 'post', 'page' )  //  data to display
            )
        );
        foreach( $posts as $post ) {
            //  get the post id
            $id = $post->ID;
            //  get the post thumbnail with the custom size 'portait'
            $post_thumbnail = ( has_post_thumbnail( $id ) ) ? get_the_post_thumbnail_url( $id, 'portrait' ) : null;
            $post_content = $post->post_content;
            $post_excerpt = get_the_excerpt($id);
            $permalink = get_permalink($id);
            //  get acf field
            $post_document = "";
            if(get_field( 'file', $id )){
                $post_document = get_field( 'file', $id )['url'];
            }
            //  fields
            $posts_data[] = (object) array(
                'id' => $id,
                'slug' => $post->post_name,
                'type' => $post->post_type,
                'title' => $post->post_title,
                'content' => $post_content,
                'excerpt' => $post_excerpt,
                'featured_img_src' => $post_thumbnail,
                'document_url' => $post_document,
                'permalink' => $permalink
            );
        }
        return $posts_data;
    }

?>
