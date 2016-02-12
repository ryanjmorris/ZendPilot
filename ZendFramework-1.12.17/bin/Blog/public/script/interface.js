(function() {
    var count        = 0,
        commentCount = 0;

    $(".create-post a").click(function() {
        if (count == 0) {
            $('.create-post .form-hidden').slideDown(1000);
            count++;
        } else {
            $('.create-post .form-hidden').slideUp(1000);
            count--;
        }
    });

    $(".blog-story .add-comment a").click(function() {
       if (commentCount == 0) {
           $('.blog-story > .form-hidden').slideDown(1000);
           commentCount++;
       } else {
           $('.blog-story > .form-hidden').slideUp(1000);
           commentCount--;
       }
    });

    $('.edit-post').click(function() {
        var $me = $(this).data('post');

        $('.edit-post[data-post='+$me+'] > .form-hidden').slideDown(1000);
    });

    $('.add-comment').click(function() {
        var $me = $(this).data('newcomment');

        $('.add-comment[data-newcomment='+$me+'] > .form-hidden').slideDown(1000);
    });

})();