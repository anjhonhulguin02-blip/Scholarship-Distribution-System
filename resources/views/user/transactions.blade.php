<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Block Scholar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bg-grey {
            background-color: #f5f5f5 !important;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary">Block Scholar</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="/user_home" class="nav-item nav-link ">Home</a>
                    <a href="/user_details" class="nav-item nav-link ">My Details</a>
                    <a href="/user_applications" class="nav-item nav-link ">Applications</a>
                    <a href="/user_transactions" class="nav-item nav-link active">Transactions</a>
                    <a href="/user_notifications" class="nav-item nav-link">Notifications <span
                            class="bg-success text-white" style="padding: 2px;">{{ $notifCount }}</span> </a>

                </div>
                <a href="/logout" class="btn btn-primary px-4">Logout</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 style="float: left">Transactions</h3>
                                    <button style="float: right" class="btn btn-primary"
                                        onclick="window.open('https\:\/\/sepolia.etherscan.io/address/{{ $contractAddress }}#internaltx')">Ledger</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table border mb-0">
                                            <thead class="table-dark fw-semibold">
                                                <tr class="align-middle">
                                                    <th class="text-center">
                                                    </th>
                                                    <th>Scholarship Name</th>
                                                    <th class="text-center">Your Payment Address</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Created Date</th>
                                                    <th>Transaction Hash</th>
                                                    <th class="text-center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as $item)
                                                    <tr class="align-middle">
                                                        <td class="text-center"></td>
                                                        <td>
                                                            {{ $item->scholarshipName }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ strlen($item->studentPaymentAddress) >= 10 ? substr($item->studentPaymentAddress, 10) . '...' : $item->studentPaymentAddress }}
                                                        </td>
                                                        <td>
                                                            <b>{{ $item->status }}</b>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ (new DateTime($item->created_at))->setTimezone(new DateTimeZone('Asia/Manila'))->format('Y-m-d h:i A') }}
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success text-white"
                                                                onclick="viewHash('{{ $item->transactionHash }}')">View
                                                                Hash</button>
                                                        </td>
                                                        <td class="text-center"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0"
                    style="font-size: 40px; line-height: 40px;">
                    <span class="text-white">Block Scholar</span>
                </a>
                <p>Experience the future of education funding with Block Scholar—leveraging blockchain technology to
                    deliver transparent, secure, and efficient scholarship solutions.</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Get In Touch</h3>
                <div class="d-flex">
                    <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Address</h5>
                        <p>123 Street, New York, USA</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>info@example.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Phone</h5>
                        <p>+012 345 67890</p>
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
                &copy; <a class="text-primary font-weight-bold" href="#">Block Scholar</a>. All Rights
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
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/mail/jqBootstrapValidation.min.js"></script>
    <script src="/mail/contact.js"></script>

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

        function updateButton() {
            let btnUploadRequirements = document.getElementById('btnUploadRequirements');
            let requireFile = document.getElementById('requireFile');
            let btnClear = document.getElementById('btnClear');
            btnClear.removeAttribute("style");
            if (requireFile) {
                btnUploadRequirements.innerHTML = requireFile.value;
            } else {
                btnUploadRequirements.innerHTML = 'Upload File';
                btnClear.setAttribute("style", "display:none;");
            }

        }

        document.getElementById('scholarship').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex]; // Get the selected option
            const ownerValue = selectedOption.getAttribute('owner'); // Get the 'owner' attribute
            console.log('Owner Attribute Value:', ownerValue);
            if (ownerValue) {
                let ownerID = document.getElementById('ownerID');
                ownerID.value = ownerValue;
            }
        });

        function clearUpload() {
            let btnUploadRequirements = document.getElementById('btnUploadRequirements');
            let requireFile = document.getElementById('requireFile');
            let btnClear = document.getElementById('btnClear');
            requireFile.value = null;
            btnUploadRequirements.innerHTML = 'Upload File';
            btnClear.setAttribute("style", "display:none;");

        }

        function viewHash(txt) {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Hash',
                text: txt,
                showConfirmButton: true,
            });
        }
    </script>
    @if (session()->pull('successApply'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully Applied Scholarship',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('successApply') }}
    @endif
    @if (session()->pull('errorApply'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed To Apply, Please Try Again',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('errorApply') }}
    @endif
    @if (session()->pull('errorExistingApplication'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You Have Existing Application',
                    showConfirmButton: true,
                });
            }, 500);
        </script>
        {{ session()->forget('errorExistingApplication') }}
    @endif
</body>

</html>
