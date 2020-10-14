$(function () {
  const urlParams = new URLSearchParams(window.location.search);
  for (const [key, value] of urlParams) {
    if (value !== '0') {
      $(`#${key}`).val(value);
    }
  }

  $(".select2").select2();
});
