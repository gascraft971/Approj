$(() => {
	$(".gallery-trigger").on("click", () => {
		const modal = new mdb.Modal($("#galleryModal")[0]);
		modal.show();
	});

	initGallery();
});

function initGallery() {
	$(".upload-btn").click(function() {
		$("#galleryModal .gallery").slideUp();
		$("#galleryModal .upload-new-image").slideDown();
		var modal = $("#galleryModal .upload-new-image .by-file");
		var uploader = new ss.SimpleUpload({
            url: "/uploads/file",
            button: modal.find("button")[0],
            name: "image",
            responseType: "json",
            allowedExtensions: ["jpg", "jpeg", "png", "gif"],
            maxSize: 2000,
            disabledClass: "disabled",
            onSubmit: function(filename, extension) {
                modal.find(".progress").removeClass("d-none");
                this.setProgressBar(modal.find(".progress-bar")[0]);
            },         
            onComplete: function(filename, response) {
                console.log("Uploading image...");
                modal.find(".progress").addClass("d-none");
                if (!response) {
                    window.snackbar("Upload failed", "bg-danger");
                }
            }
        });
	})
	$(".gallery-link").not(".clicked").click(function() {
		$(".gallery-link.clicked").removeClass("clicked");
		$(this).addClass("clicked");
		$(".confirm-button button").prop("disabled", false).removeClass("btn-light").addClass("btn-success");
		$(".gallery-link.clicked").click(function() {
			$(this).removeClass("clicked");
			$(".confirm-button button").prop("disabled", true).removeClass("btn-success").addClass("btn-light");
			initGallery();
		});
	});
}

// Lazyload

var ticking = false;
function lazyLoad() {
	var images = document.querySelectorAll('.lazyload');
	if (!images.length) return;
	for (var i=0, nb=images.length ; i <nb ; i++) {
		var img = images[i]
		var rect = img.getBoundingClientRect();
		var isVisible = ((rect.top - window.innerHeight) < 500 && (rect.bottom) > -50 ) ? true : false ;

		if (isVisible) {
			if (!img.src) {
				img.src = img.dataset.src;
				img.classList.remove('lazyload');
				img.addEventListener("load", function() {
					this.classList.remove("d-none");
					$(this).siblings(".lazyload-small").addClass("d-none");
					var element = this;
					setTimeout(function() {
						element.classList.add("is-loaded");
					}, 500);
				});
			}
		}
	}
}

function scrollHandler() {
	console.log("Scroll");
	if (ticking) return;
	window.requestAnimationFrame(function() {
		lazyLoad();
		ticking = false
	});
	ticking = true;
}

window.addEventListener("DOMContentLoaded", function() { lazyLoad() });
window.addEventListener("scroll", scrollHandler);