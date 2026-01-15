<ul class="p-header__breadcrumbs">
    <li class="p-header__breadcrumb">
        <a class="p-header__breadcrumb-link" href="<?php echo esc_url(home_url('/')); ?>">
            HOME
        </a>
    </li>

    <?php
    // 固定ページ：親ページ（先祖）を表示
    if (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        if (!empty($ancestors)) {
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                echo '<li class="p-header__breadcrumb"><div class="p-header__breadcrumb-icon">&gt;</div></li>';
                echo '<li class="p-header__breadcrumb"><a class="p-header__breadcrumb-link" href="'
                    . esc_url(get_permalink($ancestor_id)) . '">'
                    . esc_html(get_the_title($ancestor_id)) . '</a></li>';
            }
        }
    }

    // お知らせ詳細：アーカイブを親として表示
    if (is_singular('news')) {
        $news_archive = get_post_type_archive_link('news');
        if ($news_archive) {
            echo '<li class="p-header__breadcrumb"><div class="p-header__breadcrumb-icon">&gt;</div></li>';
            echo '<li class="p-header__breadcrumb"><a class="p-header__breadcrumb-link" href="'
                . esc_url($news_archive) . '">お知らせ</a></li>';
        }
    }
    ?>

    <li class="p-header__breadcrumb">
        <div class="p-header__breadcrumb-icon">
            &gt;
        </div>
    </li>
    <li class="p-header__breadcrumb">
        <span class="p-header__breadcrumb-link p-header__breadcrumb-link--current">
            <?php the_title(); ?>
        </span>
    </li>
</ul>