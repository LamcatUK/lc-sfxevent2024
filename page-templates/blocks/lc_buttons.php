<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="buttons <?=$classes?>">
    <div class="container-xl d-flex justify-content-around gap-4 flex-wrap" data-aos="fade">
        <?php
    while(have_rows('buttons')) {
        the_row();
        $l = get_sub_field('link');

        if (preg_match('/register/i', $l['title'])) {
            if (isset(get_field('registration_open', 'options')[0]) && get_field('registration_open', 'options')[0] == 'Yes') {
                ?>
        <a href="<?=$l['url']?>"
            class="btn btn-red"
            target="<?=$l['target']?>"><?=$l['title']?></a>
        <?php
            }
            continue;
        }
        if (preg_match('/tickets/i', $l['title'])) {
            if (isset(get_field('tickets_on_sale', 'options')[0]) && get_field('tickets_on_sale', 'options')[0] == 'Yes') {
                ?>
        <a href="<?=get_field('tickets_url', 'options')?>"
            class="btn btn-red"
            target="_blank"><?=$l['title']?></a>
        <?php
            } elseif (isset(get_field('tickets_available', 'options')[0]) && get_field('tickets_available', 'options')[0] == 'Yes') {
                ?>
        <a href="<?=$l['url']?>"
            class="btn btn-red"
            target="<?=$l['target']?>"><?=$l['title']?></a>
        <?php
            }
            continue;
        }
        
        ?>
        <a href="<?=$l['url']?>"
            class="btn btn-red"
            target="<?=$l['target']?>"><?=$l['title']?></a>
        <?php
    }
?>
    </div>
</section>