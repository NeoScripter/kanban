<form class="webform">

    <h2 class="webform__title">Sign up</h2>

    <div class="webform__input-group">
        <label for="signup-name">Name:</label>
        <input type="text" id="signup-name" wire:model="name">
        @error('name')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-email">Email:</label>
        <input type="email" id="signup-email" wire:model="email">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-password">Password:</label>
        <input type="password" id="signup-password" wire:model="password">
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-password_confirmation">Confirm Password:</label>
        <input type="password" id="signup-password_confirmation" wire:model="password_confirmation">
    </div>

    <button class="webform__signup-btn" id="webformSignupBtn" type="button">Log in here if you have an account</button>

    <button class="webform__submit-btn" type="submit" wire:click.prevent="signup">Sign up</button>
</form>
