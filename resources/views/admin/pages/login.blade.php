{{-- -----------------------login page -------------------- --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('admin.partial.subheader')

</head>

{{-- <style>
    .rotate {
        transform: rotate(180deg);
    }

    .form-floating input {
        height: 40px !important;
        padding-bottom: 2rem !important;
        font-size: 1rem !important;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

    }

    .shadoww {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .form-floating input[type="email"] {
        color: red;
        padding-left: 100px;
        padding-bottom: 1rem;

    }

    .form-floating input[type="password"] {
       
        color: red;
        padding-left: 100px;


    }

    .form-floating label {

        display: flex;
        align-items: center;
        justify-content: center;
        height: 25px !important;
        border-right: 1px #ff89b0 solid;
        padding-bottom: 2rem;
        padding: 1.5rem !important;
    }

    .imgg {
        height: 95vh !important;
        width: 50vw;
        background-color: #F2EDF3;

    }

    .back {
        background-color: #F2EDF3;
    }

    .imgbox {
        display: flex;
        align-items: center;
        height: 95vh;
        width: 100%;
        margin-right: 9rem;


    }

    .imgbox img {
        height: 100%;
        width: 100%;
    }

    @media only screen and (max-width: 700px) {
        .imgg {
            display: none;
        }
    }
</style> --}}

<body>
    <!-- Login 9 - Bootstrap Brain Component -->
    <section style="min-height:100vh;" class="py-3 py-md-5  back ">
        <div class="container ">
            <div class="row gy-2 align-items-center ">
                <div class="col-12 imgg  col-md-6  col-xl-6 ">
                    <div class="d-flex  justify-content-center">
                        <div class="col-12 imgbox col-xl-9">
                            <img class="img-fluid rounded mb-4"
                                src="{{ asset('AdminAssets/assets/dist/assets/images/illustration.svg') }}"
                                alt="BootstrapBrain Logo" />
                            <div class="text-endx">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="card border-0  rounded-4">
                        <div class="card-body back p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="mb-2 ">
                                        <img src="{{ asset('AdminAssets/assets/dist/assets/images/logoimage.svg') }}"
                                            alt="" width="80">
                                    </div>
                                    <h3>United Ekta Group</h3>
                                    <div class="d-flex justify-content-between align-it">
                                        <img class="rotate"
                                            src="{{ asset('AdminAssets/assets/dist/assets/images/linegradient.svg') }}"
                                            alt="">
                                        <h4 class="mt-2">Log in now</h4>
                                        <img src="{{ asset('AdminAssets/assets/dist/assets/images/linegradient.svg') }}"
                                            alt="">
                                    </div>
                                    <div style="color: red">
                                        @include('admin.message')
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('authenticate') }}" method="post">
                                @csrf
                                <div class="row gy-3 overflow-hidden ">
                                    <div class="col-12 mt-3">
                                        <div class="form-floating mb-2">
                                            <label for="email" class="form-label ms-2 mt-2 p-2">
                                                <img src="{{ asset('AdminAssets/assets/dist/assets/images/mailicon.svg') }}"
                                                    height="20px" width="20px" alt="">
                                            </label>
                                            <input type="email" class="form-control fs-6 pb-0" name="email" id="email"
                                                value="{{ old('email') }}" placeholder="name@example.com" required " />
                                            @error('email')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-floating mb-2">
                                            <label for="password" class="form-label  mt-2 ms-2 p-1">
                                                <img src="{{ asset('AdminAssets/assets/dist/assets/images/lockpassword.svg') }}"
                                                    height="20px" width="20px" alt="">
                                            </label>
                                            <input type="password" class="form-control fs-6 pb-0" name="password" id="password"
                                                value="" placeholder="Password" required />
                                            @error('password')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button style="background-color: #e91e63;"
                                                class="shadow fw-bold btn btn-lg p-2 text-white" type="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12">
                                    <div
                                        class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-2">
                                        <a class="text-decoration-none text-black" href="#!">Forgot password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-3 mb-2 text-center">
                                        By continuing, you agree to our <strong class="text-decoration-underline"> Terms
                                            of Service, Privacy </strong>
                                        <strong class="text-decoration-underline">Policy,
                                            Content
                                            Policy</strong>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
