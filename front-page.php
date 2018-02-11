<?php get_header(); ?>

<section id="home">
    <?php
    $args = array('post__in' => get_option('sticky_posts'));
    $slider = new WP_Query($args);
    ?>
    <div id="main-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            // construction des puces du slider
            foreach ($slider->posts as $row) :
                // la première a la classe active
                if ($i == 0):
                    $c = ' class="active"';
                else:
                    $c = '';
                endif; ?>
                <li data-target="#main-slider" data-slide-to="<?= $i ?>" <?= $c ?>></li>
                <?php
                $i++;
            endforeach;
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $active = 'active';
            if ($slider->have_posts()) :
                while ($slider->have_posts()) :
                    $slider->the_post();
                    $categories = get_the_category();
                    $cats = $sep = '';
                    foreach ($categories as $categorie) :
                        $cats .= $sep . $categorie->name;
                        $sep = ', ';
                    endforeach;

                    ?>
                    <div class="item <?= $active; ?>">
                        <img class="img-responsive" src="<?php the_post_thumbnail_url('full'); ?>" alt="slider">
                        <div class="carousel-caption">
                            <h2><?php the_title(); ?></h2>
                            <h4><?= $cats; ?></h4>
                            <a href="<?php the_permalink(); ?>">EN SAVOIR PLUS <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>

                    <?php
                    $active = ''; //on efface la variable, ainsi la classe active ne sera affectée qu'au premier article
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!--/#home-->

<section id="explore">
    <div class="container">
        <div class="row">
            <?php
            $args = array('posts_per_page' => 3, 'post__not_in' => get_option('sticky_posts'));   // je déclare une variable qui contient mon tableau de paramètres (dans notre exemple, simplement les 3 derniers articles)
            $the_query = new WP_Query($args);                // je demande à Wordpress de récupérer la liste des contenus correspondants à mes paramètres
            if ($the_query->have_posts()) :                    // S'il y a des contenus à afficher
                while ($the_query->have_posts()) :        // Tant qu'il reste des contenus à afficher
                    $the_query->the_post();                                // the_post() permet de récupérer le contenu d'un article/page et permet d'utiliser les templates tags (ex: the_title() )
                    // the_post() modifie la variable globale post (ce qui permet l'utilisation des templates tags)

                    // je ferme PHP pour passer en mode HTML
                    ?>
                    <div class="col-md-4">
                        <p>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive')); ?></a>
                        </p>
                        <h3><?php the_title(); ?></h3>
                        <p class="small auteur"> par <?php the_author_posts_link(); ?>, <?php the_time('d F Y'); ?></p>
                        <p>
                            <?php the_excerpt(); ?>
                        </p>
                        <p><a href="<?php the_permalink(); ?>" class="btn btn-warning">Lire la suite</a></p>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();    // A la fin du traitement je réinitialise la variable globale post afin de ne pas créer de conflit dans la suite de ma page.
            endif;
            ?>
        </div><!-- .row -->

    </div>
</section><!--/#explore-->

<section id="event">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div id="event-carousel" class="carousel slide" data-interval="false">
                    <h2 class="heading">Les membres de l'équipe</h2>
                    <a class="even-control-left" href="#event-carousel" data-slide="prev"><i
                                class="fa fa-angle-left"></i></a>
                    <a class="even-control-right" href="#event-carousel" data-slide="next"><i
                                class="fa fa-angle-right"></i></a>
                    <div class="carousel-inner">
                        <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'team'
                        );
                        $teams = get_posts($args);
                        $o = 0; ?>
                        <div class="item active">
                            <div class="row">

                                <?php foreach ($teams as $team) :
                                $o++;
                                if ($o == 4) : ?>
                            </div><!-- .row -->
                        </div><!-- .item -->
                        <div class="item">
                            <div class="row">
                                <?php
                                $o = 0;
                                endif; ?>
                                <div class="col-sm-4">
                                    <div class="single-event">
                                        <?= get_the_post_thumbnail($team->ID, 'team-size', array('class' => 'img-responsive')) ?>
                                        <h4><?= $team->post_title ?></h4>
                                        <?php
                                        $term_list = wp_get_post_terms($team->ID, 'metiers', array("fields" => "names"));
                                        foreach ($term_list as $row) : ?>
                                            <h5><?= $row ?></h5>
                                        <?php endforeach; ?>
                                    </div><!-- .single-event -->
                                </div><!-- .col-sm-4 -->

                                <?php endforeach; ?>

                            </div><!-- .row -->
                        </div><!-- .item -->


                    </div><!-- .carousel-inner -->
                </div><!-- #event-carousel -->
            </div> <!-- .col-sm-12 -->
            <div class="guitar">
                <img class="img-responsive" src="<?= get_stylesheet_directory_uri(); ?>/images/guitar.png"
                     alt="guitar">
            </div>
        </div>
    </div>
