$(document).ready(function() {
    $("#co_so_id").change(function() {
        var op = $("select option:selected").val();
        axios
            .get("/xuat-bao-cao/doi-ngu-nha-giao/nganhnghe/" + op)
            .then(function(response) {
                var htmldata = '<option value="-1">-----Chọn ngành nghề-----</option>';
                response.data.forEach((element) => {
                    htmldata +=
                        `<option value="${element.id}" >${element.id} --- ${element.ten_nganh_nghe}</option>`;
                });
                $("#nghe_id").html(htmldata);
            })
            .catch(function(error) {
                console.log(error);
            });
    });

});

$(document).ready(function() {
    $('[type="number"]').on("blur", function() {
        var value = $(this).val();

        $(this).val(Number(value));
    });
    $('[name="co_so_id"]').change(function() {
        let op = $(this).val();
        let mes = (op > 0) ? "" : "Vui lòng chọn cơ sở";
        $('#co_so_id-error').html(mes);
    });
    $('[name="nghe_id"]').change(function() {
        let op = $(this).val();
        let mes = (op > 0) ? "" : "Vui lòng chọn ngành nghề";
        $('#nghe_id-error').html(mes);
    });
    $('[name="nam"]').change(function() {
        let op = $(this).val();
        let mes = (op > 0) ? "" : "Vui lòng chọn năm";
        $('#nam-error').html(mes);
    });
    $('[name="dot"]').change(function() {
        let op = $(this).val();
        let mes = (op > 0) ? "" : "Vui lòng chọn đợt";
        $('#dot-error').html(mes);
    });

    $("#validate-form-add").validate({
        rules: {
            co_so_id: {
                min: 0
            },
            nam: {
                min: 0
            },
            dot: {
                min: 0
            },
            nghe_id: {
                min: 0
            },
            tong: {
                number: true,
                digits: true,
                min: 0
            },
            so_dang_ki_CD: {
                number: true,
                digits: true,
                min: 0
            },
            so_dang_ki_TC: {
                number: true,
                digits: true,
                min: 0
            }
        },
        messages: {
            co_so_id: {
                min: "Vui lòng chọn cơ sở"
            },
            nam: {
                min: "Vui lòng chọn năm"
            },
            dot: {
                min: "Vui lòng chọn đợt"
            },
            nghe_id: {
                min: "Vui lòng chọn ngành nghề"
            },
            tong: {
                number: "Vui lòng nhập liệu hợp lệ",
                digits: "Vui lòng nhập số nguyên",
                min: "Số liệu nhỏ nhất là 0"
            },
            so_dang_ki_CD: {
                number: "Vui lòng nhập liệu hợp lệ",
                digits: "Vui lòng nhập số nguyên",
                min: "Số liệu nhỏ nhất là 0"
            },
            so_dang_ki_TC: {
                number: "Vui lòng nhập liệu hợp lệ",
                digits: "Vui lòng nhập số nguyên",
                min: "Số liệu nhỏ nhất là 0"
            }
        }
    });

    $('.select2').select2();
});