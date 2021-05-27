$(document).ready(function(){
  $("img").hover(function(){
    $(this).animate({
      height: '+=12px',
      width: '+=12px'
  });
}, function(){
  $(this).animate({
    height: '-=12px',
    width: '-=12px'
  });
})});
