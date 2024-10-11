@extends('layouts.base', ['page' => 'users'])
@section('content')
@php
    $buttonTitle = "Save";
@endphp
<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add User</h5>
    <!-- General Form Elements -->
    <form action="{{ route('category.store') }}" autocomplete="off" method="POST">
        @csrf
        @include('backend.user_management.users.form')

    </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
