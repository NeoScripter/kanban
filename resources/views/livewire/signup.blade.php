<form class="webform">

    <h2 class="webform__title">{{ __('content.auth_signup') }}</h2>

    <div class="webform__input-group">
        <label for="signup-name">{{ __('content.auth_name') }}</label>
        <input type="text" id="signup-name" wire:model="name">
        @error('name')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-email">{{ __('content.auth_email') }}</label>
        <input type="email" id="signup-email" wire:model="email">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-password">{{ __('content.auth_password') }}</label>
        <input type="password" id="signup-password" wire:model="password">
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="webform__input-group">
        <label for="signup-password_confirmation">{{ __('content.auth_confirm_password') }}</label>
        <input type="password" id="signup-password_confirmation" wire:model="password_confirmation">
    </div>

    <button class="webform__signup-btn" id="webformSignupBtn"
        type="button">{{ __('content.auth_login_prompt') }}</button>

    <button class="webform__submit-btn" type="submit"
        wire:click.prevent="signup">{{ __('content.auth_signup') }}</button>
</form>
