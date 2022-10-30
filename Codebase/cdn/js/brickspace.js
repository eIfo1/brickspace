/**
 * Preview for HTML markup.
 * 
 * @author gilfoyle
 */
$('#blog_content').keyup(function () {
  $('#blog_preview').html($('#blog_content').val());
});

function wait(sec) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < sec * 1000);
}