</section><!--/#event-->

<section id="about">
    <div class="guitar2">
        <img class="img-responsive" src="<?= get_stylesheet_directory_uri(); ?>/images/guitar2.jpg" alt="guitar">
    </div>
    <div class="about-content">
        <?php // Vous devez récupérer l'identifiant de votre page pour remplacer le 33
        $pg = get_post(33); ?>
        <h2><?= $pg->post_title; ?></h2>
        <p><?= $pg->post_excerpt; ?></p>
        <a href="<?= $pg->guid; ?>" class="btn btn-primary">En savoir plus <i class="fa fa-angle-right"></i></a>
    </div>
</section><!--/#about-->

<section id="twitter">
    <div id="twitter-feed" class="carousel slide" data-interval="false">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="text-center carousel-inner center-block">
                    <?php
                    $active = 'active';
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'temoignages');   // je déclare une variable qui contient mon tableau de paramètres
                    $the_query = new WP_Query($args);                // je demande à Wordpress de récupérer la liste des contenus correspondants à mes paramètres
                    if ($the_query->have_posts()) :                    // S'il y a des contenus à afficher
                        while ($the_query->have_posts()) :        // Tant qu'il reste des contenus à afficher
                            $the_query->the_post();                                // the_post() permet de récupérer le contenu d'un article/page et permet d'utiliser les templates tags (ex: the_title() )
                            // the_post() modifie la variable globale post (ce qui permet l'utilisation des templates tags)
                            $dte = get_post_meta(get_the_ID(), 'date', true);

                            // je ferme PHP pour passer en mode HTML
                            ?>
                            <div class="item <?= $active; ?>">
                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
                                <p><?= get_the_content(); ?></p>

                                <a href="javascript:void(0);"><?php the_title(); ?> - <?= $dte; ?></a>
                            </div>
                            <?php
                            $active = '';
                        endwhile;
                        wp_reset_postdata();                                // A la fin du traitement je réinitialise la variable globale post afin de ne pas créer de conflit dans la suite de ma page.
                    endif;
                    ?>

                </div>
                <a class="twitter-control-left" href="#twitter-feed" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="twitter-control-right" href="#twitter-feed" data-slide="next"><i
                            class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</section><!--/#twitter-feed-->

<section id="sponsor">
    <div id="sponsor-carousel" class="carousel slide" data-interval="false">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h2>Sponsors</h2>
                    <a class="sponsor-control-left" href="#sponsor-carousel" data-slide="prev"><i
                                class="fa fa-angle-left"></i></a>
                    <a class="sponsor-control-right" href="#sponsor-carousel" data-slide="next"><i
                                class="fa fa-angle-right"></i></a>
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'sponsors');   // je déclare une variable qui contient mon tableau de paramètres
                        $the_query = new WP_Query($args);                // je demande à Wordpress de récupérer la liste des contenus correspondants à mes paramètres
                        if ($the_query->have_posts()) :                    // S'il y a des contenus à afficher
                            while ($the_query->have_posts()) :        // Tant qu'il reste des contenus à afficher
                                $the_query->the_post();                                // the_post() permet de récupérer le contenu d'un article/page et permet d'utiliser les templates tags (ex: the_title() )
                                // the_post() modifie la variable globale post (ce qui permet l'utilisation des templates tags)
                                $url = get_post_meta(get_the_ID(), '_url', true);


                                if ($i == 0) : ?>
                                    <div class="item active"><ul>
                                <?php elseif ($i % 6 == 0) : ?>
                                    <div class="item"><ul>
                                <?php endif;
                                $i++; //on ajoute 1 à chaque LI
                                ?>
                                <li>
                                    <?php if ($url) : ?>
                                        <a href="<?= $url ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?></a>
                                    <?php else :
                                        the_post_thumbnail('full', array('class' => 'img-responsive'));
                                    endif; ?>
                                </li>


                                <?php if ($i % 6 == 0) : ?>
                                </div><!-- .item while -->
                            <?php endif;

                            endwhile;
                            wp_reset_postdata();                                // A la fin du traitement je réinitialise la variable globale post afin de ne pas créer de conflit dans la suite de ma page.
                            if ($i % 6 != 0) : ?>
                                </ul></div><!-- .item fin while -->
                            <?php endif;
                        endif; ?>


                    </div>
                </div>
            </div>
        </div>
        <div class="light">
            <img class="img-responsive" src="<?= get_stylesheet_directory_uri(); ?>/images/light.png" alt="">
        </div>
    </div>
</section><!--/#sponsor-->

<?php get_footer(); ?>
