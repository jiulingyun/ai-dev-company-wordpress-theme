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
            add_filter( 'pre_get_document_title', [ $this, 'filter_document_title' ] );
        }
	}

    public function filter_document_title( $title ) {
        if ( is_singular() ) {
            $custom_title = get_post_meta( get_the_ID(), '_ai_seo_title', true );
            if ( ! empty( $custom_title ) ) {
                return $custom_title;
            }
        }
        return $title;
    }

    public function output_meta_tags() {
        $description = '';
        
        if ( is_single() || is_page() ) {
            // Check for custom AI SEO description first
            $custom_desc = get_post_meta( get_the_ID(), '_ai_seo_description', true );
            
            if ( ! empty( $custom_desc ) ) {
                $description = $custom_desc;
            } else {
                $excerpt = get_the_excerpt();
                if ( empty( $excerpt ) ) {
                    $excerpt = wp_trim_words( get_the_content(), 30 );
                }
                $description = esc_attr( $excerpt );
            }
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
        
        // Title
        $title = wp_get_document_title(); // This will use our filter
        echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
        
        echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_attr( get_permalink() ) . '" />' . "\n";

        if ( is_single() || is_page() ) {
             // Description
             $description = '';
             $custom_desc = get_post_meta( get_the_ID(), '_ai_seo_description', true );
            
             if ( ! empty( $custom_desc ) ) {
                 $description = $custom_desc;
             } else {
                 $excerpt = get_the_excerpt();
                 if ( empty( $excerpt ) && is_object( $post ) ) {
                     $excerpt = wp_trim_words( $post->post_content, 30 );
                 }
                 $description = $excerpt;
             }
             
             echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";

            if ( has_post_thumbnail() ) {
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                echo '<meta property="og:image" content="' . esc_attr( $img_src[0] ) . '" />' . "\n";
                echo '<meta name="twitter:image" content="' . esc_attr( $img_src[0] ) . '" />' . "\n";
            }
        } else {
            $description = get_bloginfo( 'description' );
            echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
        }

        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
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

        // BreadcrumbList Schema
        if ( ! is_front_page() ) {
            $schema['breadcrumb'] = [
                '@context' => 'https://schema.org',
                '@type'    => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => __( 'Home', 'ai-dev-theme' ),
                        'item' => home_url( '/' ),
                    ],
                ],
            ];

            if ( is_single() ) {
                $post_type = get_post_type();
                $post_type_obj = get_post_type_object( $post_type );
                if ( $post_type_obj && $post_type !== 'post' ) {
                    $schema['breadcrumb']['itemListElement'][] = [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $post_type_obj->labels->name,
                        'item' => get_post_type_archive_link( $post_type ),
                    ];
                    $schema['breadcrumb']['itemListElement'][] = [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => get_the_title(),
                        'item' => get_permalink(),
                    ];
                } else {
                    // For standard posts, maybe add category?
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        $schema['breadcrumb']['itemListElement'][] = [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => $categories[0]->name,
                            'item' => get_category_link( $categories[0]->term_id ),
                        ];
                        $schema['breadcrumb']['itemListElement'][] = [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => get_the_title(),
                            'item' => get_permalink(),
                        ];
                    } else {
                         $schema['breadcrumb']['itemListElement'][] = [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => get_the_title(),
                            'item' => get_permalink(),
                        ];
                    }
                }
            } elseif ( is_page() ) {
                 $schema['breadcrumb']['itemListElement'][] = [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => get_the_title(),
                    'item' => get_permalink(),
                ];
            }
        }

        // Project Schema (SoftwareApplication)
        if ( is_singular( 'project' ) ) {
            global $post;
            $industries = get_the_terms( $post->ID, 'industry' );
            $app_category = ! empty( $industries ) && ! is_wp_error( $industries ) ? $industries[0]->name : 'WebApplication';
            $project_url = get_post_meta( $post->ID, 'project_url', true );
            
            $schema['software_app'] = [
                '@context' => 'https://schema.org',
                '@type'    => 'SoftwareApplication',
                'name'     => get_the_title(),
                'applicationCategory' => $app_category,
                'operatingSystem' => 'Web',
                'description' => get_the_excerpt(),
                'author' => [
                    '@type' => 'Organization',
                    'name'  => get_bloginfo( 'name' ),
                ],
            ];
            
            if ( $project_url ) {
                 $schema['software_app']['url'] = $project_url;
            }

            if ( has_post_thumbnail() ) {
                $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $schema['software_app']['image'] = $img_src[0];
            }
        }

        // Article Schema
        if ( is_singular( 'post' ) ) {
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
