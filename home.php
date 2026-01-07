<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Example">
          <h2 class="p-page-mv__title">施工事例</h2>
          <p class="p-page-mv__text">Sekishu tiled roof building</p>
        </div>
      </div>
    </div>
  </section>
  <div class="l-inner">
    <div class="p-example-tabs">
      <a href="<?php echo esc_url(home_url('/category.php?category=all')); ?>" class="p-example-tabs__item p-example-tabs__item--active">
        <span class="p-example-tabs__text">ALL</span>
      </a>
      <a href="<?php echo esc_url(home_url('/category.php?category=和瓦')); ?>" class="p-example-tabs__item">
        <span class="p-example-tabs__text">和瓦</span>
      </a>
      <a href="<?php echo esc_url(home_url('/category.php?category=洋瓦')); ?>" class="p-example-tabs__item">
        <span class="p-example-tabs__text">洋瓦</span>
      </a>
      <a href="<?php echo esc_url(home_url('/category.php?category=平瓦')); ?>" class="p-example-tabs__item">
        <span class="p-example-tabs__text">平瓦</span>
      </a>
      <a href="<?php echo esc_url(home_url('/category.php?category=防災瓦')); ?>" class="p-example-tabs__item">
        <span class="p-example-tabs__text">防災瓦</span>
      </a>
    </div>
  </div>
  <section class="p-example-list">
    <div class="l-inner">
      <div class="p-example-list__content">
        <ul class="p-example-list__cards">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
              <?php the_post(); ?>
              <li class="p-example-list__card">
                <a href="<?php the_permalink(); ?>" class="p-example-list__card-link">
                  <?php if (has_post_thumbnail()) : ?>
                    <figure class="p-example-list__card-image">
                      <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/example/example1.jpg" alt="<?php the_title(); ?>" width="420" height="260">
                    </figure>
                  <?php else : ?>
                    <figure class="p-example-list__card-image">
                      <img src="<?php echo get_template_directory_uri() ?>/images/example/noimage.jpg" alt="<?php the_title(); ?>">
                    </figure>
                  <?php endif; ?>
                  <div class="p-example-list__card-detail">
                    <h3 class="p-example-list__card-title"><?php the_title(); ?></h3>
                    <div class="p-example-list__bottom">
                      <div class="p-example-list__card-data">
                        <div class="p-example-list__row">
                          <p class="p-example-list__row-dt">client : </p>
                          <p class="p-example-list__row-dd">工事名(○○邸)</p>
                        </div>
                        <div class="p-example-list__row">
                          <p class="p-example-list__row-dt">AREA : </p>
                          <p class="p-example-list__row-dd">工事名(○○邸)</p>
                        </div>
                      </div>
                      <div class="p-example-list__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                          <g id="グループ_24788" data-name="グループ 24788" transform="translate(1054 4557)">
                            <circle id="楕円形_25" data-name="楕円形 25" cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#222" />
                            <g id="グループ_23475" data-name="グループ 23475" transform="translate(-1564.089 -6978.886)">
                              <path id="パス_42625" data-name="パス 42625" d="M189.089-2035.115l8,7-8,7" transform="translate(365 4490)" fill="none" stroke="#37af32" stroke-width="3" />
                              <path id="パス_42624" data-name="パス 42624" d="M189.089-2035.115l8,7-8,7" transform="translate(357 4490)" fill="none" stroke="#37af32" stroke-width="3" />
                              <path id="パス_42623" data-name="パス 42623" d="M189.089-2035.115l8,7-8,7" transform="translate(349 4490)" fill="none" stroke="#37af32" stroke-width="3" />
                            </g>
                          </g>
                        </svg>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>

        <?php
        // home.php のループ後などで呼び出す想定
        global $wp_query;

        $paged = max(1, get_query_var('paged'));
        $max   = (int) $wp_query->max_num_pages;

        // 1ページしか無いなら出さない
        if ($max > 1) :
          $base = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
        ?>
          <ul class="p-example-list__pager p-pager">

            <!-- Prev -->
            <li class="p-pager__list">
              <?php if ($paged > 1) : ?>
                <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" class="p-pager__link" aria-label="前のページへ">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                    <g id="グループ_24801" data-name="グループ 24801" transform="translate(1054 4557)">
                      <circle id="楕円形_25" data-name="楕円形 25" cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                      <g id="グループ_23475" data-name="グループ 23475" transform="translate(-479.911 -4524)">
                        <path id="パス_42625" data-name="パス 42625" d="M197.089-2035.115l-8,7,8,7" transform="translate(-719.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                        <path id="パス_42624" data-name="パス 42624" d="M197.089-2035.115l-8,7,8,7" transform="translate(-727.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                        <path id="パス_42623" data-name="パス 42623" d="M197.089-2035.115l-8,7,8,7" transform="translate(-735.177 2035.114)" fill="none" stroke="#222" stroke-width="3" />
                      </g>
                    </g>
                  </svg>
                </a>
              <?php else : ?>
                <!-- 1ページ目はリンク無しにしたい場合（必要ならCSSで薄くする） -->
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

            <!-- Numbers -->
            <ul class="p-pager__number">
              <?php
              // 数字部分だけWPに任せる（クラス名は差し替える）
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

                  // a/spanをクラス付きに差し替え
                  if ($is_current) {
                    // 現在ページ（span）
                    $page_num = strip_tags($link_html);
                    echo '<li class="p-pager__list-num"><span class="p-pager__link-num is-current" aria-current="page">'
                      . esc_html(sprintf('%02d', (int)$page_num))
                      . '</span></li>';
                  } else {
                    // 通常ページ（a）
                    // href を抽出
                    preg_match('/href=[\'"]([^\'"]+)[\'"]/', $link_html, $m);
                    $href = $m[1] ?? '#';
                    $page_num = strip_tags($link_html);

                    echo '<li class="p-pager__list-num"><a href="' . esc_url($href) . '" class="p-pager__link-num">'
                      . esc_html(sprintf('%02d', (int)$page_num))
                      . '</a></li>';
                  }
                endforeach;
              endif;
              ?>
            </ul>

            <!-- Next -->
            <li class="p-pager__list">
              <?php if ($paged < $max) : ?>
                <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" class="p-pager__link" aria-label="次のページへ">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                    <g id="グループ_24800" data-name="グループ 24800" transform="translate(1054 4557)">
                      <circle id="楕円形_25" data-name="楕円形 25" cx="40" cy="40" r="40" transform="translate(-1054 -4557)" fill="#37af32" />
                      <g id="グループ_23475" data-name="グループ 23475" transform="translate(-1564.089 -6978.886)">
                        <path id="パス_42625" data-name="パス 42625" d="M189.089-2035.115l8,7-8,7" transform="translate(365 4490)" fill="none" stroke="#222" stroke-width="3" />
                        <path id="パス_42624" data-name="パス 42624" d="M189.089-2035.115l8,7-8,7" transform="translate(357 4490)" fill="none" stroke="#222" stroke-width="3" />
                        <path id="パス_42623" data-name="パス 42623" d="M189.089-2035.115l8,7-8,7" transform="translate(349 4490)" fill="none" stroke="#222" stroke-width="3" />
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
  </section>
  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>