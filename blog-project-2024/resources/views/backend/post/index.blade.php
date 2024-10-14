<<<<<<< Updated upstream
=======
@extends('layouts.backend.base')
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
            <h5 class="card-title">Add Post</h5>
    <!-- General Form Elements -->
    <form action="{{ route('post.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.post.form')

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
            <h5 class="card-title">All Posts</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>Id</th>
                  <th>Post Code</th>
                  <th>Post Name</th>
                  <th>Post Slug</th>
                  {{-- <th>Post Summary</th>
                  <th>Post Details</th> --}}
                  {{-- <th>Post Image</th> --}}
                  <th>Post Feaature</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $serial = 1;
                @endphp
                @foreach ($allPosts as $post)
                    <tr>
                        <td>{{ $serial }}</td>
                        <td>{{ $post->post_code }}</td>
                        <td>{{ $post->post_name }}</td>
                        <td>{{ $post->post_slug }}</td>
                        {{-- <td>{{ $post->post_summary }}</td>
                        <td>{{ $post->post_details }}</td> --}}
                        {{-- <td>{{ $post->feature_image }}</td> --}}
                        <td>{{ $post->post_feature }}</td>
                        <td>
                            <button class="btn toggle-status {{ $post->status == 1 ? 'btn-success' : 'btn-danger' }}" data-id="{{ $post->id }}">
                                <i class="bi {{ $post->status == 1 ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                            </button>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ url('/backend/post/edit') }}/{{ $post->id }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline-block;">
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
</main>

<script src="{{ asset('backend/assets/js/jquery.js') }}"></script>
<script>
     $(document).ready(function() {
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var id = button.data('id'); // Get the data-id from the button

        if (id != '') {
            $.ajax({
                url: "{{ route('post.status', ':id') }}".replace(':id', id), // Update the route with the ID
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
>>>>>>> Stashed changes
