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
                                    <h3>Student Information</h3>
                                </div>
                            </div>
                            @if (count($data) > 0)
                                <div class="row">
                                    <div class="col-lg-5 mx-auto bg-grey" style="height: 250px;">

                                        @if ($data['profile'])
                                            <img height="250px" src="/profiles/{{ $data['profile'] }}" alt=""
                                                srcset="">
                                        @else
                                            <img class="mx-auto" src="" id="imgProfile" height="250px"
                                                alt="" srcset="">
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row mt-2">
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="firstName">First Name:<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" name="firstName" id=""
                                            class="form-control" value="{{ $data['first_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="middleName">Middle Name:</label>
                                        <input type="text" name="middleName" id="" class="form-control"
                                            value="{{ $data['middle_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="lastName">Last Name:<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" name="lastName" id=""
                                            class="form-control" value="{{ $data['last_name'] }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="address">Address:<span
                                                class="text-danger">*</span></label>
                                        <textarea required name="address" id="" cols="30" rows="4" class="form-control">{{ $data['address'] }}</textarea>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="birthDate">Birth Date:<span
                                                class="text-danger">*</span></label>
                                        <input required type="date" name="birthDate" id=""
                                            class="form-control" value="{{ $data['birth_date'] }}"
                                            max="{{ $maxDate }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="text-dark" for="gender">Gender:<span
                                                class="text-danger">*</span></label>
                                        <div class="row d-flex">
                                            <div class="col-lg-4">
                                                @if ($data['gender'] == 'male')
                                                    <input type="radio" value="male" name="gender"
                                                        id="" style="cursor: pointer" checked>
                                                @else
                                                    <input type="radio" value="male" name="gender"
                                                        id="" style="cursor: pointer">
                                                @endif
                                                <label for="male" class="text-dark">Male</label>
                                            </div>
                                            <div class="col-lg-4">
                                                @if ($data['gender'] == 'female')
                                                    <input type="radio" value="female" name="gender"
                                                        id="" style="cursor: pointer" checked>
                                                @else
                                                    <input type="radio" value="female" name="gender"
                                                        id="" style="cursor: pointer">
                                                @endif
                                                <label for="female" class="text-dark">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="contactNumber" class="text-dark">Contact Number:<span
                                                class="text-danger">*</span> </label>
                                        <input required step="1" type="number" name="contactNumber"
                                            id="" class="form-control"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ $data['contact_number'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="school" class="text-dark">School Attended (Current):<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="school" id=""
                                            class="form-control" value="{{ $data['school'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="schoolDate" class="text-dark">School Date Started:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="date" name="schoolDate" id=""
                                            class="form-control" max="{{ date('Y-m-d', strtotime(now())) }}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <h4>Parents Information</h4>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="fatherFirstName" class="text-dark">Father's First Name:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="fatherFirstName" id=""
                                            class="form-control" value="{{ $data['father_first_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="fatherMiddleName" class="text-dark">Father's Middle Name:</label>
                                        <input type="text" name="fatherMiddleName" id=""
                                            class="form-control" value="{{ $data['father_middle_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="fatherLastName" class="text-dark">Father's Last Name:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="fatherLastName" id=""
                                            class="form-control" value="{{ $data['father_last_name'] }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="fatherBirthDate" class="text-dark">Father's Birth Date:<span
                                                class="text-danger">*</span></label>
                                        <input required type="date" name="fatherBirthDate" id=""
                                            class="form-control" max="{{ date('Y-m-d', strtotime(now())) }}"
                                            value="{{ $data['father_birth_date'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="fatherOccupation" class="text-dark">Father's Occupation:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="fatherOccupation" id=""
                                            class="form-control" value="{{ $data['father_occupation'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="fatherContactNumber" class="text-dark">Father's Contact
                                            Number:<span class="text-danger">*</span> </label>
                                        <input required type="number" name="fatherContactNumber" id=""
                                            class="form-control"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ $data['father_contact_number'] }}">
                                    </div>


                                </div>
                                <br>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="motherFirstName" class="text-dark">Mother's First Name:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="motherFirstName" id=""
                                            class="form-control" value="{{ $data['mother_first_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="motherMiddleName" class="text-dark">Mother's Maiden Middle
                                            Name:</label>
                                        <input type="text" name="motherMiddleName" id=""
                                            class="form-control" value="{{ $data['mother_middle_name'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="motherLastName" class="text-dark">Mother's Maiden Last
                                            Name:<span class="text-danger">*</span> </label>
                                        <input required type="text" name="motherLastName" id=""
                                            class="form-control" value="{{ $data['mother_last_name'] }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="motherBirthDate" class="text-dark">Mother's Birth Date:<span
                                                class="text-danger">*</span></label>
                                        <input required type="date" name="motherBirthDate" id=""
                                            class="form-control" max="{{ date('Y-m-d', strtotime(now())) }}"
                                            value="{{ $data['mother_birth_date'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="motherOccupation" class="text-dark">Mother's Occupation:<span
                                                class="text-danger">*</span> </label>
                                        <input required type="text" name="motherOccupation" id=""
                                            class="form-control" value="{{ $data['mother_occupation'] }}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="motherContactNumber" class="text-dark">Mother's Contact
                                            Number:<span class="text-danger">*</span> </label>
                                        <input required type="number" name="motherContactNumber" id=""
                                            class="form-control"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ $data['mother_contact_number'] }}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <h4>Household Income</h4>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-6">
                                        <label for="monthlyGross" class="text-dark">Household Gross Monthly
                                            Income:<span class="text-danger">*</span> </label>
                                        <input required type="number" step="1" name="monthlyGross"
                                            id="" class="form-control"
                                            value="{{ $data['monthly_gross'] }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="monthlyNet" class="text-dark">Household Net Monthly
                                            Income:<span class="text-danger">*</span> </label>
                                        <input required type="number" step="1" name="monthlyNet"
                                            id="" class="form-control" value="{{ $data['monthly_net'] }}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <h4>Grades</h4>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <img height="250px" src="/grades/{{ $data['grade'] }}" alt="" srcset="">
                                    </div>
                                </div>
                            @else
                                <p class="text-dark">No Information Yet</p>
                            @endif
                            <div class="row mt-3">
                                <div class="col-lg-12">

                                    <button onclick="window.close();" class="btn btn-secondary">Close</button>
                                </div>
                            </div>
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
