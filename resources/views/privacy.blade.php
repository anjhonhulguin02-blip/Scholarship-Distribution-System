<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Privacy Policy &mdash; Block Scholar (Academic Demonstration)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="How Block Scholar, an academic demonstration project, collects, stores, and handles data. Test data only.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ url('/privacy') }}">

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
                            <h1 style="font-size: 1.75rem;">Privacy Policy</h1>
                            <p class="text-muted">Last updated: {{ now()->format('F j, Y') }}</p>

                            <div class="alert alert-warning">
                                <strong>Academic Demonstration &mdash; Use Test Data Only.</strong> Block Scholar is
                                a student project built to demonstrate a scholarship-distribution workflow with an
                                optional blockchain-recorded disbursement step. It is not a registered company, is
                                not a live scholarship program, and this policy is <strong>not</strong> a
                                representation of legal or regulatory compliance. It has not been reviewed by a
                                lawyer or a data protection officer. Do not submit real government IDs, real
                                financial account details, or any other sensitive real-world personal data.
                            </div>

                            <h2 style="font-size: 1.3rem;">1. Who This Applies To</h2>
                            <p>This policy covers the Block Scholar web application (the "Service"), built with the
                                Philippine context in mind and referencing the structure of the Philippine Data
                                Privacy Act of 2012 (RA 10173) as a design guide &mdash; not as a compliance
                                certification. If this project were ever operated as a real service, it would need
                                a full legal review, registration considerations with the National Privacy
                                Commission where applicable, and a data protection officer before handling real
                                personal data.</p>

                            <h2 style="font-size: 1.3rem;">2. What Data Is Collected</h2>
                            <p>The Service collects only what its features need to function:</p>
                            <ul>
                                <li><strong>Account data (all users):</strong> first/middle/last name (or
                                    organization name and authorized representative name for providers), address,
                                    email address, hashed password, account type, and account status.</li>
                                <li><strong>Student profile data:</strong> date of birth, gender, contact number,
                                    school name and school year, a profile photo, a report-card/grade image, monthly
                                    household gross and net income, and parent/guardian details (name, date of
                                    birth, occupation, and contact number for each parent, where provided).</li>
                                <li><strong>Application data:</strong> the scholarship applied to, a supporting PDF
                                    document, and a cryptocurrency payment address you provide for potential
                                    disbursement.</li>
                                <li><strong>Transaction data:</strong> disbursement amounts, status, and (once a
                                    disbursement is sent) a public blockchain transaction hash.</li>
                                <li><strong>Basic technical data:</strong> standard web server logs (IP address,
                                    browser type, pages visited, timestamps) generated by normal HTTP traffic.</li>
                            </ul>
                            <p><strong>What is never collected on-chain:</strong> none of the personal data above is
                                written to the blockchain. Only the fund-transfer transaction itself is on-chain.
                                See <a href="/how-it-works#disbursement">How It Works</a> for the full on-chain vs.
                                off-chain breakdown.</p>

                            <h2 style="font-size: 1.3rem;">3. How Data Is Used</h2>
                            <ul>
                                <li>To create and manage your account and let you log in.</li>
                                <li>To let students apply to scholarships and providers review applications.</li>
                                <li>To display application status and send in-app notifications about it.</li>
                                <li>To record and display disbursement transactions, including checking a
                                    disbursement's transaction hash against the blockchain network before marking
                                    it verified.</li>
                                <li>To convert between ETH and PHP for display, using a live public exchange-rate
                                    lookup (see Section 5).</li>
                            </ul>
                            <p>Data is not sold. It is not used for advertising. It is not shared with anyone
                                outside what's described in this policy.</p>

                            <h2 style="font-size: 1.3rem;">4. Uploaded Files</h2>
                            <p>Requirement PDFs, profile photos, and report-card/grade images are stored outside the
                                public web root and are only ever served back through an access-controlled route
                                that checks you are either the student who owns the file or a provider organization
                                that student has actually applied to. They are not directly browsable or
                                guessable-by-filename.</p>

                            <h2 style="font-size: 1.3rem;">5. Third-Party Services</h2>
                            <p>The Service loads some resources from, or makes requests to, third parties. Their own
                                privacy practices apply to data that passes through them:</p>
                            <ul>
                                <li><strong>CoinGecko API</strong> &mdash; queried server-side for the current
                                    ETH/PHP exchange rate. No personal data is sent to CoinGecko.</li>
                                <li><strong>An Ethereum Sepolia testnet RPC endpoint</strong> &mdash; used to send
                                    and verify disbursement transactions. Only wallet addresses and transaction data
                                    are involved, which are public blockchain data by nature.</li>
                                <li><strong>Content-delivery networks</strong> (Google Fonts, Font Awesome, jQuery,
                                    Bootstrap, jsDelivr for SweetAlert2 and ethers.js) &mdash; used to load fonts,
                                    icons, and scripts. Loading a resource from a CDN can expose your IP address and
                                    browser information to that CDN, as with any website that uses one.</li>
                            </ul>

                            <h2 style="font-size: 1.3rem;">6. Data Retention &amp; Deletion</h2>
                            <p>This demo does not currently include a self-service "delete my account" feature.
                                Account and application data is retained until manually removed by a project
                                administrator. If you used real information by mistake, or want your test data
                                removed, email <a href="mailto:anjhonhulguin7@gmail.com">anjhonhulguin7@gmail.com</a>
                                with the account email and we will delete the record. Blockchain transaction data,
                                once sent, is recorded on the public Sepolia testnet ledger and cannot be deleted or
                                altered by anyone &mdash; this is an inherent property of public blockchains, which
                                is exactly why no personal data is ever put there.</p>

                            <h2 style="font-size: 1.3rem;">7. Your Rights</h2>
                            <p>Consistent with data-subject rights described under RA 10173 (again, as a design
                                reference rather than a compliance claim), you may email
                                <a href="mailto:anjhonhulguin7@gmail.com">anjhonhulguin7@gmail.com</a> to request:</p>
                            <ul>
                                <li>A copy of the personal data associated with your account.</li>
                                <li>Correction of inaccurate data.</li>
                                <li>Deletion of your account and associated data (excluding any already-sent public
                                    blockchain transaction, which cannot be deleted by design).</li>
                            </ul>

                            <h2 style="font-size: 1.3rem;">8. Security Measures</h2>
                            <p>Passwords are hashed (never stored in plain text). Uploaded files are kept outside
                                the public web root behind ownership checks. Session cookies are marked HTTP-only.
                                Role-based route access controls which account type can reach which pages. No
                                system is perfectly secure, and this is a student project, not an audited
                                production system &mdash; do not rely on it to protect real sensitive data.</p>

                            <h2 style="font-size: 1.3rem;">9. Children's Data</h2>
                            <p>Account creation on this Service requires the user to be at least 18 years old (see
                                the <a href="/terms">Terms &amp; Conditions</a>). The Service does not knowingly
                                collect data from anyone under 18, and does not currently support a parent/guardian
                                consent workflow for minors.</p>

                            <h2 style="font-size: 1.3rem;">10. Changes to This Policy</h2>
                            <p>Since this is an actively developed academic project, this policy may change as
                                features change. The "Last updated" date at the top reflects the latest revision.</p>

                            <h2 style="font-size: 1.3rem;">11. Contact</h2>
                            <p>Questions about this policy or your data:
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
