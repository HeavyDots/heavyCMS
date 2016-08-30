<?php
use yii\helpers\Html;

$this->title = $post->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $post->meta_description
]);

?>
<article class="blog-post-item">
  <h1 class="title"><?= $post->title ?></h1>
  <p class="text-muted"><?= Yii::t('blog', 'Posted on {0,date,short}',$post->created_at)?></p>
  <?php if ($post->featured_image): ?>
    <p class="featured-image">
      <?= Html::img($post->getFullUrlFeaturedImage(), ['alt' => $post->title, 'class' => 'img-responsive'])?>
    </p>
  <?php endif; ?>
  <div class="body">
    <?= $post->text ?>
  </div>
  
  <div class="comments">
    <?php if (isset(Yii::$app->params['disqus_shortname']) && Yii::$app->params['disqus_shortname']): ?>

      <div id="disqus_thread"></div>
      <script>
      /**
       *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
       *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */

      var disqus_config = function () {
          this.page.url = '<?php echo $post->getFullUrl() ?>';  // Replace PAGE_URL with your page's canonical URL variable
          this.page.identifier = 'post-<?php echo $post->id ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
      };

      (function() { // DON'T EDIT BELOW THIS LINE
          var d = document, s = d.createElement('script');
          s.src = '//<?php echo Yii::$app->params['disqus_shortname']; ?>.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);
      })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    <?php endif; ?>
  </div>
  
</article>