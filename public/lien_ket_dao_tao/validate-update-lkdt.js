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

let rules = {};
listField.forEach(function (value) {
    rules[value] = rule;
});

const mess = {
    number: "Vui lòng nhập liệu hợp lệ",
    digits: "Số liệu nhỏ nhất là 0",
    min: "Số liệu nhỏ nhất là 0"
};

let messages = {};
listField.forEach(function (value) {
    messages[value] = mess;
});
$("#validate-form-update").validate({
    rules: rules,
    messages: messages
});
