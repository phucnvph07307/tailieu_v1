$("#co_so_dao_tao").change(function () {
    var op = $("select option:selected").val();
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
//phuc validate js
$('[name="co_so_id"]').change(function () {
    let op = $(this).val();
    let mes = op != '' ? "" : "Vui lòng chọn cơ sở";
    $("#co_so_id-error").html(mes);
});
$('[name="chinh_sach_id"]').change(function () {
    let op = $(this).val();
    let mes = op != '' ? "" : "Vui lòng chọn chính sách";
    $("#chinh_sach_id-error").html(mes);
});
$('[name="nam"]').change(function () {
    let op = $(this).val();
    let mes = op != '' ? "" : "Vui lòng chọn năm";
    $("#nam-error").html(mes);
});
$('[name="dot"]').change(function () {
    let op = $(this).val();
    let mes = op != '' ? "" : "Vui lòng chọn đợt";
    $("#dot-error").html(mes);
});

let nodeList = document.querySelectorAll(".name-field");
const listField = [];
nodeList.forEach((element) => {
    listField.push(element.getAttribute("name"));
});
const rule = {
    number: true,
    digits: true,
    min: 0
};

let rules = {
    co_so_id: {
        required: true,
    },
    chinh_sach_id: {
        required: true,
    },
    nam: {
        required: true,
    },
    dot: {
        required: true,
    },
};
listField.forEach(function (value) {
    rules[value] = rule;
});

const mess = {
    number: "Vui lòng nhập liệu hợp lệ",
    digits: "Vui lòng nhập số nguyên",
    min: "Số liệu nhỏ nhất là 0",
};

let messages = {
    co_so_id: {
        required: "Vui lòng chọn cơ sở",
    },
    chinh_sach_id: {
        required: "Vui lòng chọn chín sách",
    },
    nam: {
        required: "Vui lòng chọn năm",
    },
    dot: {
        required: "Vui lòng chọn đợt",
    },
};
listField.forEach(function (value) {
    messages[value] = mess;
});
$("#validate-form-add").validate({
    rules: rules,
    messages: messages,
});
//endphuc validate js
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
