<section class="three_images">
    <div class="container-xl">
        <div class="three_images__grid">
            <?php
            while(have_rows('images')) {
                the_row();
                ?>
            <img class="three_images__image"
                src="<?=wp_get_attachment_image_url(get_sub_field('image'), 'large')?>">
            <?php
            }
            ?>
        </div>
    </div>
</section>