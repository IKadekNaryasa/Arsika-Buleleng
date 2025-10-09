<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('ikn_sneat') }}/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>ARSIKA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('ikn_sneat/assets/img/favicon/favicon.ico') }}?v={{ time() }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/config.js"></script>

    <!-- <script src="https://kit.fontawesome.com/9254364d26.js" crossorigin="anonymous"></script> -->
</head>

<body>
    <x-overlay2></x-overlay2>
    @if (session('success'))
    <div
        id="toast"
        class="bs-toast toast toast-placement-ex m-2  position-fixed top-0 end-0 bg-success"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-bs-delay="3000"
        data-bs-autohide="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Success!</div>
            <small>{{ date('l, d F Y') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">{{session('success')}}</div>
    </div>
    @endif

    @if ($errors->any())
    <div
        id="toast"
        class="bs-toast toast toast-placement-ex m-2  position-fixed top-0 end-0 bg-danger"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-bs-delay="5000"
        data-bs-autohide="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Error!</div>
            <small>{{ date('l, d F Y') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <!-- Content -->

    <div class="container-md">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="row justify-content-center py-5">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo -->
                                <div class="app-brand justify-content-center">
                                    <img src="{{ asset('img/arsika.png') }}" alt class="w-px-150 h-auto" />
                                </div>
                                <form id="forgotPasswordForm" class="mb-3" action="{{ route('auth.forgotPassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="{{ old('email')}} "
                                            placeholder="Enter your email"
                                            autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Send Reset Link</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/ui-toasts.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script')
    @if (session('errorFrom') === 'changePassword')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("changePasswordModal"));
            myModal.show();
        });
    </script>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastEl = document.getElementById("toast");
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
    <script>
        const bidangForm = document.getElementById('forgotPasswordForm');

        bidangForm.addEventListener('submit', function(e) {
            loadingOverlay.classList.remove('d-none');
            bidangForm.classList.add('form-disabled');
            submitBtn.disabled = true;
            submitText.textContent = 'Mengirim link reset password, mohon tunggu...';
            submitSpinner.classList.remove('d-none');
        });
    </script>
</body>

</html>