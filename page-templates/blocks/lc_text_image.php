<?php
$txtcol = get_field('order') == 'text' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$imgcol = get_field('order') == 'text' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$txtanim = get_field('order') == 'text' ? 'fade-right' : 'fade-left';
$imganim = get_field('order') == 'text' ? 'fade-left' : 'fade-right';

$txtanim = 'fade';
$imganim = 'fade';

$classes = $block['className'] ?? 'py-5';

?>
<section class="feature <?=$classes?>">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <div class="h2 text-center d-md-none" data-aos="fade">
            <?=get_field('title')?>
        </div>
        <?php
        }
?>
        <div class="row g-4">
            <div class="col-md-6 <?=$txtcol?> d-flex flex-column justify-content-center"
                data-aos="<?=$txtanim?>">
                <?php
        if (get_field('title') ?? null) {
            ?>
                <h2 class="d-none d-md-block h2">
                    <?=get_field('title')?>
                </h2>
                <?php
        }
?>
                <div><?=get_field('content')?>
                </div>
                <?php
if (get_field('link') ?? null) {
    $l = get_field('link');

    $tickets_available = get_field('tickets_available', 'options');

    if (preg_match('/tickets/i', $l['title'])) {

        if (isset(get_field('tickets_on_sale', 'options')[0]) && get_field('tickets_on_sale', 'options')[0] == 'Yes') {
            ?>
                <a href="<?=get_field('tickets_url', 'options')?>"
                    target="_blank" class="mt-4 btn btn-red text-center align-self-center align-self-md-start">Buy
                    Tickets</a>
                <?php
        } elseif (isset(get_field('tickets_available', 'options')[0]) && get_field('tickets_available', 'options')[0] == 'Yes') {
            ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="mt-4 btn btn-red text-center align-self-center align-self-md-start"><?=$l['title']?></a>
                <?php
        } else {
            ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="mt-4 btn btn-red text-center align-self-center align-self-md-start">Find out more</a>
                <?php
        }
    } elseif (preg_match('/register/i', $l['title'])) {
        if (isset(get_field('registration_open', 'options')[0]) && get_field('registration_open', 'options')[0] == 'Yes') {
            ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="mt-4 btn btn-red text-center align-self-center align-self-md-start"><?=$l['title']?></a>
                <?php
        }
    } else { // normal button
        ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="mt-4 btn btn-red text-center align-self-center align-self-md-start">XX<?=$l['title']?></a>
                <?php
    }

}
?>
            </div>
            <div class="col-md-6 <?=$imgcol?> d-flex align-items-center"
                data-aos="<?=$imganim?>">
                <img src="<?=wp_get_attachment_image_url(get_field('image'), 'large')?>"
                    alt="<?=get_field('title')?>"
                    class="feature__img mx-auto">
            </div>
        </div>
    </div>
</section>