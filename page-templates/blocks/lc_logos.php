<?php
$classes = $block['className'] ?? 'py-5';
?>
<section class="logos <?=$classes?>">
    <div class="container-xl">
        <h2 class="h4">In association with</h2>
        <div class="logos__slider">
            <?php
        while (have_rows('logos')) {
            the_row();
            $link = get_sub_field('link') ?: '#';
            ?>
            <div class="logos__card">
                <img src="<?=wp_get_attachment_image_url(get_sub_field('logo'), 'large')?>"
                    alt="<?=get_sub_field('name')?>">
            </div>
            <?php
        }
?>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script>
    (function($) {
        $('.logos__slider').slick({
            infinite: true,
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    })(jQuery);
</script>
<?php
}, 9999);
?>