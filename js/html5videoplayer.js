
$(document).ready(function(){
    
    var _this = $(this);
    
    var wrapper = _this.find('.video-wrapper');
    var videos = _this.find('.video');
   
    videos.each(function(){
        var width = $(this).css("width");
        var height = $(this).css("width");
         
        $(this).parent().css("width", width);
        $(this).parent().css("height", height);

    });

});