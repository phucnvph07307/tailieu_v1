$(function() {
  $("thead i").click(function () {
    const sort_field = $(this).closest('th')[0].attributes.id.value;
    const url = new URL(window.location.href);

    let sort_by = 'asc';
    if (url.searchParams.has('sort_field') &&
      url.searchParams.get('sort_field') === sort_field &&
      url.searchParams.get('sort_by') === 'asc') {
      sort_by = 'desc';
    }

    if (url.searchParams.has('sort_field')) {
      url.searchParams.set('sort_field', sort_field);
    } else {
      url.searchParams.append('sort_field', sort_field);
    }

    if (url.searchParams.has('sort_by')) {
      url.searchParams.set('sort_by', sort_by);
    } else {
      url.searchParams.append('sort_by', sort_by);
    }

    window.location.href = url.href;
  });

  const url = new URL(window.location.href);
  if (url.searchParams.has('sort_by') && url.searchParams.get('sort_by') === 'asc') {
    const sort_field = url.searchParams.get('sort_field');
    $("#" + sort_field + " i").removeClass('fa-angle-down');
    $("#" + sort_field + " i").addClass('fa-angle-up');
  } else {
    const sort_field = url.searchParams.get('sort_field');
    $("#" + sort_field + " i").removeClass('fa-angle-up');
    $("#" + sort_field + " i").addClass('fa-angle-down');
  }

  if (url.searchParams.has('paginate_size')) {
    $("#page_size").val(url.searchParams.get('paginate_size'));
  }

  $('#page_size').change(function(){
    var page_size = $(this).val();
    if (url.searchParams.has('paginate_size')) {
      url.searchParams.set('paginate_size', page_size);
    } else {
      url.searchParams.append('paginate_size', page_size);
    }

    window.location.href = url.href;
  });
});
