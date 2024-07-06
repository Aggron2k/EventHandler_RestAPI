@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @for($i = 0; $i < 3; $i++)
            <div class="col-12">


                <div class="card mb-4 flex-row" style="max-width: 900px; margin: 0 auto;">
                    <img src="https://www.notebook.hu/blog/wp-content/uploads/2019/07/windows_xp_bliss-wide.jpg"
                        class="card-img-left example-card-img-responsive" alt="..." style="width: 300px;">
                    <div class="card-body">
                        <h4 class="card-title h5 h4-sm">Horváth Krisztián Meghívott erre az eseményre:</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Bulizás Szegeden</h5>
                            <small class="text-muted ms-2"><i class="fas fa-map-marker-alt me-1"></i>Szeged</small>
                        </div>
                        <hr>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id, architecto
                            provident ad cum voluptas tempora hic tempore rem facere optio cumque quia neque quisquam
                            doloribus eum delectus impedit praesentium molestias?</p>
                        <p><strong>Created by:</strong> Horváth Krisztián</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted mb-0"><i class="fas fa-calendar-alt me-1"></i>2024-07-20
                                10:00:00</small>
                            <small class="text-muted mb-0"><i class="fas fa-eye me-1"></i>Private</small>
                            <small class="text-muted ms-2"><i class="fas fa-tag me-1"></i>Szorakozás</small>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-around mt-3">
                            <button type="button" class="btn btn-outline-success"><i class="fas fa-check me-1"></i>Going</button>
                            <button type="button" class="btn btn-outline-warning"><i class="fas fa-star me-1"></i>Intrested</button>
                            <button type="button" class="btn btn-outline-danger"><i class="fas fa-times me-1"></i>Not
                                going</button>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
</div>
@endsection