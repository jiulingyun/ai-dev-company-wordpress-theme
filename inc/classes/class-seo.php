<?php
/**
 * SEO Optimization Class
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Classes;

use AI_Dev_Theme\Inc\Traits\Singleton;

class SEO {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
        // Only run if no major SEO plugin is active to avoid conflicts
        // We check for Yoast, RankMath, and All in One SEO
        if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) && ! defined( 'AIOSEO_VERSION' ) ) {
		    add_action( 'wp_head', [ $this, 'output_meta_tags' ], 5 );
		    add_action( 'wp_head', [ $this, 'output_open_graph' ], 10 );
		    add_action( 'wp_head', [ $this, 'output_schema_json_ld' ], 20 );
        }
	}

    public function output_meta_tags() {
        if ( is_single() || is_page() ) {
            $excerpt = get_the_excerpt();
            if ( empty( $excerpt ) ) {
                $excerpt = wp_trim_words( get_the_content(), 30 );
            }
            $description = esc_attr( $excerpt );
        } else {
            $description = get_bloginfo( 'description' );
        }

        if ( $description ) {
            echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        }
        
        echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    }

    public function output_open_graph() {
        global $post;

        echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '" />' . "\n";
        echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_attr( get_permalink() ) . '" />' . "\n";

        if ( is_single() || is_page() ) {
            $excerpt = get_the_excerpt();
            if ( empty( $excerpt ) && is_object( $post ) ) {
                $excerpt = wp_trim_words( $post->post_content, 30 );
            }
             echo '<meta property="og:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";

            if ( has_post_thumbnail() ) {
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                echo '<meta property="og:image" content="' . esc_attr( $img_src[0] ) . '" />' . "\n";
            }
        } else {
             echo '<meta property="og:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />' . "\n";
        }

        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    }

    public function output_schema_json_ld() {
        $schema = [];

        // Organization Schema
        $schema['organization'] = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => get_bloginfo( 'name' ),
            'url'      => home_url( '/' ),
            'logo'     => [
                '@type' => 'ImageObject',
                'url'   => get_site_icon_url(),
            ],
        ];

        // WebSite Schema
        if ( is_front_page() ) {
            $schema['website'] = [
                '@context' => 'https://schema.org',
                '@type'    => 'WebSite',
                'name'     => get_bloginfo( 'name' ),
                'url'      => home_url( '/' ),
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => home_url( '/?s={search_term_string}' ),
                    'query-input' => 'required name=search_term_string',
                ],
            ];
        }

        // Article Schema
        if ( is_single() ) {
            global $post;
            $schema['article'] = [
                '@context' => 'https://schema.org',
                '@type'    => 'Article',
                'headline' => get_the_title(),
                'datePublished' => get_the_date( 'c' ),
                'dateModified'  => get_the_modified_date( 'c' ),
                'author' => [
                    '@type' => 'Person',
                    'name'  => get_the_author(),
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name'  => get_bloginfo( 'name' ),
                    'logo'  => [
                        '@type' => 'ImageObject',
                        'url'   => get_site_icon_url(),
                    ],
                ],
            ];
            
            if ( has_post_thumbnail() ) {
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $schema['article']['image'] = $img_src[0];
            }
        }

        foreach ( $schema as $type => $data ) {
            echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
        }
    }
}
