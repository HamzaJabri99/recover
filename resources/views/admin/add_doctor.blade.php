<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates,
                                and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/corona-free/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                <div class="container w-50 my-5 form-container">
                    @if(session()->has('success'))
                    <div class="alert alert-info my-4 d-flex align-items-center">
                        {{ session()->get('success') }}

                        <button class="close markX mx-3" data-bs-dismiss="alert">X</button>

                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger my-4">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ url('store_doctor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Doctor's Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" class="form-control" id="phone" pattern="\d{10}" name="phone">
                        </div>
                        <div class="mb-4">
                            <label for="speciality" class="form-label">Speciality</label>
                            <select class="w-25" name="speciality" id="speciality">
                                <option value="" disabled selected>--Select--</option>
                                <option value="skin">Skin</option>
                                <option value="heart">Heart</option>
                                <option value="eye">Eye</option>
                                <option value="nose">Nose</option>
                                <option value="">Muscles</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="room">Room No</label>
                            <input type="text" class="form-control" id="room" name="room">
                        </div>
                        <div class="mb-4">
                            <label for="image">Doctor's image</label>
                            <input type="file" class="form-file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn w-20 btn-md p-2 btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.scripts')
</body>

</html>