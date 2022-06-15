function spin() {
  setTimeout(function () {
    $(":button").prop("disabled", true);
    $(":button").html(
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
    );
  }, 50);
}
