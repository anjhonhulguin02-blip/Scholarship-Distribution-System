<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.public-head', [
        'title' => 'Scholarship Catalog — Block Scholar (Academic Demonstration)',
        'description' => 'Browse open scholarships in this academic demonstration project: eligibility, requirements, amount, and deadlines.',
    ])
    <style>
        .scholarship-card { display: flex; flex-direction: column; height: 100%; }
        .scholarship-card .card-body { display: flex; flex-direction: column; flex: 1; }
        .scholarship-card .card-footer-actions { margin-top: auto; }
    </style>
</head>

<body>
    @include('partials.public-nav')

    <div class="container-fluid py-5">
        <div class="container">
            <h1 class="mb-2">Scholarship Catalog</h1>
            <p class="text-muted mb-4">This is a read-only, public list generated from the demo database. No account
                is required to browse.</p>

            @if ($scholarships->isEmpty())
                <div class="alert alert-info">No active scholarships are listed right now. Check back later, or
                    <a href="/register">create an account</a> to be notified.</div>
            @else
                <div class="row">
                    @foreach ($scholarships as $s)
                        <div class="col-md-6 col-lg-4 mb-4 d-flex">
                            <div class="card scholarship-card w-100">
                                <div class="card-body">
                                    <h2 style="font-size: 1.25rem;">{{ $s->scholarshipName }}</h2>
                                    <p class="text-muted mb-1"><i class="fa fa-building mr-1" aria-hidden="true"></i>{{ $s->orgName }}</p>
                                    <p class="mb-1"><strong>Amount:</strong> &#8369;{{ number_format($s->scholarshipAmount, 2) }}</p>
                                    <p class="mb-1">
                                        <strong>Deadline:</strong>
                                        {{ $s->applicationDeadline ? \Illuminate\Support\Carbon::parse($s->applicationDeadline)->format('M j, Y') : 'Rolling admissions' }}
                                    </p>
                                    <p class="mb-3">
                                        @if ($s->isFull)
                                            <span class="badge badge-secondary">Slots full</span>
                                        @else
                                            <span class="badge badge-success">{{ $s->openSlots }} slot(s) open</span>
                                        @endif
                                    </p>
                                    <div class="card-footer-actions">
                                        <a href="/scholarships/{{ $s->id }}" class="btn btn-outline-primary btn-block">View Eligibility &amp; Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('partials.public-footer')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
