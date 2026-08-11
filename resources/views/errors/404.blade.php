<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.public-head', [
        'title' => 'Page Not Found — Block Scholar (Academic Demonstration)',
        'description' => 'The page you were looking for does not exist on Block Scholar.',
    ])
    <meta name="robots" content="noindex">
</head>

<body>
    @include('partials.public-nav')

    <div class="container-fluid py-5">
        <div class="container text-center" style="max-width: 600px;">
            <h1 style="font-size: 4rem;" class="text-primary">404</h1>
            <h2 style="font-size: 1.5rem;">Page Not Found</h2>
            <p class="text-muted">The page you're looking for doesn't exist, may have moved, or the link is broken.
                This is an academic demonstration project &mdash; some pages are intentionally limited in scope.</p>
            <div class="mt-4">
                <a href="/" class="btn btn-primary mr-2">Go Home</a>
                <a href="/scholarships" class="btn btn-outline-primary">Browse Scholarships</a>
            </div>
        </div>
    </div>

    @include('partials.public-footer')
</body>

</html>
