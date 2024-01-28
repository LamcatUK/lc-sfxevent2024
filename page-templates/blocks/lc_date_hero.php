<?php
$bg = wp_get_attachment_image_url(get_field('hero_image'), 'full');
?>
<section class="date_hero" style="background-image: url(<?=$bg?>)">
    <div class="date_hero__inner px-4 py-5">
        <h1>
            <div class="date_hero__name">
                <?=get_field('event_name')?>
            </div>
            <div class="date_hero__date">
                <?php
                        $eventDateTime = get_field('event_date_time');
$date = DateTime::createFromFormat('Y-m-d H:i:s', $eventDateTime);
$formattedDate = $date->format('jS F, Y'); // Outputs: 11th May, 2024

echo $formattedDate;
?>
            </div>
            <div class="date_hero__location">
                <?=get_field('event_location')?>
            </div>
        </h1>
        <hr class="w-75 mx-auto">
        <div class="datehero__countdown">
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
</section>