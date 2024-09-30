<form wire:submit.prevent="login" class="webform">

    <h2 class="webform__title">Log in</h2>

    <div class="webform__input-group">
        <label for="signup-email">Email:</label>
        <input type="email" id="signup-email" wire:model.lazy="email">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-password">Password:</label>
        <input type="password" id="signup-password" wire:model.lazy="password">
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>


    <button class="webform__login-btn" id="webformLoginBtn" type="button">Sign up here if you don't have an account</button>

    <button class="webform__submit-btn" type="submit">Log in</button>
</form>
