<?php
$classes = $block['classList'] ?? 'py-5';
?>
<div class="container-xl <?=$classes?>">
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php
while (have_rows('fight_card')) {
    the_row();
    $f1 = get_sub_field('fighter_1')[0];
    $f2 = get_sub_field('fighter_2')[0];

    $f1_img = get_the_post_thumbnail_url($f1, 'medium') ?: '/wp-content/themes/lc-sfxevent2024/img/missing.png';
    $f2_img = get_the_post_thumbnail_url($f2, 'medium') ?: '/wp-content/themes/lc-sfxevent2024/img/missing.png';
    ?>
                <li class="glide__slide fight_card">
                    <div class="fight_card__card">
                        <div class="overlay"></div>
                        <a class="card__image"
                            href="<?=get_the_permalink($f1)?>">
                            <img src="<?=$f1_img?>"
                                alt="<?=get_the_title($f1)?>">
                        </a>
                        <div class="card__gap"></div>
                        <a class="card__image"
                            href="<?=get_the_permalink($f2)?>">
                            <img src="<?=$f2_img?>"
                                alt="<?=get_the_title($f2)?>">
                        </a>
                        <a class="card__name"
                            href="<?=get_the_permalink($f1)?>">
                            <?=get_the_title($f1)?>
                        </a>
                        <div class="card__gap">VS</div>
                        <a class="card__name"
                            href="<?=get_the_permalink($f2)?>">
                            <?=get_the_title($f2)?>
                        </a>
                        <?php
if (get_sub_field('fight_title') != '') {
    ?>
                        <div class="card__title grid-span-3">
                            <?=get_sub_field('fight_title')?>
                        </div>
                        <?php
}
    ?>
                        <div class="card__stat">
                            <img class="flag-img"
                                src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc', $f1))?>.svg"
                                alt="" height="15px" width="20px">
                            <?php
                                if (get_field('location', $f1) ?? null) {
                                    echo get_field('location', $f1) . ', ';
                                }
    ?>
                            <?=get_field('country', $f1)?>
                        </div>
                        <div class="card__gap">Country</div>
                        <div class="card__stat">
                            <img class="flag-img"
                                src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc', $f2))?>.svg"
                                alt="" height="15px" width="20px">
                            <?php
                                if (get_field('location', $f2) ?? null) {
                                    echo get_field('location', $f2) . ', ';
                                }
    ?>
                            <?=get_field('country', $f2)?>
                        </div>
                        <div class="card__stat">
                            <?=get_field('age', $f1)?>
                        </div>
                        <div class="card__gap">Age</div>
                        <div class="card__stat">
                            <?=get_field('age', $f2)?>
                        </div>

                        <div class="card__stat">
                            <?=get_field('weight_class', $f1)->description?>
                        </div>
                        <div class="card__gap">Weight</div>
                        <div class="card__stat">
                            <?=get_field('weight_class', $f2)->description?>
                        </div>

                        <div class="card__stat">
                            <?=get_field('combat_style', $f1)?>
                        </div>
                        <div class="card__gap">Style</div>
                        <div class="card__stat">
                            <?=get_field('combat_style', $f2)?>
                        </div>

                    </div>
                </li>
                <?php
}
?>
            </ul>
        </div>
    </div>
</div>
<div class="container-xl fight_card_row">
    <?php

while (have_rows('fight_card')) {
    the_row();
    $f1 = get_sub_field('fighter_1')[0];
    $f2 = get_sub_field('fighter_2')[0];
        
    ?>
    <div class="row justify-content-center mx-0 mb-4">
        <div class="col-12 text-center fw-bold mb-2 h2">
            <?=get_sub_field('fight_title')?>
        </div>
        <div class="col-md-5 h3 bg-red p-2">
            <a class="h-100 d-flex justify-content-center justify-content-md-end align-items-center gap-2"
                href="<?=get_the_permalink($f1)?>">
                <img class="flag-img"
                    src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc', $f1))?>.svg"
                    alt="" height="30px" width="40px">
                <div><?=get_the_title($f1)?></div>
            </a>
        </div>
        <div class="col-md-1 text-center d-flex justify-content-center align-items-center h4">vs</div>
        <div class="col-md-5 h3 bg-blue p-2">
            <a class="h-100 d-flex justify-content-center justify-content-md-start align-items-center gap-2"
                href="<?=get_the_permalink($f2)?>">
                <img class="flag-img order-md-2"
                    src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc', $f2))?>.svg"
                    alt="" height="30px" width="40px">
                <div><?=get_the_title($f2)?></div>
            </a>
        </div>
    </div>
    <hr>
    <?php
}
?>
</div>
<?php
add_action('wp_footer', function () {
    ?>
<link rel="stylesheet" href="https://unpkg.com/@glidejs/glide@3.2.3/dist/css/glide.core.min.css">
<script src="https://unpkg.com/@glidejs/glide"></script>
<script>
    var glide = new Glide('.glide', {
        type: 'carousel',
        perView: 1.5,
        focusAt: 'center',
        autoplay: 3000,
        breakpoints: {
            1024: {
                perView: 1
            }
        }
    }).mount()
</script>
<?php
}, 9999);
?>