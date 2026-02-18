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

          <?php
          global $wp_query;

          $paged = max(1, get_query_var('paged'));
          $max   = (int) $wp_query->max_num_pages;

          if ($max > 1) :
            $base = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
          ?>
            <ul class="p-top-news__pager p-pager">
              <li class="p-pager__list">
                <?php if ($paged > 1) : ?>
                  <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" class="p-pager__link" aria-label="前のページへ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <g transform="translate(1054 4557)">
                        <circle cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                        <g transform="translate(-479.911 -4524)">
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-719.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-727.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-735.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                        </g>
                      </g>
                    </svg>
                  </a>
                <?php else : ?>
                  <span class="p-pager__link" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <g transform="translate(1054 4557)">
                        <circle cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                        <g transform="translate(-479.911 -4524)">
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-719.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-727.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M197.089-2035.115l-8,7,8,7" transform="translate(-735.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                        </g>
                      </g>
                    </svg>
                  </span>
                <?php endif; ?>
              </li>

              <ul class="p-pager__number">
                <?php
                $links = paginate_links([
                  'base'      => $base,
                  'format'    => '',
                  'current'   => $paged,
                  'total'     => $max,
                  'mid_size'  => 1,
                  'end_size'  => 1,
                  'type'      => 'array',
                  'prev_next' => false,
                ]);

                if (!empty($links)) :
                  foreach ($links as $link_html) :
                    $is_current = (strpos($link_html, 'current') !== false);

                    if ($is_current) {
                      $page_num = strip_tags($link_html);
                      echo '<li class="p-pager__list-num"><span class="p-pager__link-num is-current" aria-current="page">'
                        . esc_html(sprintf('%02d', (int) $page_num))
                        . '</span></li>';
                    } else {
                      preg_match('/href=[\'"]([^\'"]+)[\'"]/', $link_html, $m);
                      $href = $m[1] ?? '#';
                      $page_num = strip_tags($link_html);

                      echo '<li class="p-pager__list-num"><a href="' . esc_url($href) . '" class="p-pager__link-num">'
                        . esc_html(sprintf('%02d', (int) $page_num))
                        . '</a></li>';
                    }
                  endforeach;
                endif;
                ?>
              </ul>

              <li class="p-pager__list">
                <?php if ($paged < $max) : ?>
                  <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" class="p-pager__link" aria-label="次のページへ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <g transform="translate(1054 4557)">
                        <circle cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                        <g transform="translate(-1564.089 -6978.886)">
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(365 4490)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(357 4490)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(349 4490)" fill="none" stroke="#222" stroke-width="3" />
                        </g>
                      </g>
                    </svg>
                  </a>
                <?php else : ?>
                  <span class="p-pager__link" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <g transform="translate(1054 4557)">
                        <circle cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                        <g transform="translate(-1564.089 -6978.886)">
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(365 4490)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(357 4490)" fill="none" stroke="#222" stroke-width="3" />
                          <path d="M189.089-2035.115l8,7-8,7" transform="translate(349 4490)" fill="none" stroke="#222" stroke-width="3" />
                        </g>
                      </g>
                    </svg>
                  </span>
                <?php endif; ?>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>