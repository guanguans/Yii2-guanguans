$(function () {
    // toastr 通知
    var hintInfo = $("#hintInfo").val();
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
    if (hintInfo) {
        if (hintInfo == '成功') {
            toastr.success('成功', '成功');
        } else {
            toastr.error(hintInfo, '失败');
        }
    }

})
