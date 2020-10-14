$(document).ready(function() {
    $('[type="number"]').on("blur", function() {
        var value = $(this).val();

        $(this).val(Number(value));
    });
    $('[name="co_so_id"]').change(function() {
        let op = $(this).val();
        let mes = op > 0 ? "" : "Vui lòng chọn cơ sở";
        $("#ten_don_vi-error").html(mes);
    });
    $('[name="nam"]').change(function() {
        let op = $(this).val();
        let mes = op > 0 ? "" : "Vui lòng chọn năm";
        $("#nam-error").html(mes);
    });
    $('[name="dot"]').change(function() {
        let op = $(this).val();
        let mes = op > 0 ? "" : "Vui lòng chọn đợt";
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
        min: 0,
    };

    let rules = {
        co_so_id: {
            min: 0,
        },
        nam: {
            min: 0,
        },
        dot: {
            min: 0,
        },
    };
    listField.forEach(function(value) {
        rules[value] = rule;
    });

    const mess = {
        number: "Vui lòng nhập liệu hợp lệ",
        digits: "Vui lòng nhập số nguyên",
        min: "Số liệu nhỏ nhất là 0",
    };

    let messages = {
        co_so_id: {
            min: "Vui lòng chọn cơ sở",
        },
        nam: {
            min: "Vui lòng chọn năm",
        },
        dot: {
            min: "Vui lòng chọn đợt",
        },
    };
    listField.forEach(function(value) {
        messages[value] = mess;
    });
    $("#validate-form-add").validate({
        rules: rules,
        messages: messages,
    });
    $(".select2").select2();
});