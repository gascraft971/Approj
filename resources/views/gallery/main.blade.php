{{--@section("title", "Gallery")
@extends("gallery.index")

@section("gallery")
--}}
<!-- Page Content -->
<div class="modal fade" tabindex="-1" id="galleryModal" aria-labelledby="galleryModalLabel">
	<div class="modal-dialog" style="width: 80vw; max-width: none;">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h5 class="modal-title" id="galleryModalLabel">Gallery</h5>
				<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body position-relative">
				<div class="gallery">
					<div class="container position-relative">
						<div class="row text-center text-lg-left">
							<div class="col-lg-3 col-md-4 col-6">
								<a href="#" class="upload-btn mb-4 img-fluid bg-light">
									<i class="bi-plus"></i>
								</a>
							</div>

							@foreach ($images as $image)
							<div class="col-lg-3 col-md-4 col-6">
								<a href="#" class="mb-4 img-fluid gallery-link bg-light">
									<img class="lazyload-small" src="{{ "/uploads/images/thumb/" . $image->name }}"/>
									<img class="lazyload-full lazyload d-none image" data-src="{{ "/uploads/images/" . $image->name }}">
								</a>
							</div>
							@endforeach
						</div>
					</div>
					<div class="confirm-button">
						<button class="btn btn-light btn-sm" disabled="disabled">
							<i class="bi-check icon-1-5x"></i>
						</button>
					</div>
				</div>
				<div class="upload-new-image" style="display: none">
					<div class="accordion" id="method-choose-accordion">

					    <div class="accordion-item">
					        <h2 class="accordion-header">
					            <button class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#galleryModal .by-file" aria-expanded="false">
					                By file
					            </button>
					        </h2>

					        <div class="by-file accordion-collapse collapse show" data-mdb-parent="#method-choose-accordion">
					            <div class="accordion-body">
									<button class="btn btn-primary btn-sm">Choose file</button>
									<div class="progress d-none">
										<div class="progress-bar bg-info" role="progressbar"></div>
									</div>
					            </div>
					        </div>
					    </div>

					    <div class="accordion-item">
					        <h2 class="accordion-header">
					            <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#galleryModal .by-url" aria-expanded="false">
					                From URL
					            </button>
					        </h2>

					        <div class="by-url accordion-collapse collapse" data-mdb-parent="#method-choose-accordion">
					            <div class="accordion-body">
									<i>Coming soon</i>
					            </div>
					        </div>
					    </div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{--<!-- /.gallery -->
@endsection--}}
