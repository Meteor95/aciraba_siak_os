// Mengikat event click pada elemen .mc-btn-action menggunakan event delegation
$(document).on('click', '.mc-btn-action', function() {
    var card = $(this).closest('.material-card');
    var icon = $(this).find('i');
    icon.addClass('fa-spin-fast');
    if (card.hasClass('mc-active')) {
      card.removeClass('mc-active');
      window.setTimeout(function() {
        icon
          .removeClass('fa-arrow-left')
          .removeClass('fa-spin-fast')
          .addClass('fa-bars');
      }, 800);
    } else {
      card.addClass('mc-active');
      window.setTimeout(function() {
        icon
          .removeClass('fa-bars')
          .removeClass('fa-spin-fast')
          .addClass('fa-arrow-left');
      }, 800);
    }
});