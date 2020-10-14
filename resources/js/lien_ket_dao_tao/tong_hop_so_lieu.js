$(function () {
    const queryString = new URLSearchParams(window.location.search);
    const nam = queryString.get('nam') ? queryString.get('nam') : (new Date()).getFullYear();
    const dot = queryString.get('dot') ? queryString.get('dot') :
        ((new Date()).getMonth() + 1 < 6 ? 1 : 2);
    $("#nam").val(nam);
    $("#dot").val(dot);
});
