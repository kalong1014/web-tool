  jQuery(document).ready(function($) {
        $("#domainextensions").owlCarousel({
            autoPlay: 4000,
            items: 8,
            itemsDesktop: [1199, 6],
            itemsDesktopSmall: [979, 6],
            pagination: false
        });

        $("#tld-table").tablesorter();;
    });