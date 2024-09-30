<form class="webform">

    <h2 class="webform__title">Log in</h2>

    <div class="webform__input-group">
        <label for="login-email">Email:</label>
        <input type="email" id="login-email" wire:model="email">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" wire:model="password">
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>


    <button class="webform__login-btn" id="webformLoginBtn" type="button">Sign up here if you don't have an account</button>

    <button class="webform__submit-btn" type="submit" wire:click.prevent="login">Log in</button>
</form>
