$(document).ready(function() {
    $('[type="number"]').on("blur", function() {
        var value = $(this).val();

        $(this).val(Number(value));
    });
    $("#validate-form-update").validate({
        rules: {
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
});