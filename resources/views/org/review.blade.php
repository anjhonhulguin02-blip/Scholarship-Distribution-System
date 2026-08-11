<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BlockScholar</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.8.69/pdf.min.mjs"></script>

    <style>
        .text-primary {
            color: #d73645 !important;
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: #b8174d;
        }

        .navbar-light .navbar-nav .nav-link {
            padding: 30px 15px;
            color: #000000;
            outline: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-family: "Handlee", cursive;
            font-weight: bold;
            line-height: 1.2;
            color: #000000;
        }

        .btn-primary:not(:disabled):not(.disabled):active,
        .btn-primary:not(:disabled):not(.disabled).active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #b8174d !important;
            border-color: #b8174d !important;
        }

        td {
            color: #000000;
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
                    <a href="/org_home" class="nav-item nav-link ">Home</a>
                    <a href="/org_details" class="nav-item nav-link ">My Details</a>
                    <a href="/org_scholars" class="nav-item nav-link ">Scholarships</a>
                    <a href="/org_applications" class="nav-item nav-link active">Applications</a>
                    <a href="/org_transactions" class="nav-item nav-link">Transactions</a>
                    <a href="/org_notifications" class="nav-item nav-link">Notifications <span
                            class="bg-danger text-white" style="padding: 2px;">{{ $notifCount }}</span> </a>

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
                                    <h3>Review Application</h3>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-4">
                                    <label for="firstName" class="text-dark">Student Name:</label>
                                    <p class="text-dark" id="studentFN">
                                        {{ $data['firstName'] }} {{ $data['middleName'] }} {{ $data['lastName'] }}
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <label for="studentInfo" class="text-dark">Student Information:</label>
                                    <button class="btn btn-success justify-content-center d-flex"
                                        onclick="window.open('/org_review_student?id={{ $data['studentID'] }}','_blank')">
                                        View Full Info
                                    </button>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <h6>Attachments</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <embed style="height: 600px;" class="embed-responsive mt-2" id="pdfViewer"
                                        src="/storage/applications/{{ $data['requirementFile'] }}"
                                        type="application/pdf">
                                </div>
                            </div>
                            <form action="/org_applications" method="post" onsubmit="return false;" id="orgForm">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <label for="remarks">Remarks:<span class="text-danger">*</span> </label>
                                        <textarea required name="remarks" id="remarks" cols="30" rows="10" class="form-control"></textarea>
                                        <input type="hidden" name="studentID" value="{{ $data['studentID'] }}"
                                            id="disbursedStudentID">
                                        <input type="hidden" name="applicationID"
                                            value="{{ $data['applicationID'] }}">
                                        <input type="hidden" name="" id="amountToBeDisbursed" disabled
                                            style="cursor: not-allowed" value="">
                                        <input type="hidden" name="eth" value="" id="disbursedETH">
                                        <input type="hidden" name="transID" value="" id="disbursedTransID">
                                        <input type="hidden" name="thash" value="" id="disbursedThash">
                                        <input type="hidden" name="amount" value="" id="disbursedAmount">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12 d-flex">
                                        <button type="button" class="btn btn-secondary mr-2"
                                            onclick="window.close();">Close</button>
                                        <button type="submit" style="display: none" id="btnApprove"
                                            name="btnApprove" value="yes">Approve</button>
                                        <button type="submit" class="invisible" id="btnApproveWithDisburse"
                                            name="btnApproveWithDisburse" value="yes">Approve</button>
                                        <button type="button" class="btn btn-primary me-2" name="btnHere"
                                            value="yes"
                                            onclick="updateRemarks({{ $data['userID'] }},'{{ $data['paymentAddress'] }}', {{ $data['scholarshipAmount'] }}, {{ $data['studentID'] }});"
                                            data-toggle="modal" data-target="#loadingModal">Approve</button>
                                        <button type="submit" class="btn btn-success ml-2" name="btnUpdateAppl"
                                            value="yes">Update</button>
                                        <button onclick="rejectApp({{ $data['id'] }})" class="btn btn-danger ml-2"
                                            type="button" data-toggle="modal"
                                            data-target="#rejectModal">Reject</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
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
                    <a class="text-white mb-2" href="/org_home"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="/org_details"><i class="fa fa-angle-right mr-2"></i>My
                        Details</a>
                    <a class="text-white mb-2" href="/org_applications"><i
                            class="fa fa-angle-right mr-2"></i>Applications</a>
                    <a class="text-white mb-2" href="/org_transactions"><i
                            class="fa fa-angle-right mr-2"></i>Transactions</a>
                    <a class="text-white mb-2" href="/org_notifications"><i
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

    <div class="modal fade " id="reviewScholarModal" tabindex="-1" role="dialog"
        aria-labelledby="reviewScholarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Review Applicant</h3>
                </div>
                <form id="reviewScholarForm" action="/org_applications" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="color:white !important;">Close</button>
                        <button type="submit" class="btn btn-danger" name="btnDeleteScholar" value="yes"
                            style="color:white !important;">Approved</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="/org_applications" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Reject Application</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>Are You Sure You Want To Reject This Application?</p>
                                        <input type="hidden" id="rid" name="applicationID" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit" name="btnReject" value="yes">Yes,
                            Proceed</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="color:white !important;">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="viewScholarDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="viewScholarDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Requirements</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-dark justify-content-start" id="updateText">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="color:white !important;">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-static" id="loadingModal" tabindex="-1" role="dialog"
        aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h5>Please Wait ...</h5>
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </center>
                                </div>
                                <button class="invisible" id="btnCloseLoading" data-dismiss="modal"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/6.13.4/ethers.umd.min.js"
        integrity="sha512-V3xRGsQMQ8CG4l2gVN44TCDmNY5cdlxbSvejrgmWxcLKHft0Q3XQDbeuJ9aot14mpNuRWGtI//WKraedDGNZ+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        let contractABI = @json($contractABI);
        let contractAddress = `{{ $contractAddress }}`;
        let balance = {{ $myBalance }};
        let phpRate = "{{ $phpRate }}";
        let uid = "{{ $userID }}";
        let pk = `{{ $privateKey }}`;
        let spa = "";
        let sid;
    </script>
    <script src="/js/send2.js"></script>
    <script>
        function reviewApplicant(name, pdf) {
            let studentFN = document.getElementById('studentFN');
            studentFN.innerHTML = name;
            let pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.src = `/storage/applications/${pdf}`;

        }

        function updateRequirements(req) {
            let updateText = document.getElementById('updateText');
            updateText.innerHTML = req;
        }

        function updateRemarks(oid, pa, samount, ssid) {
            let remarks = document.getElementById('remarks');
            remarks.value = "Your Application Is Approved, Please Check Transactions Page";
            // remarks.setAttribute("disabled", "")
            if (balance < samount) {
                console.log("heye");
                let btnCloseLoading = document.getElementById("btnCloseLoading");
                btnCloseLoading.click();
                let orgForm = document.getElementById("orgForm");
                orgForm.removeAttribute("onsubmit");
                let btnApprove = document.getElementById("btnApprove");
                btnApprove.click();
            } else {
                console.log("here");
                spa = pa;
                sid = ssid;
                let amountToBeDisbursed = document.getElementById('amountToBeDisbursed');
                amountToBeDisbursed.value = samount;
                receiveFund(samount, oid, pa, `{{ $rpcURL }}`);
            }
        }

        function rejectApp(appID) {
            let rid = document.getElementById('rid');
            rid.value = appID;
        }
    </script>

    @if (session()->pull('successDeleteScholarship'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully Deleted Scholarship Record',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('successDeleteScholarship') }}
    @endif
    @if (session()->pull('errorDeleteScholarship'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Failed To Delete Scholarship, Please Try Again',
                    showConfirmButton: false,
                    timer: 800
                });
            }, 500);
        </script>
        {{ session()->forget('errorDeleteScholarship') }}
    @endif
</body>

</html>
