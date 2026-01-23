<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Technical">
          <h2 class="p-page-mv__title">アスベスト不使用</h2>
          <p class="p-page-mv__text">For Professional</p>
        </div>
      </div>
    </div>
  </section>
  <section class="p-munsell js-blur-content">
    <div class="l-inner">
      <div class="p-munsell__content">
        <div class="p-munsell__title-wrapper">
          <p class="p-munsell__title-en">Noasbestos</p>
          <h3 class="p-munsell__title-ja">石綿(アスベスト)不使用について</h3>
        </div>
        <div class="p-munsell__text-wrapper">
          <p class="p-munsell__text">当社製造瓦は粘土瓦であり、粘土瓦は、原材料に石綿(アスベスト)を必要としない建材として、経済産業省及び国土交通省のページに記載されております。<br>
            原料となる粘土は採掘現場で品質をチェックし、良質な原料粘土のみを使用しています。<br>
            従って当社製造瓦は、原材料に石綿(アスベスト)を一切使用しておりません。<br>
            また、他の屋根材のように過去において、原材料に石綿(アスベスト)を使用したということも一切ございません。</p>
        </div>
        <div class="p-asbestos">
          <figure class="p-asbestos__img">
            <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/noasbestos/noasbestos-img.png" alt="石綿(アスベスト)不使用" width="750" height="900">
          </figure>
          <div class="p-asbestos__btn-wrapper">
            <a href="#" class="p-asbestos__btn">
              <div class="p-asbestos__btn-icon">
                <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/noasbestos/pdf.png" alt="PDFダウンロード" width="20" height="27">
              </div>
              <p class="p-asbestos__btn-text">PDFダウンロード</p>
            </a>
          </div>
          <div class="p-noncombustible__text-wrapper">
            <p class="p-noncombustible__text">参考までに<br>
              不燃材料認定試験は、試験体を720度にて20分間保持し、試験体に亀裂の発生や有毒ガスが発生しないか確認し、不燃材かどうかの判定をしています。粘土瓦以外のセメント瓦や化粧スレートが各製品毎に不燃材の認定を取得する必要があるのは、表面に塗装した塗料が燃焼し、有毒ガスが発生する可能性や試験体に亀裂が発生する可能性があるからです。<br>
              また、粘土瓦の表面着色層は、釉薬というガラス状の層であり焼成によって形成されます。そのため釉薬自体も不燃です。</p>
          </div>
          <div class="p-related-links">
            <div class="p-related-links__header">
              <h3 class="p-related-links__title">関連リンク</h3>
            </div>
            <div class="p-related-links__list">
              <a href="#" class="p-related-links__item" target="_blank" rel="noopener noreferrer">
                <p class="p-related-links__item-title">石綿(アスベスト)含有建材データベース</p>
                <p class="p-related-links__item-subtitle">/ 経済産業省及び国土交通省</p>
              </a>
              <a href="#" class="p-related-links__item" target="_blank" rel="noopener noreferrer">
                <p class="p-related-links__item-title">アスベスト非含有建材</p>
                <p class="p-related-links__item-subtitle">/ 経済産業省及び国土交通省</p>
              </a>
            </div>
          </div>

        </div>


      </div>
    </div>
  </section>


  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>