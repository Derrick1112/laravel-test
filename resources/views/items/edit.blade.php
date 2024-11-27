<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Edit Item</h1>

    <!-- Form for editing item -->
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is necessary for PUT/PATCH request type -->

        <!-- Name input -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <!-- Price input -->
        <div class="form-group">
            <label for="price">Price (RM)</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $item->price) }}" required>
        </div>

        <!-- Details input -->
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" rows="4" required>{{ old('details', $item->details) }}</textarea>
        </div>

        <!-- Publish status (Yes/No) -->
        <div class="form-group">
            <label for="publish">Publish</label>
            <select class="form-control" id="publish" name="publish" required>
                <option value="1" {{ old('publish', $item->publish) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('publish', $item->publish) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary ml-2">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
