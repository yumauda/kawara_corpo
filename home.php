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
  <div class="l-inner">
    <?php
    // ====== Example search (checkbox + multi filter) ======
    $posts_page_id = (int) get_option('page_for_posts');
    $action_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');

    // 設定（WordPress「表示設定」の 1ページに表示する最大投稿数 をデフォルトにする）
    $default_limit = (int) get_option('posts_per_page');
    if ($default_limit <= 0) {
      $default_limit = 10;
    }
    $tile_types = array(
      array('key' => 'flat', 'label' => '平瓦', 'max_posts' => 0),
      array('key' => 'western', 'label' => '洋瓦', 'max_posts' => 0),
      array('key' => 'japanese', 'label' => '和瓦', 'max_posts' => 0),
      array('key' => 'disaster', 'label' => '防災瓦', 'max_posts' => 0),
    );
    $products = array(
      array('key' => 'graslo', 'label' => 'グラスロ', 'max_posts' => 0),
      array('key' => 'bs_roof', 'label' => 'BSルーフ', 'max_posts' => 0),
      array('key' => 'ts_roof', 'label' => 'TSルーフ', 'max_posts' => 0),
      array('key' => 'newcera_ftype_u', 'label' => 'ニューセラFタイプU', 'max_posts' => 0),
      array('key' => 'newcera_eco2', 'label' => 'ニューセラECOⅡ', 'max_posts' => 0),
      array('key' => 'ceramic_sand', 'label' => 'セラミックサンド', 'max_posts' => 0),
    );
    $colors = array(
      array('key' => 'black', 'label' => '黒系', 'max_posts' => 0),
      array('key' => 'brown', 'label' => 'ブラウン系', 'max_posts' => 0),
      array('key' => 'beige', 'label' => 'ベージュ系', 'max_posts' => 0),
      array('key' => 'reddish_brown', 'label' => '赤茶系', 'max_posts' => 0),
    );

    if (function_exists('get_field')) {
      $opt_tile_types = get_field('example_search_tile_types', 'option');
      $opt_products = get_field('example_search_products', 'option');
      $opt_colors = get_field('example_search_colors', 'option');
      if (is_array($opt_tile_types) && !empty($opt_tile_types)) {
        $tile_types = $opt_tile_types;
      }
      if (is_array($opt_products) && !empty($opt_products)) {
        $products = $opt_products;
      }
      if (is_array($opt_colors) && !empty($opt_colors)) {
        $colors = $opt_colors;
      }
    }

    $tile_choices = array();
    $tile_limits = array();
    foreach ($tile_types as $row) {
      $k = isset($row['key']) ? (string) $row['key'] : '';
      $l = isset($row['label']) ? (string) $row['label'] : '';
      if ($k !== '' && $l !== '') {
        $tile_choices[$k] = $l;
        $tile_limits[$k] = isset($row['max_posts']) ? (int) $row['max_posts'] : 0;
      }
    }
    $product_choices = array();
    $product_limits = array();
    foreach ($products as $row) {
      $k = isset($row['key']) ? (string) $row['key'] : '';
      $l = isset($row['label']) ? (string) $row['label'] : '';
      if ($k !== '' && $l !== '') {
        $product_choices[$k] = $l;
        $product_limits[$k] = isset($row['max_posts']) ? (int) $row['max_posts'] : 0;
      }
    }
    $color_choices = array();
    $color_limits = array();
    foreach ($colors as $row) {
      $k = isset($row['key']) ? (string) $row['key'] : '';
      $l = isset($row['label']) ? (string) $row['label'] : '';
      if ($k !== '' && $l !== '') {
        $color_choices[$k] = $l;
        $color_limits[$k] = isset($row['max_posts']) ? (int) $row['max_posts'] : 0;
      }
    }

    // GET（複合検索：同一行はOR、行同士はAND）
    $selected_types = isset($_GET['type']) ? (array) $_GET['type'] : array();
    $selected_products = isset($_GET['product']) ? (array) $_GET['product'] : array();
    $selected_colors = isset($_GET['color']) ? (array) $_GET['color'] : array();

    $selected_types = array_values(array_filter(array_map('sanitize_text_field', $selected_types)));
    $selected_products = array_values(array_filter(array_map('sanitize_text_field', $selected_products)));
    $selected_colors = array_values(array_filter(array_map('sanitize_text_field', $selected_colors)));

    // ホワイトリスト
    $selected_types = array_values(array_intersect($selected_types, array_keys($tile_choices)));
    $selected_products = array_values(array_intersect($selected_products, array_keys($product_choices)));
    $selected_colors = array_values(array_intersect($selected_colors, array_keys($color_choices)));

    // 表示上限（選択された項目の max_posts がある場合は「最小値」を採用）
    $posts_limit = $default_limit;
    foreach ($selected_types as $k) {
      $limit = $tile_limits[$k] ?? 0;
      if ($limit > 0) {
        $posts_limit = min($posts_limit, $limit);
      }
    }
    foreach ($selected_products as $k) {
      $limit = $product_limits[$k] ?? 0;
      if ($limit > 0) {
        $posts_limit = min($posts_limit, $limit);
      }
    }
    foreach ($selected_colors as $k) {
      $limit = $color_limits[$k] ?? 0;
      if ($limit > 0) {
        $posts_limit = min($posts_limit, $limit);
      }
    }
    if ($posts_limit <= 0) {
      $posts_limit = $default_limit;
    }

    // home.php / 固定ページ等で paged/page が分かれるため両方見る
    $paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

    $meta_query = array(
      'relation' => 'AND',
      // 検索対象フラグ：未設定 or ON を表示（既存投稿が消えないように）
      array(
        'relation' => 'OR',
        array(
          'key' => 'example_is_target',
          'compare' => 'NOT EXISTS',
        ),
        array(
          'key' => 'example_is_target',
          'value' => '1',
          'compare' => '=',
        ),
      ),
    );
    if (!empty($selected_types)) {
      $or = array('relation' => 'OR');
      foreach ($selected_types as $v) {
        $or[] = array(
          'key' => 'example_tile_types',
          'value' => '"' . $v . '"',
          'compare' => 'LIKE',
        );
      }
      $meta_query[] = $or;
    }
    if (!empty($selected_products)) {
      $or = array('relation' => 'OR');
      foreach ($selected_products as $v) {
        $or[] = array(
          'key' => 'example_products',
          'value' => '"' . $v . '"',
          'compare' => 'LIKE',
        );
      }
      $meta_query[] = $or;
    }
    if (!empty($selected_colors)) {
      $or = array('relation' => 'OR');
      foreach ($selected_colors as $v) {
        $or[] = array(
          'key' => 'example_colors',
          'value' => '"' . $v . '"',
          'compare' => 'LIKE',
        );
      }
      $meta_query[] = $or;
    }

    $query_args = array();
    if (!empty($selected_types)) {
      $query_args['type'] = $selected_types;
    }
    if (!empty($selected_products)) {
      $query_args['product'] = $selected_products;
    }
    if (!empty($selected_colors)) {
      $query_args['color'] = $selected_colors;
    }

    $example_query_args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => $posts_limit,
      'paged' => $paged,
      'orderby' => 'date',
      'order' => 'DESC',
    );
    // 条件が1つでもあれば meta_query を追加（ACF未導入でも動くように）
    if (count($meta_query) > 1) {
      $example_query_args['meta_query'] = $meta_query;
    }

    $example_query = new WP_Query($example_query_args);
    ?>

    <form class="p-example-search js-example-search" action="<?php echo esc_url($action_url); ?>" method="get">
      <div class="p-example-search__row">
        <p class="p-example-search__label">瓦種別：</p>
        <div class="p-example-search__items">
          <?php foreach ($tile_choices as $key => $label) : ?>
            <?php $id = 'example-type-' . $key; ?>
            <input class="p-example-search__input" type="checkbox" name="type[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($id); ?>"<?php echo in_array($key, $selected_types, true) ? ' checked' : ''; ?>>
            <label class="p-example-search__btn" for="<?php echo esc_attr($id); ?>"><?php echo esc_html($label); ?></label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="p-example-search__row">
        <p class="p-example-search__label">商品名：</p>
        <div class="p-example-search__items">
          <?php foreach ($product_choices as $key => $label) : ?>
            <?php $id = 'example-product-' . $key; ?>
            <input class="p-example-search__input" type="checkbox" name="product[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($id); ?>"<?php echo in_array($key, $selected_products, true) ? ' checked' : ''; ?>>
            <label class="p-example-search__btn" for="<?php echo esc_attr($id); ?>"><?php echo esc_html($label); ?></label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="p-example-search__row">
        <p class="p-example-search__label">色種別：</p>
        <div class="p-example-search__items">
          <?php foreach ($color_choices as $key => $label) : ?>
            <?php $id = 'example-color-' . $key; ?>
            <input class="p-example-search__input" type="checkbox" name="color[]" value="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($id); ?>"<?php echo in_array($key, $selected_colors, true) ? ' checked' : ''; ?>>
            <label class="p-example-search__btn" for="<?php echo esc_attr($id); ?>"><?php echo esc_html($label); ?></label>
          <?php endforeach; ?>
        </div>
      </div>

      <noscript>
        <button type="submit">検索</button>
      </noscript>
    </form>
  </div>
  <section class="p-example-list js-blur-content">
    <div class="l-inner">
      <div class="p-example-list__content">
        <ul class="p-example-list__cards">
          <?php if ($example_query->have_posts()) : ?>
            <?php while ($example_query->have_posts()) : ?>
              <?php $example_query->the_post(); ?>
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
                          <p class="p-example-list__row-dd"><?php the_field('example_name'); ?></p>
                        </div>
                        <div class="p-example-list__row">
                          <p class="p-example-list__row-dt">AREA : </p>
                          <p class="p-example-list__row-dd"><?php the_field('example_place'); ?></p>
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
          <?php else : ?>
            <li class="p-example-list__card">
              <p>該当する施工事例が見つかりませんでした。</p>
            </li>
          <?php endif; ?>
        </ul>

        <?php
        // home.php のループ後などで呼び出す想定
        $max = (int) $example_query->max_num_pages;

        // 1ページしか無いなら出さない
        if ($max > 1) :
          $base = add_query_arg($query_args, get_pagenum_link(999999999));
          $base = str_replace(999999999, '%#%', esc_url($base));
        ?>
          <ul class="p-example-list__pager p-pager">

            <!-- Prev -->
            <li class="p-pager__list">
              <?php if ($paged > 1) : ?>
                <a href="<?php echo esc_url(add_query_arg($query_args, get_pagenum_link($paged - 1))); ?>" class="p-pager__link" aria-label="前のページへ">
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
                <a href="<?php echo esc_url(add_query_arg($query_args, get_pagenum_link($paged + 1))); ?>" class="p-pager__link" aria-label="次のページへ">
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

        <?php wp_reset_postdata(); ?>

      </div>
    </div>
  </section>
  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>