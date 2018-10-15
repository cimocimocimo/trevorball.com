<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public function content()
    {
        if( have_rows('main_content', 'option') ){
            $content = [];

            while ( have_rows('main_content', 'option')){
                the_row();

                $row = [];
                $row['layout'] = get_row_layout();

                if (get_row_layout() == 'hero') {

                    $row['heading'] = get_sub_field('heading');
                    $row['subheading'] = get_sub_field('subheading');
                    $cta = get_sub_field('call_to_action');
                    $row['call_to_action'] = $cta ? (object) $cta : false;
                    $landscape = get_sub_field('landscape_image');
                    $row['landscape_image'] = $landscape ? (object) $landscape : false;
                    $portrait = get_sub_field('portrait_image');
                    $row['portrait_image'] = $portrait ? (object) $portrait : false;

                } elseif (get_row_layout() == 'portfolio'){

                    $portfolio_posts = get_sub_field('content');
                    $row['portfolios'] = [];
                    foreach($portfolio_posts as $post){
                        $portfolio = [
                            'title' => $post->post_title,
                            'handle' => $post->post_name,
                            'content' => $post->post_content || false,
                            'gallery' => get_field('gallery', $post->ID),
                        ];
                        if(has_post_thumbnail($post->ID)){
                            $portfolio['featured_image'] = get_the_post_thumbnail_url($post->ID, 'large');
                        } else {
                            $portfolio['featured_image'] = false;
                        }
                        $row['portfolios'][] = (object)$portfolio;
                    }

                } elseif (get_row_layout() == 'contact'){

                    $row['form'] = get_sub_field('form');
                    $row['email'] = get_sub_field('email');
                    $row['info'] = get_sub_field('info');
                    $social = get_sub_field('social');
                    $row['social'] = [];
                    foreach($social as $soc){
                        $row['social'][] = (object) $soc;
                    }

                }

                $content[] = (object) $row;
            }

            return $content;
        }
    }
}
