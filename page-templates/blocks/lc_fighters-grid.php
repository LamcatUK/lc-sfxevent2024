<section class="fighters mb-2">
    <div class="container-xl bg-white py-4">
        <div class="d-none d-lg-flex fighters__filters filters-button-group mb-4">
            <button class="filter-button is-checked" data-filter="*">All Classes</button>
            <?php
            $classes = get_terms('weight-class');
            if (!empty($classes) && !is_wp_error($classes)) {
                foreach ($classes as $class) {
                    ?>
            <button class="filter-button"
                data-filter=".<?=$class->slug?>"><?=$class->description?></button>
            <?php
                }
            }
            ?>
        </div>
        <select name="filters" id="classFilter" class="form-select d-lg-none mb-4">
            <option value="*">All Classes</option>
            <?php
            if (!empty($classes) && !is_wp_error($classes)) {
                foreach ($classes as $class) {
                    ?>
            <option value=".<?=$class->slug?>">
                <?=$class->name?>
            </option>
            <?php
                }
            }
            ?>
        </select>

        <div class="fighters__grid">
            <?php

$q = new WP_Query(array(
    'post_type' => 'fighter',
    'posts_per_page' => -1
));

            while ($q->have_posts()) {
                $q->the_post();
                $class = get_the_terms($q->ID, 'weight-class');
                ?>
            <div
                class="item grid-sizer col-md-6 col-lg-4 p-2 <?=$class[0]->slug?>">
                <a class="fighters__card"
                    href="<?=get_the_permalink()?>">
                    <img src="<?=get_the_post_thumbnail_url($q->ID, 'large')?>"
                        alt="<?=get_the_title()?>">
                    <div class="fighters__card_inner">
                        <div class="card__name">
                            <?=get_the_title()?>
                        </div>
                        <?php
                        $local = get_field('location', get_the_ID()) ?? null;
                $country = get_field('country', get_the_ID()) ?? null;
                ?>
                        <div class="card__location">
                            <div>
                                <?php
                                if ($local) {
                                    echo $local . ', ';
                                }
                ?>
                                <?=$country?>
                            </div>
                            <div>
                                <?php
                if (get_field('cc', get_the_ID()) ?? null) {
                    ?>
                                <img class="flag-img"
                                    src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc', get_the_ID()))?>.svg"
                                    alt="">
                                <?php
                }
                ?>
                            </div>
                        </div>
                        <div class="card__weight">
                            <?=trim(preg_replace('/\s*\([^)]*\)/', '', get_field('weight_class', get_the_ID())->name))?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }

            ?>
        </div>
</section>
<?php
add_action('wp_footer', function () {
    ?>
<script src="//npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script>
    // init Isotope
    var iso = new Isotope('.fighters__grid', {
        itemSelector: '.item',
        layoutMode: 'fitRows'
    });

    // bind filter button click
    var filtersElem = document.querySelector('.filters-button-group');
    filtersElem.addEventListener('click', function(event) {
        if (!matchesSelector(event.target, 'button')) {
            return;
        }
        var filterValue = event.target.getAttribute('data-filter');
        iso.arrange({
            filter: filterValue
        });
        filtersElem.querySelector('.is-checked').classList.remove('is-checked');
        event.target.classList.add('is-checked');
    });

    var filtersSelect = document.getElementById('classFilter');
    filtersSelect.addEventListener('change', function() {
        var filterValue = this.value;
        iso.arrange({
            filter: filterValue
        });
    });
</script>
<?php
});
            ?>