<?php if (comments_open()) { ?>
<div class="row">
  <div class="col-sm-12">
    <div class="form-horizontal">

<?php
      $fields = array(
              'author' => '<div class="col-md-6">
                      <div class="form-group">
                        <label for="user_name" class="col-sm-4 control-label">Имя:*</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="user_name" placeholder="Обязательное поле" required="required" name="author">
                        </div>
                      </div>',

              'email' => '<div class="form-group">
                            <label for="user_mail" class="col-sm-4 control-label">Email:*</label>
                            <div class="col-sm-8">
                            <input type="email" class="form-control" id="user_mail" placeholder="Обязательное поле" required="required" name="email">
                            </div>
                          </div>',
//              'url' => '<div class="form-group">
//                            <label for="user_url" class="col-sm-4 control-label">VK:</label>
//                            <div class="col-sm-8">
//                            <input type="text" class="form-control" id="user_vk" placeholder="VK" name="url">
//                            </div>
//                        </div>'
      );

      $args = array(
        'comment_notes_after' => '',
        'comment_field' => '<div class="col-md-6">
                              <div class="form-group">
                                <label for="user_mail" class="col-sm-4 control-label">Комментарий:</label>
                                <div class="col-sm-8">
                                <textarea id="comments" class="form-control" rows="8" placeholder="" name="comment"></textarea>
                                </div>
                              </div>
                              </div>',

        'submit_button' => '<button type="submit" class="button">Отправить</button>',
        'submit_field' => '<div class="form-group"><div class="col-sm-12">%1$s %2$s</div></div></div>',

        'label_submit' => '',
        'fields' => apply_filters('comment_form_default_fields', $fields)
      );
      comment_form($args);
    ?>

    </div>
  </div>
  </div>


    <div class="comments_holder">
  <span class="comments-caption text-right">Всего отзывов: <?php comments_number('%', '%', '%'); ?></span>
    <?php if (get_comments_number() == 0) { ?>
      <ul class="list">
        <li>Еще нет ни одного отзыва. Будь первым!</li>
      </ul>
    <?php } else { ?>

    <ul class="commentlist">
      <?php
        function verstaka_comment($comment, $args, $depth){
          $GLOBALS['comment'] = $comment; ?>
          <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
              <div class="comment-author vcard">
                <div class="comment-meta commentmetadata" >
                    <?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?><span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></span>
                </div>
              </div>
              <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <br>
              <?php endif; ?>
              <?php comment_text();


              $stars = get_comment_meta($comment->comment_ID, 'stars', true);
              if($stars > 0) {
                  echo '
              <div class="stars">
              <div class="row">';
                  $arr = array();
              for( $c = 0; $c < $stars; $c++ ){
                  $arr[$c] = $c;
              };

                  for( $a = 0; $a < 5; $a++ ){
                      if($a == $arr[$a]){
                          echo '
                          <div class="col-md-1"><i class="fa fa-star" aria-hidden="true"></i></i></div>
                          ';
                      }
                  };
 echo '</div></div>';
              }

              if($stars > 0) {
                  $ratingHTML = '
<span class="rating-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">(' . $stars . ', в среднем: <strong>' . ($stars) . '</strong> из 5)</span>

<div class="rating-info" id="rating-info"></div>';

                  $richSnp = '<div typeof="v:Rating">
<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Book">
<div style="display: none;" itemprop="aggregateRating" itemscope="Рейтинг отзыва" itemtype="http://schema.org/AggregateRating">
<meta itemprop="bestRating" content="5">
<meta property="v:rating" content="' . ($stars) . '" />
<meta itemprop="ratingValue" content="' . ($stars) . '">
<meta itemprop="ratingCount" property="v:votes" content="' . $stars . '">
</div>
</div>
</div>';
                  echo '<div class="vote-block hidden" data-total="' . $stars . '" data-rating="' . $stars . '" rel="v:rating">' . $richSnp . $ratingHTML . '</div>';
              }
  ?>
            </div>
      <?php }
        $args = array(
          'reply_text' => 'Ответить',
          'callback' => 'verstaka_comment'
        );
        wp_list_comments($args);
      ?>
      <?php if(function_exists('wp_comments_corenavi')) wp_comments_corenavi(); ?>
    </ul>
    </div>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
</script>

  </div>
  <?php } ?>


  <?php } else { ?>
  <h3>Обсуждения закрыты для данной страницы</h3>
  <?php }
?>