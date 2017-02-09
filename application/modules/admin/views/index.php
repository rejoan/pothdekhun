<div class="col-xs-12">

    <?php
    echo create_box('bg-aqua', $routes, 'Routes Added', 'route_manager/latest');
    echo create_box('bg-black', $edited_routes, 'Routes Edited', 'route_manager');
    echo create_box('bg-green', $transports, 'Transports Added', 'b_janina/latest_poribohon');
    echo create_box('bg-orange', $edited_transports, 'Transports Edited', 'b_janina/edited_poribohons');
    echo create_box('bg-yellow', $comments, 'Comment Added', 'comments');
    echo create_box('bg-maroon', $contact_us, 'Contact us Added', 'comments/contact');
    echo create_box('bg-fuchsia', $verify, 'Verification Added', 'comments/contact');
    ?>

</div>