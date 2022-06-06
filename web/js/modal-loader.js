
$(document).on('click', '.showAjaxModal', function(e) {
    e.preventDefault();
    if ($('#ajax-modal').is(':visible')) {
        $('#ajax-modal').find('#modalContent').load($(this).attr('href'));
    } else {
        $('#ajax-modal').modal('show').find('#modalContent').load($(this).attr('href'));
    }
});