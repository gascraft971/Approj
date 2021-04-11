<div id="pages" class="container">
	<h1>Pages</h1>
	<div class="search-bar input-group input-group-lg">
		<span class="input-group-text border-0">
			<input class="form-check-input" type="checkbox" value="">
		</span>
		<input type="text" class="form-control" placeholder="Search for a page here..."/>
		<span class="input-group-text border-0 p-0">
			<button class="btn btn-sm shadow-0">
				<i class="bi-filter" style="font-size: 2em;"></i>
			</button>
		</span>
		<span class="input-group-text border-0 p-0">
			<button class="btn btn-sm shadow-0">
				<i class="bi-three-dots" style="font-size: 2em;"></i>
			</button>
		</span>
	</div>
	<table class="table-striped">
		<tbody>
			@foreach ($posts as $post)
			<tr>
				<td><input class="form-check-input" type="checkbox" value=""></td>
				<td class="page-title">Frolicking in the forest</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>