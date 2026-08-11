{{-- Unchecked-by-default acceptance of Privacy Policy / Terms, linked to the real pages. --}}
<div class="form-group form-check">
    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="{{ $prefix }}_terms"
        name="terms" value="1" required aria-required="true"
        @error('terms') aria-invalid="true" aria-describedby="err_{{ $prefix }}_terms" @enderror>
    <label class="form-check-label" for="{{ $prefix }}_terms">
        I have read and agree to the <a href="/privacy" target="_blank" rel="noopener">Privacy Policy</a>
        and <a href="/terms" target="_blank" rel="noopener">Terms &amp; Conditions</a>.
        <span class="required-mark" aria-hidden="true">*</span>
    </label>
    @error('terms')
        <div class="field-error" id="err_{{ $prefix }}_terms">{{ $message }}</div>
    @enderror
</div>
