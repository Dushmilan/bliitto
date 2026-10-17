@csrf

<div class="admin-field">
    <label for="date">Date</label>
    <input type="date" id="date" name="date" value="{{ old('date', optional($announcement->date)->format('Y-m-d')) }}" required>
    @error('date')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-field">
    <label for="text">Text</label>
    <textarea id="text" name="text" rows="3" required>{{ old('text', $announcement->text) }}</textarea>
    @error('text')
        <span class="admin-error">{{ $message }}</span>
    @enderror
</div>

<label class="admin-check">
    <input type="checkbox" name="active" value="1" @checked(old('active', $announcement->active))>
    Active
</label>

<div class="admin-form-actions">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.announcements.index') }}">Cancel</a>
</div>
