/**
 * Preview for HTML markup.
 * 
 * @author gilfoyle
 */
$('#blog_content').keyup(function () {
  $('#blog_preview').html($('#blog_content').val());
});