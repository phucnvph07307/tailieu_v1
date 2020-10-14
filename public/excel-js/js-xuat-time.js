$("#submitXuatData").click(function(){
    var fromDate = $("[name='dateFrom']").val();
    var dateTo = $("[name='dateTo']").val()
    if(
        ($("[name='dateFrom']").val() == '' || $("[name='dateFrom']").val() == null)
        || ($("[name='dateTo']").val() == '' || $("[name='dateTo']").val() == null)
        || ($('#truong_id_xuat').val() == '' || $("[name='dateTo']").val() == null )
    ){
        $('#echoLoiXuat').text('Bạn hãy nhập đầy đủ thông tin muốn xuất');
        return false;
    }else if(new Date(fromDate) >  new Date(dateTo)){
        $('#echoLoiXuat').text('Sai ngày muốn xuất');
        return false;
    }else{
        $('#echoLoiXuat').text('');
        $('#closeXuatDuLieu').trigger('click');
    }

})
