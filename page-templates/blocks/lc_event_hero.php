<section class="event_hero">
    <div class="container-xl py-4">
        <div class="row g-5">
            <div class="col-md-6 order-2 order-md-1 d-flex flex-column justify-content-center" data-aos="fade-right">
                <h1>
                    <div class="event_hero__name">
                        <?=get_field('event_name')?>
                    </div>
                    <div class="event_hero__date">
                        <?php
                        $eventDateTime = get_field('event_date_time');
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $eventDateTime);
                        $formattedDate = $date->format('jS F, Y'); // Outputs: 11th May, 2024

                        echo $formattedDate;
                        ?>
                    </div>
                    <div class="event_hero__location">
                        <?=get_field('event_location')?>
                    </div>
                </h1>
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
                <div class="event_hero__buttons">
                    <?php
                        $t = get_field('tickets_link') ?? null;
                        $r = get_field('fighter_registration_link') ?? null;

                        if (isset(get_field('tickets_on_sale', 'options')[0]) && get_field('tickets_on_sale', 'options')[0] == 'Yes') {
                            ?>
                    <a href="<?=get_field('tickets_url', 'options')?>"
                        target="_blank" class="btn btn-red">Buy Tickets</a>
                    <?php
                        } elseif (isset(get_field('tickets_available', 'options')[0]) && get_field('tickets_available', 'options')[0] == 'Yes') {
                            ?>
                    <a href="<?=$t['url']?>"
                        target="<?=$t['target']?>"
                        class="btn btn-red"><?=$t['title']?></a>
                    <?php
                        }
                        if (isset(get_field('registration_open', 'options')[0]) && get_field('registration_open', 'options')[0] == 'Yes') {
                            ?>
                    <a href="<?=$r['url']?>"
                        target="<?=$r['target']?>"
                        class="btn btn-red"><?=$r['title']?></a>
                    <?php
                        }
                        ?>
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2 d-flex align-items-center" data-aos="fade-left">
                <img src="<?=wp_get_attachment_image_url(get_field('hero_image'), 'full')?>"
                    alt="">
            </div>
        </div>
    </div>
</section>