


$('#sendCommentModal').on('show.bs.modal' , function (event) {
    let button = $(event.relatedTarget);
    let parentId = button.data('parent');
    let modal = $(this);
    modal.find("[name='parent_id']").val(parentId);
});
