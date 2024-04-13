<?php
if (isset(get_field('tickets_on_sale', 'options')[0]) && get_field('tickets_on_sale', 'options')[0] == 'Yes') {
    ?>
<section class="signup py-4">
    <div class="container-xl">
        <h2 class="h2 text-center mb-1">Tickets now on sale</h2>
        <div class="signup_form text-center">
            <a href="<?=get_field('tickets_url', 'options')?>"
                class="btn btn-red" target="_blank">Buy Tickets</a>
        </div>
    </div>
</section>
<?php
} elseif (isset(get_field('tickets_available', 'options')[0]) && get_field('tickets_available', 'options')[0] == 'Yes') {
    ?>
<section class="signup py-4">
    <div class="container-xl">
        <h2 class="h2 text-center mb-1">Tickets on sale soon</h2>
        <div class="text-center mb-3">Enter your email address to be the first to know.</div>
        <div class="signup_form">
            <?=do_shortcode('[contact-form-7 id="' . get_field('form_id') . '"]')?>
        </div>
    </div>
</section>
<?php
}
