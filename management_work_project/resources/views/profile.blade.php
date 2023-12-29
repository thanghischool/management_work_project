<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="pages/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="pages/profile.css">
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    @include('layouts.header')
    <div class="page-content page-container" id="page-content" style="margin-top: 80px">
        <div class="padding">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="{{Auth::user()->avatar}}" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <h6 class="f-w-600">{{Auth::user()->name}}</h6>
                                    <p>{{Auth::user()->bio}}</p>
                                    <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->email}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 id="phone-info" class="text-muted f-w-400">{{ Auth::user()->phone }}</h6>
                                            {{-- <input type="text" id="phone-input" class="form-control" style="display: none;">
                                            <button onclick="editField('phone')">Edit Phone</button>
                                            <button id="save-phone" onclick="saveField('phone')" style="display: none;">Save Phone</button> --}}
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Gender</p>
                                            <h6 id="gender-info" class="text-muted f-w-400">{{Auth::user()->gender}}</h6>
                                            {{-- <input type="text" id="gender-input" class="form-control" style="display: none;">
                                            <button onclick="editField('gender')">Edit Gender</button>
                                            <button id="save-gender" onclick="saveField('gender')" style="display: none;">Save Gender</button> --}}
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Birthday</p>
                                            <h6 id="birthday-info" class="text-muted f-w-400">{{Carbon\Carbon::parse(Auth::user()->birthday)->format("d/m/Y")}}</h6>
                                            {{-- <input type="datetime" id="birthday-input" class="form-control" style="display: none;">
                                            <button onclick="editField('birthday')">Edit Birthday</button>
                                            <button id="save-birthday" onclick="saveField('birthday')" style="display: none;">Save Birthday</button> --}}
                                        </div>
                                        <a href="{{route('profileEdit')}}" ><button class="btn btn-info" style="text-decoration: none; font-weight: 600; color:white">Edit</button></a>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>   
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Recent</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->email}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Most Viewed</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->email}}</h6>
                                        </div>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="facebook" data-abc="true"><i
                                                    class="mdi mdi-facebook feather icon-facebook facebook"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="twitter" data-abc="true"><i
                                                    class="mdi mdi-twitter feather icon-twitter twitter"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                data-original-title="instagram" data-abc="true"><i
                                                    class="mdi mdi-instagram feather icon-instagram instagram"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editField(field) {
            document.getElementById(field + '-info').style.display = 'none';
            document.getElementById(field + '-input').style.display = 'block';
            document.querySelector('#' + field + '-input').value = document.querySelector('#' + field + '-info').innerText;
            document.querySelector('#' + field + '-input').focus();
            document.querySelector('#save-' + field).style.display = 'block';
        }

        function saveField(field) {
            var newValue = document.querySelector('#' + field + '-input').value;
            document.querySelector('#' + field + '-info').innerText = newValue;
            document.getElementById(field + '-info').style.display = 'block';
            document.getElementById(field + '-input').style.display = 'none';
            document.getElementById('save-' + field).style.display = 'none';

            // TODO: Update the URL based on your Laravel route
            fetch('/update-profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ [field]: newValue })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
