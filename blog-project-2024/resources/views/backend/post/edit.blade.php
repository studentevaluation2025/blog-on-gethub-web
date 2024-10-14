<<<<<<< Updated upstream
=======
@extends('layouts.backend.base')
@section('content')
@php
    $buttonTitle = "Update";
@endphp
<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Post</h5>
    <!-- General Form Elements -->
    <form action="{{ route('post.update') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.post.form')

    </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
>>>>>>> Stashed changes
