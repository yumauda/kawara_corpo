<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="News">
          <h2 class="p-page-mv__title">お知らせ</h2>
          <p class="p-page-mv__text">News</p>
        </div>
      </div>
    </div>
  </section>
  <div class="p-top-news">
    <div class="l-inner">
      <div class="p-top-news__content">
        <div class="p-top-news__right">
          <ul class="p-top-news__lists">
            <?php if (have_posts()) : ?>
              <?php while (have_posts()) : the_post(); ?>
                <li class="p-top-news__list">
                  <a href="<?php the_permalink(); ?>" class="p-top-news__link">
                    <div class="p-top-news__link-cat">
                      <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="p-top-news__time"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                      <?php
                      $terms = get_the_terms(get_the_ID(), 'news_category');
                      if (!empty($terms) && !is_wp_error($terms)) :
                      ?>
                        <p class="p-top-news__category"><?php echo esc_html($terms[0]->name); ?></p>
                      <?php endif; ?>
                    </div>
                    <p class="p-top-news__link-title"><?php the_title(); ?></p>
                  </a>
                </li>
              <?php endwhile; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>