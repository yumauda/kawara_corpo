<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--download js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Technical">
          <h2 class="p-page-mv__title">屋根面の風圧力計算</h2>
          <p class="p-page-mv__text">For Professional</p>
        </div>
      </div>
    </div>
  </section>
  <section class="p-munsell js-blur-content">
    <div class="l-inner">
      <div class="p-munsell__content">
        <div class="p-munsell__title-wrapper">
          <p class="p-munsell__title-en">Wpc</p>
          <h3 class="p-munsell__title-ja">屋根面の風圧力計算</h3>
        </div>
        <p class="p-munsell__ver">Ver.25.9.30.2</p>
        <div class="p-munsell__calc">
          <div class="p-wpc">
            <form class="p-wpc__form" action="#" method="post">
              <!-- 基準風速 -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">
                  基準風速
                  <span class="p-wpc__required">必須</span>
                </div>
                <div class="p-wpc__td">
                  <span class="p-wpc__select">
                    <select class="p-wpc__control" name="prefecture" aria-label="都道府県">
                      <option value="" selected disabled>都道府県</option>
                      <option value="shimane">島根県</option>
                      <option value="tottori">鳥取県</option>
                      <option value="hiroshima">広島県</option>
                      <option value="yamaguchi">山口県</option>
                    </select>
                  </span>
                  <span class="p-wpc__select ml10">
                    <select class="p-wpc__control w194" name="area" aria-label="エリア">
                      <option value="" selected disabled>エリア</option>
                      <option value="a">エリアA</option>
                      <option value="b">エリアB</option>
                    </select>
                  </span>
                  <input class="p-wpc__control ml10 w194 mt12-sp" type="text" inputmode="decimal" name="v0" aria-label="基準風速" placeholder="" style="max-width: 12rem;">
                  <span class="p-wpc__unit ml10">m/s</span>
                </div>
              </div>

              <!-- 粗度地区分 -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">
                  粗度地区分
                  <span class="p-wpc__required">必須</span>
                </div>
                <div class="p-wpc__td">
                  <div class="p-wpc__td-row">
                    <span class="p-wpc__select">
                      <select class="p-wpc__control w298" name="roughness" aria-label="粗度地区分">
                        <option value="" selected disabled>選択してください</option>
                        <option value="i">Ⅰ</option>
                        <option value="ii">Ⅱ</option>
                        <option value="iii">Ⅲ</option>
                        <option value="iv">Ⅳ</option>
                      </select>
                    </span>
                    <div class="p-wpc__helpWrap">
                      <button class="p-wpc__help js-wpc-help" type="button" aria-expanded="false" aria-controls="wpcHelpRoughness">
                        説明
                        <span class="p-wpc__helpIcon" aria-hidden="true"></span>
                      </button>

                    </div>
                  </div>

                  <div class="p-wpc__helpPanel js-wpc-help-panel" id="wpcHelpRoughness" hidden>
                    <div class="p-wpc__noteBox">
                      <div class="p-wpc__roughList">
                        <div class="p-wpc__roughItem">
                          <div class="p-wpc__roughBadge">Ⅰ</div>
                          <p class="p-wpc__roughText">極めて平坦で障害物がない<br>ものとして特定行政庁が規則で定める区域</p>
                        </div>

                        <div class="p-wpc__roughItem">
                          <div class="p-wpc__roughBadge p-wpc__roughBadge--ii">Ⅱ</div>
                          <p class="p-wpc__roughText">極めて平坦で障害物が散在している<br>ものとして特定行政庁が規則で定める区域</p>
                        </div>

                        <figure class="p-wpc__graph">
                          <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/wpc/wpc_graph.png" alt="粗度地区分のグラフ" width="850" height="434">
                        </figure>

                        <div class="p-wpc__roughItem">
                          <div class="p-wpc__roughBadge p-wpc__roughBadge--iv">Ⅳ</div>
                          <p class="p-wpc__roughText">極めて都市化が著しい<br>ものとして特定行政庁が規則で定める区域</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 平均高さ -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">
                  平均高さ
                  <span class="p-wpc__required">必須</span>
                </div>
                <div class="p-wpc__td">
                  <div class="p-wpc__td-row">
                    <div class="p-wpc__td-unit-row">
                      <span class="p-wpc__unit">（</span>
                      <input class="p-wpc__control" type="text" inputmode="decimal" name="eaves_h" aria-label="軒の高さ" style="max-width: 8rem;">
                      <span class="p-wpc__unit">m</span>
                      <span class="p-wpc__unit">＋</span>
                      <input class="p-wpc__control mt4-sp" type="text" inputmode="decimal" name="building_h" aria-label="建物の高さ" style="max-width: 8rem;">
                      <span class="p-wpc__unit">m</span>
                      <span class="p-wpc__unit">）÷2＝</span>
                      <input class="p-wpc__control mt4-sp" type="text" inputmode="decimal" name="avg_h" aria-label="平均高さ" style="max-width: 8rem;">
                      <span class="p-wpc__unit">m</span>
                    </div>

                    <div class="p-wpc__helpWrap">
                      <button class="p-wpc__help js-wpc-help" type="button" aria-expanded="false" aria-controls="wpcHelpAvgHeight">
                        説明
                        <span class="p-wpc__helpIcon" aria-hidden="true"></span>
                      </button>

                    </div>
                  </div>
                  <div class="p-wpc__helpPanel js-wpc-help-panel" id="wpcHelpAvgHeight" hidden>
                    <div class="p-wpc__gray">
                      <figure class="p-wpc__graph">
                        <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/wpc/wpc_graph2.png" alt="平均高さ ＝ （ 軒の高さ ＋ 建物の高さ ） ÷ ２" width="950" height="588">
                      </figure>
                      <p class="p-wpc__graph-title">平均高さ ＝ （ 軒の高さ ＋ 建物の高さ ） ÷ ２</p>
                      <p class="p-wpc__graph-text">※軒の高さ　 ： 小屋組み等を支持する壁、軒げた、又は柱等の上端の高さ。<br>
                      ※建物の高さ ： 建築物の頂部高さ(棟飾り等の屋上突出物は含めない)。</p>

                    </div>
                  </div>

                </div>
              </div>

              <!-- 屋根勾配 -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">
                  屋根勾配
                  <span class="p-wpc__required">必須</span>
                </div>
                <div class="p-wpc__td">
                  <input class="p-wpc__control w194" type="text" inputmode="decimal" name="slope" aria-label="屋根勾配" style="max-width: 10rem;">
                  <span class="p-wpc__unit ml10">寸</span>
                </div>
              </div>

              <!-- 屋根形状 -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">屋根形状</div>
                <div class="p-wpc__td">
                  <span class="p-wpc__select">
                    <select class="p-wpc__control w298" name="roof_shape" aria-label="屋根形状">
                      <option value="" selected disabled>選択してください</option>
                      <option value="gable">切妻</option>
                      <option value="hip">寄棟</option>
                      <option value="flat">陸屋根</option>
                    </select>
                  </span>
                </div>
              </div>

              <!-- 物件名等 -->
              <div class="p-wpc__row">
                <div class="p-wpc__th">物件名等</div>
                <div class="p-wpc__td">
                  <input class="p-wpc__control w500" type="text" name="project_name" aria-label="物件名等">
                </div>
              </div>

              <div class="p-wpc__actions">
                <button type="button" class="p-wpc__submit">
                  <p class="p-wpc__submit-text">計算</p>
                  <span class="p-wpc__submitIcon" aria-hidden="true">
                    <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/wpc/icon.png" alt="">
                  </span>
                </button>
                <a class="p-wpc__link" href="#">当社商品の耐風圧力試験結果はこちら</a>
              </div>
            </form>
          </div>
        </div>
        <div class="p-munsell__note">
          <p class="p-munsell__note-text p-munsell__note-text--red">※ 建設省告示第1458号に基づいた計算方法により、屋根ふき材の構造計算を参考値として求めます。<br>
            ※ 部位別風圧力(W)については、小数第1位を切り下げます。<br>
            ※ 独立上屋は、考慮しておりません。<br>
            ※ 基準風速について平成12年建設省告示1454号(H12.5.31)以降の市町村合併には対応していません。<br>
            ※ ご使用の環境によっては正常に作動しないことがあります。<br>
            ※ 内容等につき予告なく変更する場合がありますのでご注意下さい。</p>
          <p class="p-munsell__note-text p-munsell__note-text--red border20">(免責) 当画面のご利用について生じた如何なる損害についても当方は責任を負わないものとします。</p>
        </div>
      </div>
      <div class="p-performance-related__submit-wrapper mt100">
        <a href="#" class="p-performance-related__submit">
          <figure class="p-performance-related__submit-img">
            <img decoding="async" loading="lazy" src="<?php echo get_template_directory_uri() ?>/images/performance/submit.png" alt="風圧力計算シート エクセル版" width="140" height="205">
          </figure>
          <div class="p-performance-related__submit-text-wrapper">
            <p class="p-performance-related__submit-text">風圧力計算シート エクセル版</p>
            <p class="p-performance-related__submit-link">この風圧力計算シートは建築基準法、平成12年建設省告示1458号に基づいた風圧力の計算が簡単に出来るものです。</p>

          </div>
          <div class="p-performance-related__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 130">
              <g id="グループ_23411" data-name="グループ 23411" transform="translate(0.486)">
                <rect id="長方形_1137" data-name="長方形 1137" width="130" height="130" rx="65" transform="translate(-0.486)" fill="#37af32" />
                <g id="グループ_23372" data-name="グループ 23372" transform="translate(51.791 57.41)">
                  <path id="パス_42625" data-name="パス 42625" d="M189.089-2035.115l8.666,7.583-8.666,7.582" transform="translate(-171.757 2035.115)" fill="none" stroke="#fff" stroke-width="3" />
                  <path id="パス_42624" data-name="パス 42624" d="M189.089-2035.115l8.666,7.583-8.666,7.582" transform="translate(-180.423 2035.115)" fill="none" stroke="#fff" stroke-width="3" />
                  <path id="パス_42623" data-name="パス 42623" d="M189.089-2035.115l8.666,7.583-8.666,7.582" transform="translate(-189.089 2035.115)" fill="none" stroke="#fff" stroke-width="3" />
                </g>
              </g>
            </svg>

          </div>
        </a>
      </div>
    </div>
  </section>



  <?php get_template_part("includes/submit"); ?>

</main>

<?php get_footer() ?>