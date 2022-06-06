
$(document).on('click', '.showAjaxModal', function() {
    if ($('#ajax-modal').is(':visible')) {
        $('#ajax-modal').find('#modalContent').load($(this).attr('value'));
    } else {
        $('#ajax-modal').modal('show').find('#modalContent').load($(this).attr('value'));
    }
});