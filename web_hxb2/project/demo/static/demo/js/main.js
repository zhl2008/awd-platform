$(document).ready(function(){
    // Initializes tooltips
    $('[title]').tooltip({container: 'body'});

    //Apply img-thumbnail class to body-content images
    $('.body-content img').addClass("img-thumbnail");
});