<?php

$events = new Query('events');
$query_args = [
  'posts_per_page' => 3
];
$results = $events->query($query_args);
?>

<div class="container container--vh-top">
  <h1 class="heading--one heading--space-bottom-large heading--bold heading--primary">Upcoming Events</h1>
  <ul class="grid grid--space-bottom">

    <?php
    if($results->have_posts()): while($results->have_posts()): $results->the_post();
      $event = new CMB2Fields(get_the_ID());
    ?>

    <li class="card grid__col col-4">
      <div <?php post_class() ?> >
        <a class="card__link" href="<?php the_permalink(); ?>">

          <?php $post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>

          <div class="card__media" style="background-image: url('<?php echo $post_image[0]; ?>')"></div>
          <div class="card__info">
            <h2 class="card__title"><?php the_title(); ?></h2>
            <p class="card__details"><?php echo $event->field('event_date_text'); ?>
            <?php echo $event->field('event_address_text'); ?></p>
            <p class="card__excerpt"><?php echo $event->format_content($event->field('event_excerpt_text')); ?></p>
            <p class="card__read-more">Read More</p>
          </div>

        </a>
      </div>
    </li>

    <?php endwhile; endif; ?>

  </ul>

  <a class="btn lime__btn" href="/events">View All Events</a>

</div>
