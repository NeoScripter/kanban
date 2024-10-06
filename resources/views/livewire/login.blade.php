<form class="webform">

    <h2 class="webform__title">{{ __('content.auth_login') }}</h2>

    <div class="webform__input-group">
        <label for="login-email">{{ __('content.auth_email') }}</label>
        <input type="email" id="login-email" wire:model="email">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="login-password">{{ __('content.auth_password') }}</label>
        <input type="password" id="login-password" wire:model="password">
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>


    <button class="webform__login-btn" id="webformLoginBtn"
        type="button">{{ __('content.auth_signup_prompt') }}</button>

    <button class="webform__submit-btn" type="submit"
        wire:click.prevent="login">{{ __('content.auth_login') }}</button>
</form>
