<div id="pages" class="container">
	<div class="title">
		<h1>Pages</h1>
		<span class="badge bg-primary p-2"><strong>{{ $posts->count() }}</strong> pages</span>
	</div>
	<div class="search-bar input-group input-group-lg mb-2">
		<span class="input-group-text border-0">
			<input class="form-check-input main-selection-checkbox" type="checkbox" value="">
		</span>
		<input type="text" class="form-control" placeholder="Search for a page here..."/>
		<span class="input-group-text border-0 p-0 not-allowed">
			<button class="btn btn-sm shadow-0" disabled="disabled">
				<i class="bi-filter" style="font-size: 2em;"></i>
			</button>
		</span>
		<span class="input-group-text border-0 p-0 not-allowed">
			<button class="btn btn-sm shadow-0" disabled="disabled">
				<i class="bi-three-dots" style="font-size: 2em;"></i>
			</button>
		</span>
	</div>

	<hr/>

	<table>
		<tbody>
			@foreach ($posts as $post)
			<tr>
				<td><input class="form-check-input" type="checkbox" value=""></td>
				<td class="page-title">{{ $post->title }}</td>
				<td class="edit-button"><button class="btn btn-sm shadow-0" data-route="{{ route("posts.edit", [$post->slug]) }}">EDIT</button></td>
				<td class="delete-button"><button class="btn btn-sm shadow-0" data-route="{{ route("posts.destroy", [$post->slug]) }}"><i class="bi-trash text-danger" style="font-size: 2em;"></i></button></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="fixed-action-btn">
		<a href="#pages" class="btn btn-floating btn-primary btn-lg" data-route="{{ route("posts.create") }}">
			<i class="bi-file-earmark-plus" style="width: 2.8125rem; line-height: 2.8125rem; font-size: 1.5em;"></i>
		</a>
	</div>
	
	<div class="modals">
		<!-- New page creation modal -->
		<div class="modal top fade" id="page-creation-modal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Create new post</h5>
						<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Please choose a name for the new document
						<input type="text" class="form-control" placeholder="Enter a name (5-100 characters)">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary sumbit-button">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {
		$("#pages input.main-selection-checkbox").on("change", function() {
			if ($(this).prop("checked")) {
				$("#pages table input[type=checkbox]").prop("checked", true)
			}
			else {
				$("#pages table input[type=checkbox]").prop("checked", false)
			}
		});

		$("#pages table input[type=checkbox]").on("change", function() {
			if (!$(this).prop("checked") && $("#pages input.main-selection-checkbox").prop("checked")) {
				$("#pages input.main-selection-checkbox").prop("checked", false)
			}
		});

		$("#pages table .edit-button button").on("click", function() {
			window.location = $(this).attr("data-route");
		});

		$("#pages table .delete-button button").on("click", function() {
			if (confirm("Are you sure you want to delete this post? It will be lost forever if you press \"OK\"")) {
				var url = $(this).attr("data-route");
				$.post({
					url: url,
					data: {
						_method: "DELETE"
					}
				}).done(() => {
					alert("Post deleted");
				}).catch((error) => {
					alert("There was an error in deleting the post.")
					console.log(error);
				});
			}
		});

		$("#pages .fixed-action-btn a").on("click", function(event) {
			var modal = new mdb.Modal(document.getElementById("page-creation-modal"), {});
			modal.show();
			$("#page-creation-modal .submit-button").on("click", function() {
				
			})
		});
	});
</script>