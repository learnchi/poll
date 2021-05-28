/**
 *
 */
$('#modalImg').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var imgtitle = button.data('imgtitle')
	var imgurl = button.data('imgurl') // Extract info from data-* attributes
	var modal = $(this)
	modal.find('.modal-title').text(imgtitle)
	modal.find('.modal-body img').attr('src',imgurl)
})