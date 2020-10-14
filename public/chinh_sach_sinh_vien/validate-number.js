$('[type="number"]').on('blur', function () {

    var value = $(this).val();

    $(this).val(Number(value));
})
