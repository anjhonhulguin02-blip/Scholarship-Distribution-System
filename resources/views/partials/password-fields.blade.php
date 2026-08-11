{{-- Shared password + confirm-password fields with a visibility toggle. --}}
<div class="form-group">
    <label for="{{ $prefix }}_password">Password <span class="required-mark" aria-hidden="true">*</span></label>
    <div class="password-field">
        <input id="{{ $prefix }}_password" name="password" type="password"
            class="form-control @error('password') is-invalid @enderror"
            autocomplete="new-password" required aria-required="true"
            aria-describedby="{{ $prefix }}_password_help @error('password') err_{{ $prefix }}_password @enderror">
        <button type="button" class="password-toggle" aria-pressed="false" aria-label="Show password"
            onclick="togglePasswordVisibility('{{ $prefix }}_password', this)">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </button>
    </div>
    <small id="{{ $prefix }}_password_help" class="form-text text-muted">
        At least 10 characters, including letters and numbers.
    </small>
    @error('password')
        <div class="field-error" id="err_{{ $prefix }}_password">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="{{ $prefix }}_password_confirmation">Confirm Password <span class="required-mark" aria-hidden="true">*</span></label>
    <div class="password-field">
        <input id="{{ $prefix }}_password_confirmation" name="password_confirmation" type="password"
            class="form-control" autocomplete="new-password" required aria-required="true">
        <button type="button" class="password-toggle" aria-pressed="false" aria-label="Show password"
            onclick="togglePasswordVisibility('{{ $prefix }}_password_confirmation', this)">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </button>
    </div>
</div>
