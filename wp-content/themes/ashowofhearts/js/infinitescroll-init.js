jQuery(function($){

    var $grid = $('.content').masonry({
    // Masonry options...
    itemSelector: '.entry',
    gutter: 30, 
    horizontalOrder: true,
    });

    // get Masonry instance
    var msnry = $grid.data('masonry');

   $('.content').infiniteScroll({
    path: '.archive-pagination li.pagination-next a',
    itemSelector : '.content .entry',
    history: false,   
    append: '.entry',
    outlayer: msnry,
    button: '.view-more-button',
  // using button, disable loading on scroll 
    scrollThreshold: false,
       
    });
});


