@csrf

<div class="admin-field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required>
    @error('title')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-field">
    <label for="date">Date</label>
    <input type="date" id="date" name="date" value="{{ old('date', optional($news->date)->format('Y-m-d')) }}" required>
    @error('date')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $news->description) }}</textarea>
    @error('description')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-field">
    <label for="link">Link</label>
    <input type="text" id="link" name="link" value="{{ old('link', $news->link) }}" placeholder="about.php#vision">
    <span class="admin-hint">A legacy path such as <code>about.php#vision</code>, or a full URL.</span>
    @error('link')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-field">
    <label for="image">Image</label>
    @if ($news->image)
        <div class="admin-image-preview">
            <img src="{{ $news->image_url }}" alt="">
        </div>
    @endif
    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
    <span class="admin-hint">JPEG, PNG or WebP, up to 2 MB. Leave empty to keep the current image.</span>
    @error('image')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<label class="admin-check">
    <input type="checkbox" name="published" value="1" @checked(old('published', $news->published))>
    Published
</label>

<div class="admin-form-actions">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.news.index') }}">Cancel</a>
</div>
