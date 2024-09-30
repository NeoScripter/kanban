<form action="{{ route('dashboard.store') }}" method="post" class="webform">
    @csrf

    <h2 class="webform__title">Add New Board</h2>
    <div class="webform__input-group">
        <label for="name">Board Name:</label>
        <input type="text" name="name" placeholder="e.g. Web Design" required>
    </div>

    <div class="webform__input-group">
        <label for="categories">Board Columns:</label>
        <input type="text" name="categories[]" class="category-input" placeholder="e.g. ToDo">
        <input type="text" name="categories[]" class="category-input" placeholder="e.g. Doing">
    </div>

    <button class="webform__login-btn" type="button">+Add New Column</button>

    <button type="submit" class="webform__submit-btn">Create New Board</button>
</form>
