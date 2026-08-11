<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Terms &amp; Conditions &mdash; Block Scholar (Academic Demonstration)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Terms of use for Block Scholar, an academic demonstration project. Test data only, not a live scholarship program.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ url('/terms') }}">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="/" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary brand-script">Block Scholar</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="/" class="nav-item nav-link">Home</a>
                    <a href="/scholarships" class="nav-item nav-link">Scholarships</a>
                    <a href="/how-it-works" class="nav-item nav-link">How It Works</a>
                    <a href="/register" class="nav-item nav-link">Sign Up</a>
                </div>
                <a href="/login" class="btn btn-primary px-4">Login</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h1 style="font-size: 1.75rem;">Terms &amp; Conditions</h1>
                            <p class="text-muted">Last updated: {{ now()->format('F j, Y') }}</p>

                            <div class="alert alert-warning">
                                <strong>Academic Demonstration &mdash; Use Test Data Only.</strong> Block Scholar is
                                a student project, not a registered company or a live scholarship program. These
                                Terms describe how the demo works; they are not a professionally reviewed legal
                                contract and create no real financial or legal obligation between you and anyone.
                            </div>

                            <h2 style="font-size: 1.3rem;">1. Acceptance</h2>
                            <p>By creating an account or otherwise using Block Scholar (the "Service"), you agree to
                                these Terms and to the <a href="/privacy">Privacy Policy</a>.</p>

                            <h2 style="font-size: 1.3rem;">2. Eligibility &amp; Age Requirement</h2>
                            <p>You must be <strong>at least 18 years old</strong> to create an account, whether as a
                                Student or as an Organization/Provider representative. This is the single age rule
                                enforced everywhere in the Service &mdash; at registration, and described
                                consistently in this document and the Privacy Policy. The Service does not currently
                                support account creation by minors and has no parent/guardian consent workflow; if a
                                future version were to support minor applicants, that workflow would need to be
                                built and reviewed before launch.</p>

                            <h2 style="font-size: 1.3rem;">3. Accounts</h2>
                            <p>You are responsible for the accuracy of the information you submit and for keeping
                                your password confidential. Organization/Provider accounts represent that the
                                person registering is authorized to act on the organization's behalf. We may
                                suspend or remove an account used for fraudulent applications, fraudulent
                                scholarship listings, or attempts to access another user's data or files.</p>

                            <h2 style="font-size: 1.3rem;">4. How Scholarships &amp; Applications Work</h2>
                            <p>Organizations/Providers list scholarships with an amount, number of available slots,
                                eligibility/requirements text, and an optional deadline. Students apply with a
                                supporting PDF and a payment address. Providers review applications and may approve
                                or reject them. See <a href="/how-it-works">How It Works</a> for the full walkthrough
                                and the sample status timeline. <strong>Listing or applying to a scholarship is not
                                a guarantee of funding.</strong> Providers control approval and disbursement of
                                their own listed scholarships.</p>

                            <h2 style="font-size: 1.3rem;">5. Disbursement &amp; Blockchain Use</h2>
                            <p>Approved disbursements are sent as a blockchain transaction on the
                                <strong>Ethereum Sepolia test network</strong>, not Ethereum mainnet. Test ETH used
                                in this demo has no real-world monetary value. The transaction hash is checked
                                against the network before being marked verified in the app; see
                                <a href="/how-it-works#disbursement">How It Works</a> for exactly what is (and is
                                not) verified. Because public blockchain transactions are permanent once confirmed,
                                they cannot be reversed, edited, or deleted by us, the provider, or the student.</p>

                            <h2 style="font-size: 1.3rem;">6. Uploaded Content</h2>
                            <p>You retain ownership of documents, photos, and images you upload. You represent that
                                you have the right to upload them and that they do not violate anyone else's rights.
                                Do not upload real government-issued IDs or other real sensitive documents to this
                                demo &mdash; use placeholder/test files instead.</p>

                            <h2 style="font-size: 1.3rem;">7. Acceptable Use</h2>
                            <ul>
                                <li>No submitting fraudulent applications or fake scholarship listings.</li>
                                <li>No attempting to access another user's account, files, or data without
                                    authorization.</li>
                                <li>No uploading malicious files or attempting to disrupt the Service.</li>
                                <li>No using the Service to collect or process anyone's real sensitive personal
                                    data.</li>
                            </ul>

                            <h2 style="font-size: 1.3rem;">8. No Warranty</h2>
                            <p>The Service is provided "as is," as a demonstration/portfolio project, without
                                warranties of any kind, express or implied, including fitness for a particular
                                purpose or uninterrupted availability.</p>

                            <h2 style="font-size: 1.3rem;">9. Limitation of Liability</h2>
                            <p>To the fullest extent permitted by law, the creators of this academic project are
                                not liable for any damages arising from use of the Service, including reliance on
                                it as if it were a real scholarship program.</p>

                            <h2 style="font-size: 1.3rem;">10. Termination</h2>
                            <p>We may suspend or terminate an account at any time, particularly for violations of
                                Section 7. You may request deletion of your account at any time by emailing
                                <a href="mailto:anjhonhulguin7@gmail.com">anjhonhulguin7@gmail.com</a>.</p>

                            <h2 style="font-size: 1.3rem;">11. Governing Law</h2>
                            <p>These Terms are written with reference to Philippine law as the intended operating
                                context for this project, without claiming any formal legal review or
                                certification.</p>

                            <h2 style="font-size: 1.3rem;">12. Changes</h2>
                            <p>As an actively developed academic project, these Terms may change. The "Last
                                updated" date above reflects the latest revision.</p>

                            <h2 style="font-size: 1.3rem;">13. Contact</h2>
                            <p>Questions about these Terms:
                                <a href="mailto:anjhonhulguin7@gmail.com">anjhonhulguin7@gmail.com</a>. Project
                                source code: <a href="https://github.com/anjhonhulguin02-blip/Scholarship-Distribution-System"
                                    target="_blank" rel="noopener noreferrer">github.com/anjhonhulguin02-blip/Scholarship-Distribution-System</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="/" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0"
                    style="font-size: 40px; line-height: 40px;">
                    <span class="text-white brand-script">Block Scholar</span>
                </a>
                <p>Experience the future of education funding with Block Scholar—leveraging blockchain technology to
                    deliver transparent, secure, and efficient scholarship solutions.</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="https://github.com/anjhonhulguin02-blip/Scholarship-Distribution-System" target="_blank" rel="noopener noreferrer" aria-label="Block Scholar source code on GitHub"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Get In Touch</h3>
                <div class="d-flex">
                    <h4 class="fa fa-info-circle text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Project Status</h5>
                        <p>Academic Demonstration &mdash; Use Test Data Only</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Contact</h5>
                        <p><a class="text-white" href="mailto:anjhonhulguin7@gmail.com">anjhonhulguin7@gmail.com</a></p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fab fa-github text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Source Code</h5>
                        <p><a class="text-white" href="https://github.com/anjhonhulguin02-blip/Scholarship-Distribution-System" target="_blank" rel="noopener noreferrer">View on GitHub</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Quick Links</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="/scholarships"><i class="fa fa-angle-right mr-2"></i>Scholarships</a>
                    <a class="text-white mb-2" href="/privacy"><i class="fa fa-angle-right mr-2"></i>Privacy
                        Policy</a>
                    <a class="text-white mb-2" href="/terms"><i class="fa fa-angle-right mr-2"></i>Terms &
                        Conditions</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
            </div>
        </div>
        <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, .2);;">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-primary font-weight-bold" href="/">Block Scholar</a>. All Rights
                Reserved.

            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
</body>

</html>
