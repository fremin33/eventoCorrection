<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <section id="about">
        <div class="about-content" style="margin-top: 150px;">

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
