<?php get_header(); ?>
<main>
  <section class="p-page-mv p-page-mv--contact js-blur-content">
    <div class="l-inner">
      <div class="p-page-mv__content">
        <div class="p-page-mv__detail" data-title="Contact">
          <h2 class="p-page-mv__title">お問い合わせ</h2>
          <p class="p-page-mv__text">Contact</p>
        </div>
        
      </div>
    </div>
    
  </section>
  <section class="p-contact">
    <div class="l-inner">
      <div class="p-contact__content">

        

        <div class="p-contact__privacy-box">
          <div class="p-contact__privacy-box-inner">
            <div class="p-contact__privacy-box-left">
              <p class="p-contact__privacy-box-text">
                個人情報等のお取り扱いにご同意の上、入力フォームへ記載いただきますようお願い申し上げます。<br>
                ※お客様情報の取り扱いについては、<a class="p-contact__privacy-link" href="<?php echo esc_url(home_url('/privacy')); ?>">個人情報等のお取り扱い</a>をご参照ください。
              </p>
            </div>

            
          </div>
        </div>

        <?php the_content(); ?>
      </div>
    </div>
  </section>


  <?php get_template_part('includes/submit'); ?>
</main>
<?php get_footer() ?>