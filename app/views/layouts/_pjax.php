<script src="/assets/pjax/jquery.pjax.js"></script>

<?php if (!@$_SERVER['HTTP_X_PJAX']) : ?>

  <script>
    $('html').pjax('a[data-pjax]', 'body', {fragment: 'body', type: 'post', scrollTo: 0, timeout: 2000,});

    $('html')
      .on('submit', 'form[data-pjax]', function(event) {
        $.pjax.submit(event, 'body', {fragment: 'body', type: 'post', scrollTo: 0, timeout: 2000,});
      })

    $('html').on('pjax:error', function(event, xhr, textStatus, errorThrown, options) {
        options.success(xhr.responseText, textStatus, xhr);
        return false;
    });

    $('body').on('pjax:success', function(){
        NProgress.done();
        if (document.querySelector('#captcha_widget') != null) {
            var site_key = document.querySelector('#captcha_widget').getAttribute('data-sitekey');
            grecaptcha.render('captcha_widget', {
              sitekey: site_key
            });
          }

    })

  </script>

<?php endif; ?>