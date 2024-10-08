@extends('layouts.base')
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
            <h5 class="card-title">Add Category</h5>
    <!-- General Form Elements -->
    <form action="{{ route('category.store') }}" autocomplete="off" method="POST">
        @csrf
        @include('backend.category.form')

    </form>
          </div>
        </div>
      </div>
    </div>
</section>


  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">All Categories</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>Id</th>
                  <th>
                    <b>C</b>ategory <b>N</b>ame
                  </th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $serial = 1;
                @endphp
                @foreach ($allCategories as $category)
                    <tr>
                        <td>{{ $serial }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_slug }}</td>
                        <td>
                            <button class="btn toggle-status {{ $category->status == 1 ? 'btn-success' : 'btn-danger' }}" data-id="{{ $category->id }}">
                                <i class="bi {{ $category->status == 1 ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                            </button>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ url('/category/edit') }}/{{ $category->id }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" >
                                    {{-- onclick="return confirm('Are you sure you want to delete this category?');" --}}
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $serial++;
                    @endphp
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('backend/assets/js/jquery.js') }}"></script>
<script>
     $(document).ready(function() {
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var id = button.data('id'); // Get the data-id from the button

        if (id != '') {
            $.ajax({
                url: "{{ route('category.status', ':id') }}".replace(':id', id), // Update the route with the ID
                type: "GET",
                cache: false,
                success: function(response) {
                    if (response.status === 1) {
                        // If status is 1, make the button green and show the eye icon
                        button.removeClass('btn-danger').addClass('btn-success');
                        button.find('i').removeClass('bi-eye-slash').addClass('bi-eye');
                    } else {
                        // If status is 0, make the button red and show the eye-slash icon
                        button.removeClass('btn-success').addClass('btn-danger');
                        button.find('i').removeClass('bi-eye').addClass('bi-eye-slash');
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                    console.log(jqXhr);
                    console.log(textStatus);
                }
            });
        }
    });
});

</script>
@endsection
