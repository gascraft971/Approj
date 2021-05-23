window.snackbar = function(message, bg = "") {
	var snackbar = $("<div/>").addClass("snackbar show " + bg).html(message);
	$("body").append(snackbar);
	setTimeout(() => {
		snackbar.removeClass("show");
	}, 3000);
}

window.confirmModal = function(message, cancelFunc = function() {}, confirmFunc = function() {}) {
	const modalHtml = $(`
		<div class="modal fade" id="confirmationModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<h5 class="modal-title" id="staticBackdropLabel">${message}</h5>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
	`);

	modalHtml.find(".btn-outline-danger").on("click", () => {
		cancelFunc()
	});

	modalHtml.find(".btn-outline-primary").on("click", () => {
		confirmFunc()
	});

	$("body").append(modalHtml);
	const modal = new mdb.Modal(document.getElementById("confirmationModal"));
	modal.show();
}