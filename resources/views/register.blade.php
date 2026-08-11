<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Account &mdash; Block Scholar (Academic Demonstration)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Create a Student or Organization/Provider account on Block Scholar, an academic demonstration of a blockchain-assisted scholarship distribution system. Test data only.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ url('/register') }}">

    <link href="/img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background: #f4f7f8; }
        .register-wrap { max-width: 720px; margin: 0 auto; padding: 3rem 1rem; }
        .role-card {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 1.5rem;
            width: 100%;
            text-align: left;
            background: #fff;
            cursor: pointer;
        }
        .role-card:hover, .role-card:focus-visible {
            border-color: #17a2b8;
            outline: 3px solid #005fcc;
            outline-offset: 2px;
        }
        .required-mark { color: #c0392b; }
        .field-error {
            color: #c0392b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .form-control:focus-visible, .role-card:focus-visible, button:focus-visible, a:focus-visible {
            outline: 3px solid #005fcc;
            outline-offset: 2px;
        }
        .password-field { position: relative; }
        .password-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #00394f;
            cursor: pointer;
        }
        .error-summary {
            background: #fdecea;
            border: 1px solid #c0392b;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .demo-banner {
            background: #fff3cd;
            border: 1px solid #ffe69c;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="register-wrap">
        <p><a href="/"><i class="fa fa-angle-left mr-1"></i> Back to home</a></p>
        <h1 style="font-size: 1.75rem;">Create Account</h1>
        <p class="text-muted">Block Scholar is an academic demonstration project. Use test data only &mdash; do not
            enter real government IDs or financial account numbers.</p>

        <div class="demo-banner">
            <strong>Academic Demonstration &mdash; Use Test Data Only.</strong> This is not a live scholarship
            program.
        </div>

        @if ($errors->any())
            <div class="error-summary" role="alert" tabindex="-1" id="errorSummary">
                <strong>Please fix the following before continuing:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Step 1: role choice --}}
        <div id="roleStep" role="group" aria-labelledby="roleStepLabel">
            <h2 id="roleStepLabel" style="font-size: 1.1rem;">First, choose how you'll use Block Scholar</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <button type="button" class="role-card" onclick="selectRole('student')">
                        <i class="fa fa-user-graduate text-primary mb-2" style="font-size:1.5rem;" aria-hidden="true"></i>
                        <h3 style="font-size:1.15rem;">Student</h3>
                        <p class="mb-0 text-muted">Apply for scholarships and track your application status.</p>
                    </button>
                </div>
                <div class="col-md-6 mb-3">
                    <button type="button" class="role-card" onclick="selectRole('organization')">
                        <i class="fa fa-building text-primary mb-2" style="font-size:1.5rem;" aria-hidden="true"></i>
                        <h3 style="font-size:1.15rem;">Organization / Provider</h3>
                        <p class="mb-0 text-muted">List scholarships and review student applications.</p>
                    </button>
                </div>
            </div>
        </div>

        {{-- Student form --}}
        <div id="studentForm" style="display:none;">
            <button type="button" class="btn btn-link px-0 mb-2" onclick="showRoleStep()">
                <i class="fa fa-angle-left mr-1"></i> Change role
            </button>
            <form action="/register/student" method="POST" novalidate>
                @csrf
                <input type="hidden" name="_role" value="student">

                <div class="form-group">
                    <label for="s_firstName">First Name <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="s_firstName" name="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                        value="{{ old('firstName') }}" autocomplete="given-name" required
                        aria-required="true" @error('firstName') aria-invalid="true" aria-describedby="err_firstName" @enderror>
                    @error('firstName')
                        <div class="field-error" id="err_firstName">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="s_middleName">Middle Name</label>
                    <input id="s_middleName" name="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror"
                        value="{{ old('middleName') }}" autocomplete="additional-name">
                    @error('middleName')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="s_lastName">Last Name <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="s_lastName" name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                        value="{{ old('lastName') }}" autocomplete="family-name" required
                        aria-required="true" @error('lastName') aria-invalid="true" aria-describedby="err_lastName" @enderror>
                    @error('lastName')
                        <div class="field-error" id="err_lastName">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="s_address">Address <span class="required-mark" aria-hidden="true">*</span></label>
                    <textarea id="s_address" name="address" rows="2" class="form-control @error('address') is-invalid @enderror"
                        autocomplete="street-address" required aria-required="true"
                        @error('address') aria-invalid="true" aria-describedby="err_address" @enderror>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="field-error" id="err_address">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="s_birthDate">Birth Date <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="s_birthDate" name="birthDate" type="date" class="form-control @error('birthDate') is-invalid @enderror"
                        value="{{ old('birthDate') }}" max="{{ $maxDate }}" autocomplete="bday" required
                        aria-required="true" @error('birthDate') aria-invalid="true" aria-describedby="err_birthDate" @enderror>
                    <small class="form-text text-muted">You must be at least 18 years old to register.</small>
                    @error('birthDate')
                        <div class="field-error" id="err_birthDate">{{ $message }}</div>
                    @enderror
                </div>

                <fieldset class="form-group">
                    <legend style="font-size:1rem;">Gender <span class="required-mark" aria-hidden="true">*</span></legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="s_genderMale" value="male" required {{ old('gender') == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="s_genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="s_genderFemale" value="female" required {{ old('gender') == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="s_genderFemale">Female</label>
                    </div>
                    @error('gender')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </fieldset>

                <div class="form-group">
                    <label for="s_email">Email Address <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="s_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" autocomplete="email" required aria-required="true"
                        @error('email') aria-invalid="true" aria-describedby="err_email" @enderror>
                    @error('email')
                        <div class="field-error" id="err_email">{{ $message }}</div>
                    @enderror
                </div>

                @include('partials.password-fields', ['prefix' => 's'])

                @include('partials.terms-checkbox', ['prefix' => 's'])

                <button type="submit" class="btn btn-primary btn-block py-2">Create Account</button>
            </form>
        </div>

        {{-- Organization / Provider form --}}
        <div id="organizationForm" style="display:none;">
            <button type="button" class="btn btn-link px-0 mb-2" onclick="showRoleStep()">
                <i class="fa fa-angle-left mr-1"></i> Change role
            </button>
            <form action="/register/organization" method="POST" novalidate>
                @csrf
                <input type="hidden" name="_role" value="organization">

                <div class="form-group">
                    <label for="o_organizationName">Organization Name <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="o_organizationName" name="organizationName" type="text" class="form-control @error('organizationName') is-invalid @enderror"
                        value="{{ old('organizationName') }}" autocomplete="organization" required
                        aria-required="true" @error('organizationName') aria-invalid="true" aria-describedby="err_organizationName" @enderror>
                    @error('organizationName')
                        <div class="field-error" id="err_organizationName">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="o_firstName">Authorized Representative &mdash; First Name <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="o_firstName" name="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                        value="{{ old('firstName') }}" autocomplete="given-name" required
                        aria-required="true" @error('firstName') aria-invalid="true" aria-describedby="err_o_firstName" @enderror>
                    @error('firstName')
                        <div class="field-error" id="err_o_firstName">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="o_lastName">Authorized Representative &mdash; Last Name <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="o_lastName" name="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                        value="{{ old('lastName') }}" autocomplete="family-name" required
                        aria-required="true" @error('lastName') aria-invalid="true" aria-describedby="err_o_lastName" @enderror>
                    @error('lastName')
                        <div class="field-error" id="err_o_lastName">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="o_address">Organization Address <span class="required-mark" aria-hidden="true">*</span></label>
                    <textarea id="o_address" name="address" rows="2" class="form-control @error('address') is-invalid @enderror"
                        autocomplete="street-address" required aria-required="true"
                        @error('address') aria-invalid="true" aria-describedby="err_o_address" @enderror>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="field-error" id="err_o_address">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="o_email">Organization Email Address <span class="required-mark" aria-hidden="true">*</span></label>
                    <input id="o_email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" autocomplete="email" required aria-required="true"
                        @error('email') aria-invalid="true" aria-describedby="err_o_email" @enderror>
                    @error('email')
                        <div class="field-error" id="err_o_email">{{ $message }}</div>
                    @enderror
                </div>

                @include('partials.password-fields', ['prefix' => 'o'])

                @include('partials.terms-checkbox', ['prefix' => 'o'])

                <button type="submit" class="btn btn-primary btn-block py-2">Create Account</button>
            </form>
        </div>

        <p class="text-center mt-4">Already have an account? <a href="/login">Log in</a></p>
    </div>

    <script>
        function showRoleStep() {
            document.getElementById('roleStep').style.display = '';
            document.getElementById('studentForm').style.display = 'none';
            document.getElementById('organizationForm').style.display = 'none';
        }

        function selectRole(role) {
            document.getElementById('roleStep').style.display = 'none';
            document.getElementById('studentForm').style.display = role === 'student' ? '' : 'none';
            document.getElementById('organizationForm').style.display = role === 'organization' ? '' : 'none';
            var firstField = document.querySelector('#' + (role === 'student' ? 'studentForm' : 'organizationForm') + ' input, #' + (role === 'student' ? 'studentForm' : 'organizationForm') + ' textarea');
            if (firstField) firstField.focus();
        }

        function togglePasswordVisibility(inputId, btn) {
            var input = document.getElementById(inputId);
            var showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            btn.setAttribute('aria-pressed', String(!showing));
            btn.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
            btn.querySelector('i').className = showing ? 'fa fa-eye' : 'fa fa-eye-slash';
        }

        (function () {
            var activeRole = @json(old('_role'));
            if (activeRole === 'student' || activeRole === 'organization') {
                selectRole(activeRole);
            }
            var summary = document.getElementById('errorSummary');
            if (summary) summary.focus();
        })();
    </script>

    @if (session()->pull('successUserCreate'))
        <script>
            setTimeout(() => {
                Swal.fire({ position: 'center', icon: 'success', title: 'Account created. Please log in.', showConfirmButton: false, timer: 1200 });
            }, 200);
        </script>
    @endif
</body>

</html>
