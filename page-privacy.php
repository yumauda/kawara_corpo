<?php get_header(); ?>

<main>
  <section class="p-page-mv p-page-mv--download js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Privacy">
          <h2 class="p-page-mv__title">プライバシーポリシー</h2>
          <p class="p-page-mv__text">Privacy Policy</p>
        </div>
      </div>
    </div>
  </section>

  <section class="p-privacy js-blur-content">
    <div class="l-inner">
      <div class="p-privacy__content">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="p-privacy__body">
              <?php
              $content = trim((string) get_the_content());
              if ($content !== '') {
                the_content();
              } else {
              ?>
                <p>
                  株式会社瓦百景（以下「当社」）は、当社が提供するサービスにおいて取得する個人情報の重要性を認識し、
                  個人情報保護に関する法令および関連するガイドラインを遵守のうえ、適切に取り扱います。
                </p>

                <h3>1. 取得する情報</h3>
                <p>当社は、以下の情報を取得する場合があります。</p>
                <ul>
                  <li>氏名、会社名、部署名</li>
                  <li>メールアドレス、電話番号、住所</li>
                  <li>お問い合わせ内容、資料請求内容</li>
                  <li>アクセスログ、Cookie等の識別子、端末情報、ブラウザ情報</li>
                </ul>

                <h3>2. 利用目的</h3>
                <p>取得した個人情報は、以下の目的で利用します。</p>
                <ul>
                  <li>お問い合わせへの回答、資料の送付、必要な連絡</li>
                  <li>サービスの提供・維持・改善</li>
                  <li>不正利用の防止、セキュリティ確保</li>
                  <li>当社の製品・サービスに関するご案内（同意がある場合）</li>
                  <li>各種統計データの作成（個人を特定しない形での利用）</li>
                </ul>

                <h3>3. 第三者提供</h3>
                <p>
                  当社は、法令に基づく場合を除き、ご本人の同意なく個人情報を第三者に提供しません。
                </p>

                <h3>4. 委託</h3>
                <p>
                  当社は、利用目的の達成に必要な範囲で、個人情報の取扱いを外部事業者に委託する場合があります。
                  その場合、委託先に対し適切な監督を行います。
                </p>

                <h3>5. 安全管理措置</h3>
                <p>
                  当社は、個人情報の漏えい・滅失・毀損の防止その他の安全管理のため、必要かつ適切な措置を講じます。
                </p>

                <h3>6. 開示・訂正・削除等の請求</h3>
                <p>
                  ご本人から、個人情報の開示、訂正、追加、削除、利用停止等の請求があった場合、
                  法令に従い、適切に対応します。
                </p>

                <h3>7. Cookie等の利用</h3>
                <p>
                  当社サイトでは、利便性向上やアクセス解析等のためにCookie等を利用する場合があります。
                  ブラウザ設定によりCookieを無効化できますが、一部機能が利用できない場合があります。
                </p>

                <h3>8. お問い合わせ窓口</h3>
                <p>
                  個人情報の取扱いに関するお問い合わせは、<a href="<?php echo esc_url(home_url('/recruit/contact')); ?>">お問い合わせ</a>よりご連絡ください。
                </p>

                <h3>9. 改定</h3>
                <p>
                  当社は、本ポリシーの内容を必要に応じて改定することがあります。改定後の内容は当社サイトに掲載した時点で効力を生じます。
                </p>

                <p class="p-privacy__date">制定日：2026年1月</p>
              <?php } ?>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php get_template_part("includes/submit"); ?>
</main>

<?php get_footer(); ?>

