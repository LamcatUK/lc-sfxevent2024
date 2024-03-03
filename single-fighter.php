<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/themes/lc-sfxevent2024/img/missing.png';
?>
<main id="main" class="fighter">
    <div class="container-xl pb-5">
        <div class="breadcrumbs py-2">
            <a href="/">SFX Championships</a> &raquo; <a href="/fighters/">Fighters</a> &raquo;
            <?=get_the_title()?>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="profile_card">
                    <img src="<?=$img?>"
                        alt="<?=get_the_title()?>"
                        class="profile_card__image">
                    <div class="profile_card__header">
                        <div class="profile_card__name">
                            <h1 class="fighter__title">
                                <?=get_the_title()?>
                            </h1>
                        </div>
                        <div class="profile_card__country">
                            <div class="profile_card__location">
                                <div class="country">
                                    <?=get_field('country')?>
                                </div>
                                <?php
                                if (get_field('location') ?? null) {
                                    ?>
                                <div class="city">
                                    <?=get_field('location')?>
                                </div>
                                <?php
                                }
?>
                            </div>
                            <div class="flag">
                                <img class="flag-img"
                                    src="https://flagicons.lipis.dev/flags/4x3/<?=strtolower(get_field('cc'))?>.svg"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="profile_card__stats">
                        <div class="fighter__age">
                            <div class="headline">Age</div>
                            <div>
                                <?=get_field('age')?>
                            </div>
                        </div>
                        <div class="fighter__style">
                            <div class="headline">Style</div>
                            <div>
                                <?=get_field('combat_style')?>
                            </div>
                        </div>
                        <div class="fighter__experience">
                            <div class="headline">Training</div>
                            <div>
                                <?=get_field('training')?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (get_field('achievements') ?? null) {
                    ?>
                <section class="fighter__achievements py-4">
                    <h2 class="h3">Combat Achievements</h2>
                    <?=get_field('achievements')?>
                </section>
                <?php
                }
if (get_field('footage') ?? null) {
    ?>
                <section class="fighter__footage py-4">
                    <h2 class="h3">Combat Footage</h2>
                    <div class="fighter__footage_video">
                        <?=do_shortcode('[video src="' . get_field('footage')['url'] . '" height=400]')?>
                    </div>
                </section>
                <?php
}

// related

$current_post_id = get_the_ID();

$terms = wp_get_post_terms($current_post_id, 'weight-class', array("fields" => "slugs"));

if (!empty($terms)) {
    $args = array(
        'post_type' => 'fighter',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in' => array($current_post_id),
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'weight-class',
                'field'    => 'slug',
                'terms'    => $terms,
            ),
        ),
    );
    $q = new WP_Query($args);

    if ($q->have_posts()) {
        echo '<section class="related fighters"><hr><h2 class="h3">Related Fighters</h2><div class="fighters__grid">';
        while ($q->have_posts()) {
            $q->the_post();
            $class = get_the_terms($q->ID, 'weight-class');
            $img = get_the_post_thumbnail_url($q->ID, 'large') ?: '/wp-content/themes/lc-sfxevent2024/img/missing.png';

            ?>
                <a class="fighters__card"
                    href="<?=get_the_permalink($q->ID)?>">
                    <img src="<?=$img?>"
                        alt="<?=get_the_title()?>">
                    <div class="fighters__card_inner">
                        <div class="card__name">
                            <?=get_the_title($q->ID)?>
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
                <?php
        }
        echo '</div></section>';
    }
}

?>
            </div>
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="event_hero">
                        <?php
                    $front_page_id = get_option('page_on_front');
$post_content = get_post_field('post_content', $front_page_id);
$blocks = parse_blocks($post_content);
$event_name = $event_time = $event_loca = '';
foreach ($blocks as $block) {
    if ($block['blockName'] == 'acf/lc-event-hero') {
        $event_name = $block['attrs']['data']['event_name'] ?? '';
        $event_time = $block['attrs']['data']['event_date_time'] ?? '';
        $event_loca = $block['attrs']['data']['event_location'] ?? '';
        break;
    }
}
?>
                        <div class="event_hero__name">
                            <?=$event_name?>
                        </div>
                        <div class="event_hero__date">
                            <?php
$eventDateTime = $event_time;
$date = DateTime::createFromFormat('Y-m-d H:i:s', $eventDateTime);
$formattedDate = $date->format('jS F, Y'); // Outputs: 11th May, 2024

echo $formattedDate;
?>
                        </div>
                        <div class="event_hero__location">
                            <?=$event_loca?>
                        </div>
                        <hr>
                        <div class="event_hero__countdown">
                            <?php
$years = $date->format('Y');
$months = $date->format('m');
$days = $date->format('d');
$hours = $date->format('H');
$minutes = $date->format('i');
$seconds = $date->format('s');

// Array of time until
$timeUntil = [
    'YEARS' => $years,
    'MONTHS' => $months,
    'DAYS' => $days,
    'HH' => $hours,
    'MI' => $minutes,
    'SS' => $seconds
];
echo do_shortcode("[countdown id='cnt' year='{$timeUntil['YEARS']}' month='{$timeUntil['MONTHS']}' day='{$timeUntil['DAYS']}' hour='{$timeUntil['HH']}' min='{$timeUntil['MI']}' sec='{$timeUntil['SS']}']");
?>
                        </div>
                    </div>
                    <div class="sidebar__buttons">
                        <a class="btn btn-blue" title="Event Info" href="/event/">Event Info</a>
                        <a class="btn btn-red" title="Buy Tickets" href="/event/">Buy Tickets</a>
                        <a class="btn btn-red" title="Register to Fight" href="/register/">Register to Fight</a>
                        <a class="btn btn-blue" title="SFX Merch" target="_blank"
                            href="https://sfxchampionships.epic-merch.com/">SFX Merch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>