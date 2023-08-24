@extends('admin.adminDashboard')
@section('admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <img class="wd-100 rounded-circle"
                                src="{{ (!empty($profile_data->photo)) ? url('upload/admin/images/'. $profile_data->photo) : url('admin/images/noImage.jpg') }}" alt="profile">
                                <span class="h4 ms-3">{{ $profile_data->name }}</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">User Name:</label>
                            <p class="text-muted">{{ $profile_data->username }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $profile_data->phone }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profile_data->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{ $profile_data->address }}</p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Update Your Profile</h6>

                            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data" class="forms-sample">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" autocomplete="off" value="{{ $profile_data->username }}">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{ $profile_data->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" autocomplete="off" value="{{ $profile_data->email }}">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" id="phone" autocomplete="off" value="{{ $profile_data->phone }}">
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" autocomplete="off" value="{{ $profile_data->address }}">
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input class="form-control" type="file" name="photo" id="imageFile">
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label"></label>
                                    <img id="showImage" class="wd-80 rounded-circle"
                                src="{{ (!empty($profile_data->photo)) ? url('upload/admin/images/'. $profile_data->photo) : url('admin/images/noImage.jpg') }}" alt="profile">
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>

    <script type="text/javascript">

    $(document).ready(function(){
        $('#imageFile').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    </script>
@endsection
