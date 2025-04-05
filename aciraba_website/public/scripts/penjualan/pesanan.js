const socket = io(baseurlsocket);
$("#katakuncipencarian").on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabelpesanan').DataTable().ajax.reload();
    });
}, 500));
$("#pencarian").on("click", function(){
    getCsrfTokenCallback(function() {
        $('#tabelpesanan').DataTable().ajax.reload();
    });
});
$("#jenistransaksi").change(function(){
    getCsrfTokenCallback(function() {
        $('#tabelpesanan').DataTable().ajax.reload();
    });
});