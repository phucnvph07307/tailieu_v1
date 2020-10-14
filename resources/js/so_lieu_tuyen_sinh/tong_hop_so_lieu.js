$(function() {
  const queryString = new URLSearchParams(window.location.search);
  const nam = queryString.get('nam') ? queryString.get('nam') : (new Date()).getFullYear();
  const dot = queryString.get('dot') ? queryString.get('dot') :
    ((new Date()).getMonth()+1 < 6 ? 1 : 2);
  $("#nam").val(nam);
  $("#dot").val(dot);

  if (queryString.get('loai_hinh')) {
    $("#loai_hinh").val(queryString.get('loai_hinh'));
  } else {
    $("#loai_hinh").val(0);
  }

  if (queryString.get('co_so_id')) {
    $("#co_so_id").val(queryString.get('co_so_id'));
  }

  $("#chi_tiet_co_so").click(function (event) {
    event.preventDefault();
    console.log('aaaa');
  });
});
