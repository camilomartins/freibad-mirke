<?php

/**
 * 
 * Template Name: Startseite
 * Template Post Type: page
 * 
 */

get_header();

?>

<main class="" role="main" data-track-content>
    
    <h2>Test<?php the_field('title', 4460); ?></h2>
    <?php if( get_field('title', 4460) ): ?>
        <h2>Funktioniert<?php the_field('text_field'); ?></h2>
<?php endif; ?>

    <?php 
    
    $image = get_field('quartier_image', 'option');
    if (empty( $image )) {
        $image = get_template_directory_uri()."/assets/images/quartier.png";
    }
    else {
        $image = $image['url'];
    }
    ?>

    <section class="quartier-header bg-image" style="background: url('<?php echo esc_url($image); ?>')">
        <div class="stage-center has-bg-blur">
            <h1 class="heading-size-1"><?php the_field('welcome-title','option'); ?></h1>
        </div>
    </section>

    <section class="">
        <?php if (current_user_can('administrator') && ( get_field('quartier_image','option') == false || get_field('welcome-title','option') == false ) ) {?>

        <?php } ?>

       

        <?php if( '' !== get_post()->post_content ) { ?>

            <div class="gutenberg-content">
                <?php
                    // Gutenberg
                    if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
                        the_excerpt();
                    } else {
                        the_content( __( 'Continue reading', 'twentytwenty' ) );
                    }
                ?>
            </div>
            
        <?php } ?>
    </section>

    <section>
        <div class="stage-center">
            <h2 class="heading-size-1 stage-title"><?php _e('Ziele für nachhaltige Entwicklung im Quartier', 'quartiersplattform'); ?> </h2>
            <p><?php _e("Die Vereinten Nationen haben 2016 Ziele für eine nachhaltige Entwicklung (Sustainable Development Goals, SDGs) verabschiedet. Die SDGs spielen nicht nur international, sonder auch lokal in deinem Quartier eine wichtige Rolle.", "quartiersplattform"); ?></p>
            <div class="card-stack">
                <?php 
                    $args = array(
                        'post_type'=>'post', 
                        'post_status'=>'publish', 
                        'posts_per_page'=> 4,
                        'orderby'        => 'rand',
                    );
                        
                    card_list($args, $type = 'badge');

                ?>
                <a class="button is-primary" href="<?php echo get_site_url( ) ?>/sdgs"><?php _e('Übersicht der Ziele für nachhaltige Entwicklung', 'quartiersplattform'); ?> </a>
            </div>

        </div>
    </section>


        <div class="link-card-container">
            <!-- <?php 
                $pinned_projects = array(
                    'post_type' => 'projekte',
                    'posts_per_page' => -1,
                    'order_by' => 'date',
                    'order' => 'DESC',
                    'meta_key'   => 'pin_main',
                    'meta_value' => array(true, 'true')
                );
                card_list($pinned_projects);
            ?> -->
         </div>
        
         <div class="button-container">
            <a class="button " href="<?php echo get_site_url()."/projekte"; ?>"><?php _e("Neuigkeiten & Projektupdates", "quartiersplattform"); ?></a>
            <a class="button is-primary" href="<?php echo get_site_url()."/Projektverzeichnis"; ?>"><?php _e("Alle Projekte anzeigen", "quartiersplattform"); ?></a>
        </div>


    <section>
        <div class="stage-center">
            <h2 class="heading-size-1 stage-title"><?php _e("Veranstaltungen in deinem Quartier", "quartiersplattform"); ?></h2>
            <p><?php _e("Verpasse keine Veranstaltung mehr in deinem Quartier. Egal ob das nächste Konzert oder die nächste Party in deiner Nachbarschaft - mit der Quartiersplattform bist du immer auf dem Laufenden!", "quartiersplattform"); ?></p>
            <div class="link-card-container force-landscape">
                <?php 
                        $args4 = array(
                            'post_type'=>'veranstaltungen', 
                            'post_status'=>'publish', 
                            'posts_per_page'=> 20,
                            // 'meta_key' => 'event_date',
                            // 'orderby' => 'meta_value_num',
                            // 'order' => 'ASC',
                            'meta_query' => array(
                                'relation' => 'AND',
                                'date_clause' => array(
                                    'key' => 'event_date',
                                    'value' => date("Y-m-d"),
                                    'compare'	=> '>=',
                                    'type' => 'DATE'
                                ),
                                'time_clause' => array(
                                    'key' => 'event_time',
                                    'compare'	=> '=',
                                ),
                                // array(
                                //     'key' => 'event_date', 
                                //     'value' => date("Y-m-d"),
                                //     'compare' => '>=', 
                                //     'type' => 'DATE'
                                // )
                            ),
                            'orderby' => array(
                                'date_clause' => 'ASC',
                                'time_clause' => 'ASC',
                            ),
                        );
                    ?>  
                    <?php card_list($args4);?>
                </div>
                <a class="button is-primary" href="<?php echo get_site_url()."/veranstaltungen"; ?>"><?php _e("Zu den Veranstaltungen", "quartiersplattform"); ?></a>
            </div>
        </div>
    </section>

    
    
    <?php 
	    $text = __('Teile uns dein Feedback oder Anregungen zur Quartiersplattform. Funktionert etwas nicht oder hast du eine Idee zur weiterentwicklung.','quartiersplattform');
		reminder_card('', __('Feedback zur Quartiersplattform','quartiersplattform'), $text, __('Zur Wunschliste','quartiersplattform'), home_url().'/feedback' );

        $text = __('Allgemeine und öffentliche Informationen zu der Quartiersplattform.','quartiersplattform'); 
        reminder_card('qp_info', __('Informationen zu deiner Quartiersplattform','quartiersplattform'), $text, __('Informationen','quartiersplattform'), home_url().'/quartiersplattform' );
    ?>


</main><!-- #site-content -->

<?php get_footer(); ?>