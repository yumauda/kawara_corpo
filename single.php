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
  
  <section class="p-single">
    <div class="l-inner">
      <div class="p-single__content">
        <!-- メイン画像 -->
        <figure class="p-single__main-image">
          <img src="<?php echo get_template_directory_uri(); ?>/images/single/single1.jpg" alt="<?php the_title(); ?>" width="1320" height="360">
        </figure>

        <!-- ヘッダー部分 -->
        <div class="p-single__header">
          <h1 class="p-single__title">グラスロ 来待</h1>
          <div class="p-single__meta">
            <div class="p-single__meta-item">工事名(○○邸)</div>
            <div class="p-single__meta-item">島根県大田市</div>
          </div>
        </div>

        <!-- セクション1 -->
        <div class="p-single__section">
          <div class="p-single__section-image">
            <img src="<?php echo get_template_directory_uri(); ?>/images/example/example1.jpg" alt="施工事例画像">
          </div>
          <div class="p-single__section-content">
            <h2 class="p-single__section-heading">あらゆる屋根に、<br>新しい瓦の可能性を。</h2>
            <h3 class="p-single__section-subheading">グラスロは、屋根勾配を選ばないJ形瓦です。</h3>
            <p class="p-single__section-text">従来の瓦では、施工できなかった緩い勾配の屋根でも使える画期的な製品です。<br>在来工法の和風住宅からモダンな低勾配屋根の住宅まで様々な住宅に対応いたします。</p>
          </div>
        </div>

        <!-- セクション2 -->
        <div class="p-single__section p-single__section--reverse">
          <div class="p-single__section-image">
            <img src="<?php echo get_template_directory_uri(); ?>/images/example/example1.jpg" alt="施工事例画像">
          </div>
          <div class="p-single__section-content">
            <h2 class="p-single__section-heading">あらゆる屋根に、<br>新しい瓦の可能性を。</h2>
            <h3 class="p-single__section-subheading">グラスロは、屋根勾配を選ばないJ形瓦です。</h3>
            <p class="p-single__section-text">従来の瓦では、施工できなかった緩い勾配の屋根でも使える画期的な製品です。<br>在来工法の和風住宅からモダンな低勾配屋根の住宅まで様々な住宅に対応いたします。</p>
          </div>
        </div>

        <!-- 特徴セクション -->
        <figure class="p-single__feature-img">
          <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/single/graslo.png" alt="<?php the_title(); ?>" width="1320" height="400">
        </figure>
        <div class="p-single__btn-wrapper">
          <a href="<?php echo esc_url(home_url('/example')); ?>" class="p-single__btn">
            <p class="p-single__btn-text">施工一覧へ戻る</p>
            <div class="p-single__btn-icon"></div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>