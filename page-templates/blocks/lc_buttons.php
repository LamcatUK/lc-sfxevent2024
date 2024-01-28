<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="buttons <?=$classes?>">
    <div class="container-xl d-flex justify-content-around gap-4 flex-wrap" data-aos="fade">
        <?php
    while(have_rows('buttons')) {
        the_row();
        $l = get_sub_field('link');
        ?>
        <a href="<?=$l['url']?>"
            class="btn btn-red"
            target="<?=$l['target']?>"><?=$l['title']?></a>
        <?php
    }
?>
    </div>
</section>