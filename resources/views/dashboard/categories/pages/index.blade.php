<div id="pages" class="container">
	<div class="title">
		<h1>Pages</h1>
		<span class="badge bg-primary p-2"><strong>{{ $posts->count() }}</strong> pages</span>
	</div>
	<div class="search-bar input-group input-group-lg mb-2">
		<span class="input-group-text border-0">
			<input class="form-check-input main-selection-checkbox" type="checkbox" value="">
		</span>
		<input type="text" class="form-control search-filter" placeholder="Search for a page here..."/>
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
				<td class="edit-button"><button class="btn btn-sm shadow-0" data-route="/post/{{ $post->uuid }}/edit">EDIT</button></td>
				<td class="delete-button"><button class="btn btn-sm shadow-0" data-route="{{ route("posts.destroy", [$post->slug]) }}"><i class="bi-trash text-danger" style="font-size: 2em;"></i></button></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="fixed-action-btn">
		<form method="POST" action="{{ route("posts.store") }}">
			@csrf
			<button type="sumbit" class="btn btn-floating btn-primary btn-lg" style="width: 3.813rem; height: 3.813rem;">
				<i class="bi-file-earmark-plus" style="width: 2.8125rem; line-height: 2.8125rem; font-size: 2em;"></i>
			</button>
		</form>
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

		$("#pages .search-filter").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#pages table tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
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
				var button = this;
				$.post({
					url: url,
					data: {
						_method: "DELETE"
					}
				}).done(() => {
					$(this).parent().parent().remove()
					window.snackbar("Post deleted");
				}).catch((error) => {
					window.snackbar("There was an error in deleting the post.", "bg-danger")
					console.log(error);
				});
			}
		});
	});
</script>