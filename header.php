<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <!-- meta情報 -->
    <?php
    $site_name = (string) get_bloginfo('name');
    if ($site_name === '') {
      $site_name = '瓦百景';
    }

    $default_description = '島根県石見地方で受け継がれる石州瓦の魅力と、瓦百景のものづくりを紹介するコーポレートサイト。商品情報・施工事例・お知らせ・資料ダウンロードまで。';

    // 固定ページの「slugパス」（例: product/graslo, recruit/contact）を作る
    $page_path = '';
    if (is_page()) {
      $page_obj = get_queried_object();
      if (!empty($page_obj) && !empty($page_obj->ID)) {
        $ancestors = array_reverse(get_post_ancestors($page_obj->ID));
        $slugs = array();
        foreach ($ancestors as $ancestor_id) {
          $ancestor_slug = (string) get_post_field('post_name', $ancestor_id);
          if ($ancestor_slug !== '') {
            $slugs[] = $ancestor_slug;
          }
        }
        $self_slug = (string) get_post_field('post_name', $page_obj->ID);
        if ($self_slug !== '') {
          $slugs[] = $self_slug;
        }
        $page_path = implode('/', $slugs);
      }
    }

    // ページ別メタ（slugパスで判定）
    $meta_map = array(
      'home' => array(
        'title' => '瓦百景・コーポレートサイト',
        'description' => $default_description,
      ),
      'about' => array(
        'title' => '石州瓦とは｜' . $site_name,
        'description' => '石州瓦の歴史や特徴、暮らしを守る性能をわかりやすく解説。耐久性・防災性・意匠性など、石州瓦の魅力をご紹介します。',
      ),
      'reason' => array(
        'title' => '選ばれる理由｜' . $site_name,
        'description' => 'なぜ石州瓦が選ばれるのか。防災性能、断熱・遮音、経済性、メンテナンス性など、石州瓦の強みをわかりやすく紹介します。',
      ),
      'product' => array(
        'title' => '商品紹介｜' . $site_name,
        'description' => '瓦百景の石州瓦ラインアップ。GraSlo、BSルーフ、TSルーフ、FtypeU、ECO、セラミック製品まで、特徴と仕様をまとめてご覧いただけます。',
      ),
      'product/graslo' => array(
        'title' => 'GraSlo（グラスロ）｜商品紹介｜' . $site_name,
        'description' => '超低勾配にも対応する防災瓦「GraSlo（グラスロ）」。軽さと強さを両立した特長や性能、仕様を紹介します。',
      ),
      'graslo' => array(
        'title' => 'GraSlo（グラスロ）｜商品紹介｜' . $site_name,
        'description' => '超低勾配にも対応する防災瓦「GraSlo（グラスロ）」。軽さと強さを両立した特長や性能、仕様を紹介します。',
      ),
      'product/bs' => array(
        'title' => 'BSルーフ｜商品紹介｜' . $site_name,
        'description' => '安心の防災性能と耐久性を備えた「BSルーフ」。設計・施工の参考になる特長や仕様をまとめて掲載しています。',
      ),
      'bs' => array(
        'title' => 'BSルーフ｜商品紹介｜' . $site_name,
        'description' => '安心の防災性能と耐久性を備えた「BSルーフ」。設計・施工の参考になる特長や仕様をまとめて掲載しています。',
      ),
      'product/ts' => array(
        'title' => 'TSルーフ｜商品紹介｜' . $site_name,
        'description' => '防災性能と和の美を両立した「TSルーフ」。豊富な部材と機能美で、さまざまな建築に対応します。',
      ),
      'ts' => array(
        'title' => 'TSルーフ｜商品紹介｜' . $site_name,
        'description' => '防災性能と和の美を両立した「TSルーフ」。豊富な部材と機能美で、さまざまな建築に対応します。',
      ),
      'product/ftype' => array(
        'title' => 'FtypeU（ニューセラFタイプU）｜商品紹介｜' . $site_name,
        'description' => '和からモダンまで幅広く対応する平板瓦「ニューセラFタイプU」。高い防災性能と耐久性を備えた製品情報を掲載しています。',
      ),
      'ftype' => array(
        'title' => 'FtypeU（ニューセラFタイプU）｜商品紹介｜' . $site_name,
        'description' => '和からモダンまで幅広く対応する平板瓦「ニューセラFタイプU」。高い防災性能と耐久性を備えた製品情報を掲載しています。',
      ),
      'product/eco' => array(
        'title' => 'ニューセラECO｜商品紹介｜' . $site_name,
        'description' => 'デザイン性と快適性を両立する「ニューセラECO」。暮らしに寄り添う機能と、意匠のバリエーションを紹介します。',
      ),
      'eco' => array(
        'title' => 'ニューセラECO｜商品紹介｜' . $site_name,
        'description' => 'デザイン性と快適性を両立する「ニューセラECO」。暮らしに寄り添う機能と、意匠のバリエーションを紹介します。',
      ),
      'product/ceramic' => array(
        'title' => 'セラミック製品｜商品紹介｜' . $site_name,
        'description' => '外構や景観づくりに活かせるセラミック製品。瓦の素材感を活かした提案や製品情報を掲載しています。',
      ),
      'ceramic' => array(
        'title' => 'セラミック製品｜商品紹介｜' . $site_name,
        'description' => '外構や景観づくりに活かせるセラミック製品。瓦の素材感を活かした提案や製品情報を掲載しています。',
      ),
      'company' => array(
        'title' => '会社概要｜' . $site_name,
        'description' => '会社概要、沿革、所在地など瓦百景の企業情報を掲載。ものづくりへの想いと地域に根ざした取り組みを紹介します。',
      ),
      'topics' => array(
        'title' => '特集｜' . $site_name,
        'description' => '石州瓦や屋根にまつわる特集記事をまとめて掲載。素材、施工、暮らしのアイデアなどをわかりやすくお届けします。',
      ),
      'download' => array(
        'title' => '資料請求・ダウンロード｜' . $site_name,
        'description' => '瓦製品カタログやリーフレットをPDFでご用意。検討・設計に役立つ資料をダウンロードしてご活用ください。',
      ),
      'professional' => array(
        'title' => 'プロ向け情報｜' . $site_name,
        'description' => '設計・施工のプロ向け情報。性能試験成績書、部分詳細図CAD、施工マニュアル、マンセル値、不燃材認定、アスベスト不使用などを掲載。',
      ),
      'professional/performance' => array(
        'title' => '性能試験成績書｜プロ向け情報｜' . $site_name,
        'description' => '耐風圧性能試験成績書・棟回転試験成績書など、性能に関する資料をPDFでダウンロードできます。',
      ),
      'performance' => array(
        'title' => '性能試験成績書｜プロ向け情報｜' . $site_name,
        'description' => '耐風圧性能試験成績書・棟回転試験成績書など、性能に関する資料をPDFでダウンロードできます。',
      ),
      'professional/cad' => array(
        'title' => '部分詳細図CAD｜プロ向け情報｜' . $site_name,
        'description' => '瓦屋根標準設計・施工ガイドラインに沿った一般的な在来工法の部分詳細図CADデータをご用意しています。',
      ),
      'cad' => array(
        'title' => '部分詳細図CAD｜プロ向け情報｜' . $site_name,
        'description' => '瓦屋根標準設計・施工ガイドラインに沿った一般的な在来工法の部分詳細図CADデータをご用意しています。',
      ),
      'professional/manual' => array(
        'title' => '施工マニュアル｜プロ向け情報｜' . $site_name,
        'description' => '瓦屋根標準設計・施工ガイドラインに基づく、設計に必要な製品規格・施工用材・工法をまとめた施工マニュアルです。',
      ),
      'manual' => array(
        'title' => '施工マニュアル｜プロ向け情報｜' . $site_name,
        'description' => '瓦屋根標準設計・施工ガイドラインに基づく、設計に必要な製品規格・施工用材・工法をまとめた施工マニュアルです。',
      ),
      'professional/munsell' => array(
        'title' => 'マンセル値｜プロ向け情報｜' . $site_name,
        'description' => '代表的な製品のマンセル値を掲載。色指定や設計時の参考にご活用いただけます。',
      ),
      'munsell' => array(
        'title' => 'マンセル値｜プロ向け情報｜' . $site_name,
        'description' => '代表的な製品のマンセル値を掲載。色指定や設計時の参考にご活用いただけます。',
      ),
      'professional/noncombustible' => array(
        'title' => '不燃材認定について｜プロ向け情報｜' . $site_name,
        'description' => '不燃材認定に関する資料・情報を掲載しています。設計・申請時の確認にご活用ください。',
      ),
      'noncombustible' => array(
        'title' => '不燃材認定について｜プロ向け情報｜' . $site_name,
        'description' => '不燃材認定に関する資料・情報を掲載しています。設計・申請時の確認にご活用ください。',
      ),
      'professional/nonasbestos' => array(
        'title' => 'アスベスト不使用｜プロ向け情報｜' . $site_name,
        'description' => '当社製造の瓦は、原材料に石綿（アスベスト）を使用しておりません。安心してご採用いただけます。',
      ),
      'nonasbestos' => array(
        'title' => 'アスベスト不使用｜プロ向け情報｜' . $site_name,
        'description' => '当社製造の瓦は、原材料に石綿（アスベスト）を使用しておりません。安心してご採用いただけます。',
      ),
      'shop' => array(
        'title' => '全国の瓦施工店｜' . $site_name,
        'description' => '石州瓦の美しさと強さを支える、全国の瓦施工店をご紹介。地域に根ざした職人の技と、確かな施工力をお届けします。',
      ),
      'recruit' => array(
        'title' => '採用情報｜' . $site_name,
        'description' => '瓦百景の採用情報。ものづくりと地域の暮らしを支える仕事に興味のある方へ、募集情報や働く環境をご案内します。',
      ),
      'recruit/contact' => array(
        'title' => 'お問い合わせ｜' . $site_name,
        'description' => '製品や資料、施工に関するご相談・お問い合わせはこちらから。内容を確認のうえ、担当よりご連絡いたします。',
      ),
      'privacy' => array(
        'title' => 'プライバシーポリシー｜' . $site_name,
        'description' => '瓦百景のプライバシーポリシー。個人情報の取り扱い、利用目的、安全管理についてご案内します。',
      ),
    );

    // 判定キー作成
    $meta_key = '';
    if (is_front_page()) {
      $meta_key = 'home';
    } elseif (is_home() || is_category() || is_singular('post')) {
      // 施工事例（投稿）
      $meta_key = 'example';
    } elseif (is_post_type_archive('news') || is_singular('news') || is_tax('news_category') || is_tax('news_tag')) {
      $meta_key = 'news';
    } elseif (is_page() && $page_path !== '') {
      $meta_key = $page_path;
    }

    // title/description 決定
    $meta_title = '';
    $meta_description = '';

    // 施工事例（投稿）
    if ($meta_key === 'example') {
      if (is_singular('post')) {
        $meta_title = get_the_title() . '｜施工事例｜' . $site_name;
        $meta_description = '石州瓦の施工事例「' . get_the_title() . '」の紹介ページです。施工のポイントや仕上がりをご覧いただけます。';
      } elseif (is_category()) {
        $cat_name = single_cat_title('', false);
        $meta_title = '施工事例（' . $cat_name . '）｜' . $site_name;
        $meta_description = '石州瓦の施工事例をカテゴリ別にご紹介。' . $cat_name . 'の事例一覧ページです。';
      } else {
        $meta_title = '施工事例｜' . $site_name;
        $meta_description = '石州瓦の施工事例を掲載。和瓦・洋瓦・平瓦・防災瓦など、建築のスタイルに合わせた事例をご覧いただけます。';
      }
    }

    // お知らせ（news CPT）
    if ($meta_key === 'news') {
      if (is_singular('news')) {
        $meta_title = get_the_title() . '｜お知らせ｜' . $site_name;
        $meta_description = '瓦百景からのお知らせ「' . get_the_title() . '」の詳細ページです。';
      } elseif (is_tax('news_category')) {
        $term = get_queried_object();
        $term_name = (!empty($term) && !empty($term->name)) ? $term->name : 'カテゴリー';
        $meta_title = 'お知らせ（' . $term_name . '）｜' . $site_name;
        $meta_description = '瓦百景からのお知らせをカテゴリー別に掲載。' . $term_name . 'の一覧ページです。';
      } elseif (is_tax('news_tag')) {
        $term = get_queried_object();
        $term_name = (!empty($term) && !empty($term->name)) ? $term->name : 'タグ';
        $meta_title = 'お知らせ（' . $term_name . '）｜' . $site_name;
        $meta_description = '瓦百景からのお知らせをタグ別に掲載。' . $term_name . 'の一覧ページです。';
      } else {
        $meta_title = 'お知らせ｜' . $site_name;
        $meta_description = '瓦百景からのお知らせ一覧。イベント、更新情報、重要なお知らせなど最新情報を掲載します。';
      }
    }

    // 固定ページ（slugパスで上書き）
    if ($meta_title === '' && $meta_key !== '' && isset($meta_map[$meta_key])) {
      $meta_title = $meta_map[$meta_key]['title'];
      $meta_description = $meta_map[$meta_key]['description'];
    }

    // フォールバック
    if ($meta_title === '') {
      $meta_title = trim((string) wp_get_document_title());
      if ($meta_title === '') {
        if (is_singular()) {
          $meta_title = get_the_title();
        } else {
          $meta_title = $site_name;
        }
      }
      if (strpos($meta_title, $site_name) === false) {
        $meta_title .= '｜' . $site_name;
      }
    }
    if ($meta_description === '') {
      if (is_singular()) {
        $excerpt = (string) get_the_excerpt();
        $excerpt = trim(wp_strip_all_tags($excerpt));
        if ($excerpt !== '') {
          $meta_description = $excerpt;
        } else {
          $meta_description = $default_description;
        }
      } else {
        $meta_description = $default_description;
      }
    }

    // OGP用
    $og_type = is_singular() ? 'article' : 'website';
    $og_url = '';
    if (is_singular()) {
      $og_url = (string) get_permalink();
    } else {
      // アーカイブ・固定ページ一覧など
      global $wp;
      $og_url = isset($wp) ? home_url(add_query_arg(array(), $wp->request)) : home_url('/');
    }
    ?>
    <title><?php echo esc_html($meta_title); ?></title>
    <meta name="description" content="<?php echo esc_attr($meta_description); ?>" />
    <meta name="keywords" content="石州瓦,瓦,屋根,瓦百景,防災瓦,施工事例,瓦施工,瓦カタログ" />
    <meta property="og:title" content="<?php echo esc_attr($meta_title); ?>" />
    <meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>" />
    <meta name="twitter:title" content="<?php echo esc_attr($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg">
    <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />

    <!-- ogp -->
    <!-- ファビコン -->
    <link rel="icon" href="<?php echo get_template_directory_uri() ?>/images/common/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/images/common/apple-touch-icon.png">
    <!-- css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
    <!--   <?php if (is_404()) : ?>
        <meta http-equiv="refresh" content=" 3; url=<?php echo esc_url(home_url("/")); ?>">
    <?php endif; ?> -->
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php if (is_front_page()): ?>
        <header class="p-header">
            <div class="p-header__inner">
                <div class="p-header__content">
                    <h1 class="p-header__logo">
                        <a class="p-header__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/images/common/header_logo.png" alt="瓦百景" width="160" height="90">
                        </a>
                    </h1>
                    <div class="p-header__navigation">
                        <button class="p-header__drawer p-drawer-icon">
                            <span class="p-drawer-icon__bars">
                                <span class="p-drawer-icon__bar1"></span>
                                <span class="p-drawer-icon__bar2"></span>
                                <span class="p-drawer-icon__bar3"></span>
                            </span>
                        </button>

                    </div>
                    <div class="p-header__drawer-content p-drawer-content">
                        <div class="p-drawer-content__items">
                            <ul class="p-drawer-content__lists">
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">TOP</span>
                                        <span class="p-drawer-content__link-ja">トップ</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">ABOUT</span>
                                        <span class="p-drawer-content__link-ja">石州瓦とは</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/reason/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">REASON</span>
                                        <span class="p-drawer-content__link-ja">選ばれる理由</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/product/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">PRODUCT</span>
                                        <span class="p-drawer-content__link-ja">商品紹介</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/company/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">COMPANY</span>
                                        <span class="p-drawer-content__link-ja">会社概要</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/topics/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">TOPICS</span>
                                        <span class="p-drawer-content__link-ja">特集</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/news/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">NEWS</span>
                                        <span class="p-drawer-content__link-ja">お知らせ</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/download/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">DOWNLOAD</span>
                                        <span class="p-drawer-content__link-ja">製品資料</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/professional/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">PROFESSIONAL</span>
                                        <span class="p-drawer-content__link-ja">プロ向け情報</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">RECRUIT</span>
                                        <span class="p-drawer-content__link-ja">採用情報</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/recruit/contact')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">CONTACT</span>
                                        <span class="p-drawer-content__link-ja">お問い合わせ</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <ul class="p-header__nav-lists">
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/about')); ?>" class="p-header__nav-link">・石州瓦とは</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/reason')); ?>" class="p-header__nav-link">・選ばれる理由</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/product')); ?>" class="p-header__nav-link">・商品紹介</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/example')); ?>" class="p-header__nav-link">・施工事例</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/company')); ?>" class="p-header__nav-link">・会社概要</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/topics')); ?>" class="p-header__nav-link">・特集</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/news')); ?>" class="p-header__nav-link">・お知らせ</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/download')); ?>" class="p-header__nav-link">・製品資料</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/professional')); ?>" class="p-header__nav-link">・プロの皆様へ</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/recruit')); ?>" class="p-header__nav-link">・採用情報</a>
            </li>
            <li class="p-header__nav-list">
                <a href="<?php echo esc_url(home_url('/recruit/contact')); ?>" class="p-header__nav-link">・お問い合わせ</a>
            </li>
        </ul>
    <?php else : ?>
        <header class="p-header">
            <div class="p-header__inner">
                <div class="p-header__content">
                    <h1 class="p-header__logo">
                        <a class="p-header__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/images/common/header_logo.png" alt="瓦百景" width="160" height="90">
                        </a>
                    </h1>
                    <div class="p-header__navigation p-header__navigation--page">
                        <div class="p-header__breadcrumbs--pc">
                            <?php get_template_part('includes/breadcrumbs'); ?>
                        </div>
                        <button class="p-header__drawer p-drawer-icon">
                            <span class="p-drawer-icon__bars">
                                <span class="p-drawer-icon__bar1"></span>
                                <span class="p-drawer-icon__bar2"></span>
                                <span class="p-drawer-icon__bar3"></span>
                            </span>
                        </button>
                    </div>
                    <div class="p-header__breadcrumbs--sp">
                        <?php get_template_part('includes/breadcrumbs'); ?>
                    </div>
                    <div class="p-header__drawer-content p-drawer-content">
                        <div class="p-drawer-content__items">
                            <ul class="p-drawer-content__lists">
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">TOP</span>
                                        <span class="p-drawer-content__link-ja">トップ</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">ABOUT</span>
                                        <span class="p-drawer-content__link-ja">石州瓦とは</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/reason/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">REASON</span>
                                        <span class="p-drawer-content__link-ja">選ばれる理由</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/product/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">PRODUCT</span>
                                        <span class="p-drawer-content__link-ja">商品紹介</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/company/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">COMPANY</span>
                                        <span class="p-drawer-content__link-ja">会社概要</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/topics/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">TOPICS</span>
                                        <span class="p-drawer-content__link-ja">特集</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/news/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">NEWS</span>
                                        <span class="p-drawer-content__link-ja">お知らせ</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/download/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">DOWNLOAD</span>
                                        <span class="p-drawer-content__link-ja">製品資料</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/professional/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">PROFESSIONAL</span>
                                        <span class="p-drawer-content__link-ja">プロ向け情報</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">RECRUIT</span>
                                        <span class="p-drawer-content__link-ja">採用情報</span>
                                    </a>
                                </li>
                                <li class="p-drawer-content__list">
                                    <a href="<?php echo esc_url(home_url('/recruit/contact')); ?>" class="p-drawer-content__link">
                                        <span class="p-drawer-content__link-en">CONTACT</span>
                                        <span class="p-drawer-content__link-ja">お問い合わせ</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </header>

    <?php endif; ?>