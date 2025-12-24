<?php get_header(); ?>
<main>
  <section class="p-page-mv">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="About">
          <h2 class="p-page-mv__title">石州瓦とは</h2>
          <p class="p-page-mv__text">What Defines Sekishu Tiles</p>
        </div>
        <figure class="p-page-mv__img">
          <img src="<?php echo get_template_directory_uri() ?>/images/common/mv_about.webp" alt="石州瓦とは" width="1400" height="540">
        </figure>
        <div class="p-page-mv__bottom">
          <p class="p-page-mv__bottom-kind">超高温焼成</p>
          <h3 class="p-page-mv__bottom-title">圧倒的な耐久性が<br>住まいの未来を守る</h3>
        </div>
        <div class="p-page-mv__explain">
          <p class="p-page-mv__explain-title">1200℃超の超高温焼成</p>
          <p class="p-page-mv__explain-text">石州瓦は、1200℃以上の超高温で焼き締めることで、他の瓦にはない圧倒的な強さと耐久性を実現しています。<br>この“焼き”こそが、割れにくさ・劣化しにくさ長寿命のすべてを支える源です。<br>
        </div>

      </div>
    </div>
  </section>
  <section class="p-secret">
    <div class="l-inner">
      <div class="p-secret__content">
        <h2 class="p-secret__title"><span>石州瓦の強さの秘密</span>:長石溶融による緻密化</h2>
        <p class="p-secret__text">陶器瓦素地の拡大写真比較<span>焼成後：長石の様子 ①長石粒 ②ムライト</span></p>
        <ul class="p-secret__lists">
          <li class="p-secret__list">
            <figure class="p-secret__list-img">
              <img src="<?php echo get_template_directory_uri() ?>/images/about/secret_1.webp" alt="石州瓦の強さの秘密" width="380" height="330">
            </figure>
          </li>
          <li class="p-secret__list">
            <figure class="p-secret__list-img">
              <img src="<?php echo get_template_directory_uri() ?>/images/about/secret_2.webp" alt="他産地Aの拡大写真" width="380" height="330">
            </figure>
          </li>
          <li class="p-secret__list">
            <figure class="p-secret__list-img">
              <img src="<?php echo get_template_directory_uri() ?>/images/about/secret_3.webp" alt="他産地Bの拡大写真" width="380" height="330">
            </figure>
          </li>
          <li class="p-secret__list">
            <p class="p-secret__list-text">石州瓦では長石中に気泡と思われる半球状のくぼみが多数観察された。長石の融点以上の1200℃近傍で焼成することにより<span>長石が溶融</span>し、周辺のムライトと良好な接合をし<span>空隙の少ない緻密な組織</span>となている。</p>
            <p class="p-secret__small">〜島根県産業技術センター論文より</p>
          </li>
          
        </ul>
      </div>
    </div>
  </section>
  <section class="p-land">
    <div class="l-inner">
      <div class="p-land__content">
        <div class="p-land__detail">
          <p class="p-land__kind">島根県産の原料</p>
          <h2 class="p-land__title">土が違う<br>だから<br>瓦も違う</h2>
          <p class="p-land__subtitle">超高温焼成に耐える<br>島根県産の原料</p>
          <p class="p-land__text">どんなに優れた技術が優れていても、土の質が劣れば、耐久性も、美しさも、長持ちしません。<br>瓦の"土台"をつくるのは、まさにそのもののみのかなめです。</p>
        </div>
        <figure class="p-land__img">
          <img src="<?php echo get_template_directory_uri() ?>/images/about/land_1.webp" alt="島根県産の原料" width="900" height="980">
        </figure>
      </div>
    </div>
  </section>

  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>