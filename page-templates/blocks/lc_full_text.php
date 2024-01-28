<section class="full_text">
    <div class="container-xl py-5" data-aos="fade">
        <?php
        if (get_field('pre_title') ?? null) {
            ?>
        <div class="pretitle">
            <?=get_field('pre_title')?>
        </div>
        <?php
        }
        ?>
        <div class="max-ch">
            <?=apply_filters('the_content', get_field('content'))?>
        </div>
    </div>
</section>