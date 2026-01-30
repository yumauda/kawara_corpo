<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Example">
          <h2 class="p-page-mv__title">施工事例</h2>
          <p class="p-page-mv__text">Sekishu tiled roof building</p>
        </div>
      </div>
    </div>
  </section>

  <section class="p-single js-blur-content">
    <div class="l-inner">
      <div class="p-single__content">
        <!-- メイン画像 -->
        <!-- <?php if (has_post_thumbnail()) : ?>
          <figure class="p-single__main-image">
            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
          </figure>
        <?php else : ?>
          <figure class="p-single__main-image">
            <img src="<?php echo get_template_directory_uri() ?>/images/example/noimage-large.jpg" alt="<?php the_title(); ?>">
          </figure>
        <?php endif; ?> -->
        <div class="p-single__slider">
          <!-- Slider main container -->
          <div class="swiper swiper-single">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <?php if (have_rows('example_slider')) : ?>
                <?php while (have_rows('example_slider')) : the_row(); ?>
                  <div class="swiper-slide">
                    <figure class="p-single__slider-img">
                      <img decoding="async" loading="lazy" src="<?php the_sub_field('example_slider_img'); ?>" alt="<?php the_title(); ?>" width="1240" height="770">
                    </figure>
                  </div>

                <?php endwhile; ?>
              <?php endif; ?>
              
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev p-single__btn-prev">
              <div class="p-single__btn-slider-icon">
                <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/single/prev.png" alt="前へ" width="80" height="80">
              </div>
            </div>
            <div class="swiper-button-next p-single__btn-next">
              <div class="p-single__btn-slider-icon">
                <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/single/next.png" alt="次へ" width="80" height="80">
              </div>
            </div>
          </div>
        </div>
        <!-- ヘッダー部分 -->
        <div class="p-single__header">
          <h1 class="p-single__title"><?php the_title(); ?></h1>
          <div class="p-single__meta">
            <div class="p-single__meta-item"><?php the_field('example_name'); ?></div>
            <div class="p-single__meta-item"><?php the_field('example_place'); ?></div>
          </div>
        </div>
        <ul class="p-single__grid">
          <?php if (have_rows('example_slider')) : ?>
            <?php while (have_rows('example_slider')) : the_row(); ?>
              <li class="p-single__grid-item">
                <figure class="p-single__grid-item-image">
                  <img src="<?php the_sub_field('example_product_img'); ?>" alt="<?php the_title(); ?>" width="430" height="430">
                </figure>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        
        </ul>

        <!-- セクション1 -->
        <!-- <div class="p-single__section">
          <div class="p-single__section-image">
            <?php if (get_field('example_img')): ?>
              <img src="<?php the_field('example_img'); ?>" alt="<?php the_title(); ?>" width="1320" height="360">
            <?php else: ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/example/noimage.jpg" alt="<?php the_title(); ?>" width="1320" height="360">
            <?php endif; ?>
          </div>
          <div class="p-single__section-content">
            <h2 class="p-single__section-heading"><?php the_field('example_title'); ?></h2>
            <h3 class="p-single__section-subheading"><?php the_field('example_sub_title'); ?></h3>
            <p class="p-single__section-text"><?php the_field('example_sub_text'); ?></p>
          </div>
        </div> -->

        <!-- セクション2 -->
        <!-- <div class="p-single__section p-single__section--reverse">
          <div class="p-single__section-image">
            <?php if (get_field('example_img_2')): ?>
              <img src="<?php the_field('example_img_2'); ?>" alt="<?php the_title(); ?>" width="1320" height="360">
            <?php else: ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/example/noimage.jpg" alt="<?php the_title(); ?>" width="1320" height="360">
            <?php endif; ?>
          </div>
          <div class="p-single__section-content">
            <h2 class="p-single__section-heading"><?php the_field('example_title_2'); ?></h2>
            <h3 class="p-single__section-subheading"><?php the_field('example_sub_title_2'); ?></h3>
            <p class="p-single__section-text"><?php the_field('example_sub_text_2'); ?></p>
          </div>
        </div> -->

        <!-- 特徴セクション -->
        <!-- <?php if (get_field('example_feature_img')): ?>
          <figure class="p-single__feature-img">
            <img decoding="async" loading="lazy" src="<?php the_field('example_feature_img'); ?>" alt="<?php the_title(); ?>" width="1320" height="400">
          </figure>
        <?php else: ?>
          <figure class="p-single__feature-img">
            <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/example/noimage-large.jpg" alt="<?php the_title(); ?>" width="1320" height="400">
          </figure>
        <?php endif; ?> -->
        <div class="p-single__btn-wrapper">
          <a href="<?php echo esc_url(home_url('/example')); ?>" class="p-single__btn">
            <p class="p-single__btn-text">BACK</p>
            <div class="p-single__btn-icon"></div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>