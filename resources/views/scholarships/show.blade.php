<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.public-head', [
        'title' => $scholarship->scholarshipName . ' — Block Scholar (Academic Demonstration)',
        'description' => 'Eligibility, requirements, amount and deadline for ' . $scholarship->scholarshipName . ' on Block Scholar.',
    ])
</head>

<body>
    @include('partials.public-nav')

    <div class="container-fluid py-5">
        <div class="container" style="max-width: 800px;">
            <p><a href="/scholarships"><i class="fa fa-angle-left mr-1"></i> Back to catalog</a></p>
            <h1 class="mb-1">{{ $scholarship->scholarshipName }}</h1>
            <p class="text-muted"><i class="fa fa-building mr-1" aria-hidden="true"></i>Offered by {{ $scholarship->orgName }}</p>

            <div class="row my-4">
                <div class="col-md-4 mb-3">
                    <div class="card h-100"><div class="card-body">
                        <h2 style="font-size:0.95rem;" class="text-muted">Award Amount</h2>
                        <p class="h4 mb-0">&#8369;{{ number_format($scholarship->scholarshipAmount, 2) }}</p>
                    </div></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100"><div class="card-body">
                        <h2 style="font-size:0.95rem;" class="text-muted">Application Deadline</h2>
                        <p class="h5 mb-0">
                            {{ $scholarship->applicationDeadline ? \Illuminate\Support\Carbon::parse($scholarship->applicationDeadline)->format('F j, Y') : 'Rolling admissions' }}
                        </p>
                    </div></div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100"><div class="card-body">
                        <h2 style="font-size:0.95rem;" class="text-muted">Availability</h2>
                        <p class="h5 mb-0">
                            @if ($scholarship->isFull)
                                <span class="text-secondary">Slots full</span>
                            @else
                                <span class="text-success">{{ $scholarship->openSlots }} of {{ $scholarship->numberOfRespondents }} open</span>
                            @endif
                        </p>
                    </div></div>
                </div>
            </div>

            <h2 style="font-size: 1.25rem;">Eligibility &amp; Requirements</h2>
            <div class="card mb-4"><div class="card-body">
                <p style="white-space: pre-line;">{{ $scholarship->requirements }}</p>
            </div></div>

            <h2 style="font-size: 1.25rem;">How Disbursement Works For This Scholarship</h2>
            <p class="text-muted">
                Once your application is approved, the provider organization records the disbursement through the
                platform. See <a href="/how-it-works#disbursement">How It Works &rarr; Disbursement</a> for exactly
                what is (and isn't) recorded on a public blockchain.
            </p>

            <div class="text-center my-4">
                @if ($scholarship->isFull)
                    <button class="btn btn-secondary btn-lg" disabled>Slots Full</button>
                @else
                    <a href="/register" class="btn btn-primary btn-lg">Create a Student Account to Apply</a>
                @endif
            </div>
        </div>
    </div>

    @include('partials.public-footer')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
