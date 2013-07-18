  window.onload = function(){
    var parts = (window.location.pathname.match(/\/admin\/([^\/]+)/));
    $('#top a[href$="' + parts[1] + '"]').parent().addClass('active');
    $('#nav li a[href$="' + parts[1] + '"]').parent().addClass('active');
  }