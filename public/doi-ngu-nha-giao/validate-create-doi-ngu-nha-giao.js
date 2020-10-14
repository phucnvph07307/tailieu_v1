$(document).ready(function() {
    $('[type="number"]').on("blur", function() {
        var value = $(this).val();

        $(this).val(Number(value));
    });
    $("#co_so_id").change(function() {
        var op = $("select option:selected").val();
        axios
            .get("/xuat-bao-cao/doi-ngu-nha-giao/nganhnghe/" + op)
            .then(function(response) {
                var htmldata =
                    '<option value="-1">-----Chọn ngành nghề-----</option>';
                response.data.forEach((element) => {
                    htmldata += `<option value="${element.id}" >${element.id} --- ${element.ten_nganh_nghe}</option>`;
                });
                $("#nganh_nghe").html(htmldata);
            })
            .catch(function(error) {
                console.log(error);
            });
        if (op <= -1) {
            $("#nganh_nghe-error").html("");
        } else {
            $("#nganh_nghe-error").html("");
            $("#co_so_id-error").html("");
        }
    });
    $('[name="co_so_id"]').change(function() {
        let op = $(this).val();
        let mes = op > 0 ? "" : "Vui lòng chọn cơ sở";
        $("#co_so_id-error").html(mes);
    });
    $('[name="nghe_id"]').change(function() {
        let op = $(this).val();
        let mes = op > 0 ? "" : "Vui lòng chọn ngành nghề";
        $("#nganh_nghe-error").html(mes);
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
        nghe_id: {
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
        nghe_id: {
            min: "Vui lòng chọn ngành nghề",
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