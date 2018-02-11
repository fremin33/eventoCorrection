<?php get_header() ?>
<section id="explore">
    <div class="container">
        <?php if (have_posts()) : ?>
            <header class="inform">
                <?php if (is_category()) : ?>
                    <h1>Catégorie &laquo;<?php single_cat_title(''); ?>&raquo;</h1>
                <?php elseif (is_tag()) : ?>
                    <h1>Etiquette &laquo;<?php single_tag_title(); ?>&raquo;</h1>
                <?php elseif (is_day()) : ?>
                    <h1>Articles du jour <?php the_time('F jS, Y'); ?></h1>
                <?php elseif (is_month()) : ?>
                    <h1>Articles du mois <?php the_time('F, Y'); ?></h1>
                <?php elseif (is_year()) : ?>
                    <h1>Articles de l'année <?php the_time('Y'); ?></h1>
                <?php endif; ?>
            </header>
            <?php
            while (have_posts()) :
                the_post();
                ?>
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
            <?php endwhile; ?>
        <?php else: ?>
            <div class="post">
                <h1>Pas d'article</h1>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer() ?>
