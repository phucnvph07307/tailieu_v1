$("#co_so_dao_tao").change(function () {
    axios.post(routeGetChinhSach, {
        id: $("#co_so_dao_tao").val(),
    }).then(function (response) {
        var htmldata = '<option value="" >Chọn</option>'
        response.data.forEach(element => {
            htmldata += `<option value="${element.chinh_sach_id}" >${element.ten_chinh_sach}</option>`
        });
        if ($("#co_so_dao_tao").val() == '') {
            $('#chinh_sach_id').attr('disabled', true)
        } else {
            $('#chinh_sach_id').attr('disabled', false)
        }

        $('#chinh_sach_id').html(htmldata);
    }).catch(function (error) {
        console.log(error);
    });
});
var arrcheck = [];

function getdatacheck(id) {

    var datacheck = {
        'id': $(id).attr('name'),
        'value': $(id).val()
    }
    var check = 0;

    if (arrcheck.length == 0) {
        check = 1
        arrcheck.push(datacheck)
    } else {
        for (let index = 0; index < arrcheck.length; index++) {
            if (datacheck.id == arrcheck[index].id) {
                check = 1;
                arrcheck[index].value = datacheck.value;
                break;
            }
        }
    }

    if (check == 0) {
        arrcheck.push(datacheck)
    }
    console.log(arrcheck);
    if (arrcheck.length == 4) {
        axios.post(routeCheck, {
            datacheck: arrcheck,
        }).then(function (response) {
            console.log(response)
            if (response.data.result == 1) {
                swal("Dữ liệu đã tồn tại và được phê duyệt", {
                    buttons: ["OK"],
                })

                removeselect()
            } else if (response.data.result != 2) {
                swal("Dữ liệu đã tồn tại mời chuyển đến trang chỉnh sửa", {
                    buttons: ["Hủy", true],
                }).then(thanhcong => {
                    if (thanhcong != null) {
                        console.log('fdsaf')
                        window.location = response.data.result;
                    }
                })

                removeselect()
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
}

function removeselect() {
    arrcheck = [];
    $("#co_so_id").select2().val('').trigger('change');
    $("#nam").select2().val('').trigger('change');
    $("#dot").select2().val('').trigger('change');
    $("#chinh_sach_id").select2().val('').trigger('change');

}
