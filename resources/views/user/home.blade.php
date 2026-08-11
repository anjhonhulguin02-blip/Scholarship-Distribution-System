<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Dashboard &mdash; Block Scholar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Student dashboard on Block Scholar.">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="/" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary brand-script">Block Scholar</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="/user_home" class="nav-item nav-link active">Home</a>
                    <a href="/user_details" class="nav-item nav-link">My Details</a>
                    <a href="/user_applications" class="nav-item nav-link">Applications</a>
                    <a href="/user_transactions" class="nav-item nav-link">Transactions</a>
                    <a href="/user_notifications" class="nav-item nav-link">Notifications <span
                            class="bg-success text-white" style="padding: 2px;">{{ $notifCount }}</span> </a>

                </div>
                <a href="/logout" class="btn btn-primary px-4">Logout</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="/img/class-1.jpg" alt="A teacher and students in a classroom, several with their hands raised">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">Learn About Us</span></p>
                    <p>At Block Scholar, we believe that every student deserves a fair chance to achieve their dreams.
                        Our platform uses cutting-edge blockchain technology to create a secure and transparent system
                        for distributing scholarships.
                        We aim to eliminate the barriers and inefficiencies in traditional scholarship programs,
                        ensuring that every deserving student gets the support they need. With Block Scholar, donors and
                        organizations can trust that their contributions are being used as intended, while students can
                        focus on what truly matters—learning and growing.
                        Join us as we revolutionize education funding, one scholarship at a time!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <div class="container-fluid py-5" id="services">
        <div class="container">
            <div class="row">

                <p class="section-title pr-5"><span class="pr-2">Services</span></p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>Blockchain-Recorded Disbursement</h4>
                            <p>
                                When a provider disburses your approved funds, the transfer is sent on the
                                Ethereum Sepolia testnet and checked against the network before being marked
                                verified. Your personal records stay off-chain &mdash; see
                                <a href="/how-it-works#disbursement">how it works</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>Student Application Management</h4>
                            <p>
                                Streamlined application process for students to easily apply for scholarships and track
                                their status in real time.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>Payment Address on File</h4>
                            <p>
                                Provide the payment address where your approved scholarship funds should be sent
                                when you apply.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 ">
                <div class="col-lg-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>Real-Time Notifications</h4>
                            <p>
                                Keep everyone informed with timely updates about application progress, fund allocation,
                                and important deadlines.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>Your Data Kept Off-Chain</h4>
                            <p>
                                Your name, address, documents, and payment details are never written to a public
                                blockchain. They live in an access-controlled database, exactly where personal
                                data belongs.
                            </p>
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
                    <a class="text-white mb-2" href="/user_home"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="/user_details"><i class="fa fa-angle-right mr-2"></i>My
                        Details</a>
                    <a class="text-white mb-2" href="/user_applications"><i
                            class="fa fa-angle-right mr-2"></i>Applications</a>
                    <a class="text-white mb-2" href="/user_transactions"><i
                            class="fa fa-angle-right mr-2"></i>Transactions</a>
                    <a class="text-white mb-2" href="/user_notifications"><i
                            class="fa fa-angle-right mr-2"></i>Notifications</a>
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
    <script>
        function showPassEvent() {
            let editPass = document.getElementById('editPass');
            if (editPass.type === "password") {
                editPass.type = "text";
            } else {
                editPass.type = "password";
            }
        }
    </script>
    @if (session()->pull('successLogin'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Login Successfully',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('successLogin') }}
    @endif
    @if (session()->pull('errorUserCreate'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed To Sign Up, Please Try Again',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('errorUserCreate') }}
    @endif
</body>

</html>
