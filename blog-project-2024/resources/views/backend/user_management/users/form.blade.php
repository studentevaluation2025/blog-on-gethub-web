@if(session('success'))
    <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <!-- Category Name Field -->
    <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        {{-- <input type="hidden" name="hidden_id" value="{{ $user->id }}"> --}}
        <label for="name" class="col-sm-4 col-form-label">User Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $user->name }}" required>
            <!-- Error Message for category_name -->
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mb-3 col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <label for="submit" class="col-sm-2 col-form-label">&nbsp;</label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">{{ $buttonTitle }}</button>
        </div>
    </div>
</div>
