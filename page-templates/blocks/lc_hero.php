<?php
$bg = wp_get_attachment_image_url(get_field('background'), 'full');
$classes = $block['className'] ?? 'pb-5';
?>
<section class="hero <?=$classes?>"
    style="background-image: url(<?=$bg?>)">
    <div class="hero__inner px-4">
        <h1 class="h1 my-auto d-inline">
            <?=get_field('title')?>
        </h1>
    </div>
</section>