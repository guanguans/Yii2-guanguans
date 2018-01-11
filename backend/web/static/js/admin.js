$(function () {
    // toastr 通知
    var info = $("#info").val();
    var infoObj = eval("("+info+")");
    console.log(infoObj);
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    if (infoObj) {
        if (infoObj['code'] == 1) {
            toastr.success(infoObj['data'], '操作成功');
        } else {
            toastr.error(infoObj['data'], '操作失败');
        }
    }
})
