<?php get_header(); ?>
<section id="explore">
    <div class="container">
        <header class="inform">
            <h1>Auteur : <?php the_author_meta('display_name'); ?></h1>
            <p><?php the_author_meta('description'); ?></p>
        </header>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) :
                the_post(); ?>
                <article>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive')); ?>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <p><strong><a href="<?php the_permalink() ?>"
                                          title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong></p>
                            <?php the_excerpt(); ?>
                        </div>

                    </div>
                </article>
                <hr>

            <?php endwhile; ?>


        <?php else: ?>

            <div class="post">
                <h1>Pas d'article</h1>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>

