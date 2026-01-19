<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <!-- meta情報 -->
    <?php if (is_home() || is_front_page()) : ?>
        <title>瓦百景・コーポレートサイト</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="" />
        <meta property="og:description" content="" />


    <?php endif; ?>
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