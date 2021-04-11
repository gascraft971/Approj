$(() => {
	$.ajaxSetup({
        cache: true,
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		}
    });

    $("a[data-sidebar-item]")
		.on("click", function() {
			$("aside .active").removeClass("active");
			$(this).addClass("active");
			$("#loading-spinner").removeClass("d-none");
			$("#selected-setting").addClass("d-none")

			$.post({
				url: "/dashboard/" + $(this).attr("data-sidebar-item")
			}).done((responseText) => {
				$("#selected-setting")
					.html(responseText)
					.removeClass("d-none");
				$("#loading-spinner").addClass("d-none");
			}).catch((error) => {
				console.log("Loading failed: ", error);
			});
		})
		.each(function() {
			if (window.location.hash == ("#" + $(this).attr("data-sidebar-item"))) {
				$(this).trigger("click");
			}
		});
});