$(function(){
    $(document).on('click', '.showAjaxModal', function() {
        if ($('#ajax-modal').data('bs.modal').isShown) {
            $('#ajax-modal').find('#modalContent').load($(this).attr('value'));
        } else {
            $('#ajax-modal').modal('show').find('#modalContent').load($(this).attr('value'));
        }
    });
});