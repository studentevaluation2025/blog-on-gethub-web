@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Error Message -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">
    <!-- Category Name Field -->
    <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="category_name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name') }}" required>
            <!-- Error Message for category_name -->
            @error('category_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mb-3 col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <label for="submit" class="col-sm-2 col-form-label">&nbsp;</label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
