<?php
/**
 * @package m1 Theme
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <?php do_action('before'); ?>
            <header id="masthead" class="site-header" role="banner">
                <section class="top-menu-container">
                    <div class="top-menu-inside">
                        <div class="m1-social-icons">
                            <?php if (get_theme_mod('m1_social_email')) { ?><a href="mailto:<?php echo get_theme_mod('m1_social_email') ?>" target="_blank" title="Email"><span class='symbol'>&#xe224;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_tw')) { ?><a href="<?php echo get_theme_mod('m1_social_tw') ?>" target="_blank" title="Twitter"><span class='symbol'>&#xe286;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_fb')) { ?><a href="<?php echo get_theme_mod('m1_social_fb') ?>" target="_blank" title="Facebook"><span class='symbol'>&#xe227;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_rss')) { ?><a href="<?php echo get_theme_mod('m1_social_rss') ?>" target="_blank" title="RSS"><span class='symbol'>&#xe271;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_g')) { ?><a href="<?php echo get_theme_mod('m1_social_g') ?>" target="_blank" title="Google Plus"><span class='symbol'>&#xe239;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_li')) { ?><a href="<?php echo get_theme_mod('m1_social_li') ?>" target="_blank" title="LinkedIn"><span class='symbol'>&#xe252;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_pin')) { ?><a href="<?php echo get_theme_mod('m1_social_pin') ?>" target="_blank" title="Pinterest"><span class='symbol'>&#xe264;</span></a><?php } ?>
                            <?php if (get_theme_mod('m1_social_yt')) { ?><a href="<?php echo get_theme_mod('m1_social_yt') ?>" target="_blank" title="Youtube"><span class='symbol'>&#xe299;</span></a><?php } ?>
                        </div>
                        <?php if (has_nav_menu('top')) : ?>
                            <nav id="top-site-nav" class="top-menu" role="navigation">
                                <?php
                                $args = array(
                                    'theme_location' => 'top'
                                        /* 'container_class' => 'secondary-menu',
                                          'menu_class' => '' */                                        );
                                wp_nav_menu($args);
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="site-branding">
                    <a class="nav-btn" id="nav-open-btn"><?php _e('Menu', 'm1'); ?></a>
                    <div class="site-title-wrap">

                        <?php if (get_theme_mod('m1_logo')) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" id="site-logo" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_theme_mod('m1_logo'); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"></a>
                        <?php else : ?>

                            <hgroup>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                <p class="site-description"><?php bloginfo('description'); ?></p>
                            </hgroup>

                            <div class="m1-social-icons">
                                <?php if (get_theme_mod('m1_social_email')) { ?><a href="mailto:<?php echo get_theme_mod('m1_social_email') ?>" target="_blank" title="Email"><span class='symbol'>&#xe224;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_tw')) { ?><a href="<?php echo get_theme_mod('m1_social_tw') ?>" target="_blank" title="Twitter"><span class='symbol'>&#xe286;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_fb')) { ?><a href="<?php echo get_theme_mod('m1_social_fb') ?>" target="_blank" title="Facebook"><span class='symbol'>&#xe227;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_rss')) { ?><a href="<?php echo get_theme_mod('m1_social_rss') ?>" target="_blank" title="RSS"><span class='symbol'>&#xe271;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_g')) { ?><a href="<?php echo get_theme_mod('m1_social_g') ?>" target="_blank" title="Google Plus"><span class='symbol'>&#xe239;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_li')) { ?><a href="<?php echo get_theme_mod('m1_social_li') ?>" target="_blank" title="LinkedIn"><span class='symbol'>&#xe252;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_pin')) { ?><a href="<?php echo get_theme_mod('m1_social_pin') ?>" target="_blank" title="Pinterest"><span class='symbol'>&#xe264;</span></a><?php } ?>
                                <?php if (get_theme_mod('m1_social_yt')) { ?><a href="<?php echo get_theme_mod('m1_social_yt') ?>" target="_blank" title="Youtube"><span class='symbol'>&#xe299;</span></a><?php } ?>
                            </div>

                        <?php endif; ?>

                    </div><!-- .site-title-wrap -->

                    <div id="header-widget-area">
                        <?php
                        dynamic_sidebar('header-widget-area');
                        //função criada dentro da sidebar header widget, para imprimir o nome do usuario quando estiver logado no sistema.
                        //CRIARENET
                        /*global $current_user;
                        get_currentuserinfo();
                        if (is_user_logged_in()) {
                            echo '<span class="ciao">Bem Vindo(a), <a href="/funcionarios/">' . $current_user->user_login . '</a></span>';
                            "\n";
                            echo '<a href="' . wp_logout_url(home_url()) . '"> | Sair [x]</a>';
                       } else {
                            echo '<a href="wp-admin" title="Login">Faça aqui seu login!</a>';
                        }*/
                        
                        ?>
                    </div>

                    <!-- MENU RETIRADO DAQUI -->
 
                </section><!-- .site-branding -->
            </header><!-- #masthead -->

            <nav id="site-navigation" class="navigation-main" role="navigation">
                <a class="close-btn" id="nav-close-btn"><?php _e('Close Menu', 'm1'); ?></a>
                <!--<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e('Skip to content', 'm1'); ?>"><?php _e('Skip to content', 'm1'); ?></a></div>-->
                <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </nav><!-- #site-navigation -->

            <div id="main" class="site-main"> 
                
                <!-- FUNCAO QUE MOSTRA OS ULTIMOS POST DO SITE -->
                <!--?php query_posts('showposts=5'); ?>
                <ul>
                    <?php while (have_posts()) : the_post(); ?>
                        <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ul-->
