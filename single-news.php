<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="News">
          <h2 class="p-page-mv__title">お知らせ</h2>
          <p class="p-page-mv__text">News</p>
        </div>
      </div>
    </div>
  </section>
  
  <section class="p-single">
    <div class="l-inner">
      <div class="p-single__content">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('p-single-news'); ?>>
              <header class="p-single-news__header">
                <div class="p-single-news__meta">
                  <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="p-single-news__time">
                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                  </time>
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'news_category');
                  if (!empty($terms) && !is_wp_error($terms)) :
                  ?>
                    <ul class="p-single-news__categories">
                      <?php foreach ($terms as $term) : ?>
                        <li class="p-single-news__category"><?php echo esc_html($term->name); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
                <h1 class="p-single-news__title"><?php the_title(); ?></h1>
              </header>

              <div class="p-single-news__body">
                <?php the_content(); ?>
                <?php
                wp_link_pages(array(
                  'before' => '<nav class="p-single-news__pages">',
                  'after' => '</nav>',
                ));
                ?>
              </div>

              <footer class="p-single-news__footer">
                <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="p-single-news__back">
                  <span class="p-single-news__back-text">Back to News</span>
                </a>
              </footer>
            </article>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>