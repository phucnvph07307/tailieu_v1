$('[type="number"]').on("blur", function() {
    var value = $(this).val();
    $(this).val(Number(value));
});
// Validation
$('[name="co_so_id"]').change(function() {
    let op = $(this).val();
    let mes = op != "" ? "" : "Vui lòng chọn cơ sở";
    $("#co_so_dao_tao-error").html(mes);
});
$('[name="nghe_id"]').change(function() {
    let op = $(this).val();
    let mes = op != "" ? "" : "Vui lòng chọn ngành nghề";
    $("#ma_nganh_nghe-error").html(mes);
});

let nodeList = document.querySelectorAll(".m-input");
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
        required: true
    },
    nghe_id: {
        required: true
    },
    nam: {
        required: true
    },
    dot: {
        required: true
    }
};
listField.forEach(function(value) {
    rules[value] = rule;
});

const mess = {
    number: "Vui lòng nhập liệu hợp lệ",
    digits: "Vui lòng nhập số nguyên",
    min: "Vui lòng lớn hơn 0"
};
let messages = {
    co_so_id: {
        required: "Vui lòng chọn cơ sở"
    },
    nghe_id: {
        required: "Vui lòng chọn ngành nghề"
    },
    nam: {
        required: "Vui lòng chọn năm"
    },
    dot: {
        required: "Vui lòng chọn đợt"
    }
};
listField.forEach(function(value) {
    messages[value] = mess;
});
$("#validate-form").validate({
    rules: rules,
    messages: messages,
});