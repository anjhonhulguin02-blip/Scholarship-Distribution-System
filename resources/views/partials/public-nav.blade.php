{{-- Shared nav for the new public showcase pages (catalog, detail, how-it-works, 404). --}}
<div class="container-fluid bg-light position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
        <a href="/" class="navbar-brand font-weight-bold text-secondary" style="font-size: 2rem;">
            <span class="text-primary brand-script">Block Scholar</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#publicNavCollapse"
            aria-controls="publicNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="publicNavCollapse">
            <div class="navbar-nav font-weight-bold mx-auto py-0">
                <a href="/" class="nav-item nav-link">Home</a>
                <a href="/scholarships" class="nav-item nav-link {{ request()->is('scholarships*') ? 'active' : '' }}">Scholarships</a>
                <a href="/how-it-works" class="nav-item nav-link {{ request()->is('how-it-works') ? 'active' : '' }}">How It Works</a>
            </div>
            <div>
                <a href="/login" class="btn btn-outline-primary px-4 mr-2">Login</a>
                <a href="/register" class="btn btn-primary px-4">Sign Up</a>
            </div>
        </div>
    </nav>
</div>
