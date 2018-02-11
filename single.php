<?php get_header(); ?>

<!--/#home-->

<section id="explore">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive')); ?>
                    </p>
                    <p class="small"> par <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"
                                             class="auteur"><?php the_author(); ?></a>, le <?php the_date(); ?></p>
                    <p><?php the_tags('', ' '); ?></p>
                    <p>Catégorie : <?php the_category(' '); ?></p>

                    <div id="widget-area" class="widget-area" role="complementary">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div><!-- .widget-area -->

                </div>
                <div class="col-md-8">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section><!--/#explore-->


<?php get_footer(); ?>
