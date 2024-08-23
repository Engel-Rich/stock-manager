@extends('base')

@section('register')
    <div class="container min-vh-100 min-vw-100  align-items-center justify-content-center">
        <div class="register-photo">
            <div class="form-container">
                <div class="image-holder"></div>
                <form method="post"  action="{{route('auth.store')}}">
                    @csrf
                    <h2 class="text-center">Inscription </h2>
                    @error('error')
                    <div class="m-3 text-danger" >
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold" for="email">Adresse email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email"  value="{{ old('email') }}">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold" for="name">Nom </label>
                            <input class="form-control" type="text" name="name" placeholder="Nom" required value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label fw-bold" for="last_name">Nom d'utilisateur</label>
                            <input class="form-control" type="text" name="user_name" placeholder="User name" required value="{{ old('user_name') }}" >
                        </div>
                    </div>                   
                    <div class="mb-3 ">
                        <div class="form-group">
                            <label class="form-label fw-bold" for="passwprd">Mot de passe</label>
                            <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="form-check"><label class="form-check-label"><input class="form-check-input"
                                    type="checkbox">I agree to the license terms.</label></div>
                    </div> --}}

                    <div class="my-3">
                        <div class="form-group">
                            <button class="btn btn-outline-primary" type="submit">Sign Up</button>
                        </div>
                    </div>

                    <div class="already">Vous avez déjâ un compte? <a href="{{route('auth.login')}}"><strong class="lien"> Connectez
                                vous</strong></a>.</div>
            </div>
            </form>
        </div>
    </div>    
@endsection


{{-- section de style CSS  --}}

@section('register-style')
    <style>
        .register-photo {
            background: #f1f7fc;
            padding: 80px 0;
        }

        .register-photo .image-holder {
            display: table-cell;
            width: auto;
            background: url("https://i0.wp.com/thierrycausera.fr/wp-content/uploads/2022/12/Logo-Quincaillerie-@4x.png?w=1726&ssl=1");
            background-size: contain;
            background-repeat: no-repeat;
            background-color: #ffffff;
            background-position: center;
        }

        .register-photo .form-container {
            display: table;
            /* max-width: 1200px; */
            width: 70%;
            margin: 0 auto;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .register-photo form {
            display: table-cell;
            width: 600px;
            background-color: #ffffff;
            padding: 40px 60px;
            color: #505e6c;
        }

        @media (max-width:991px) {
            .register-photo form {
                padding: 40px;
            }
        }

        .register-photo form h2 {
            font-size: 24px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .register-photo form .form-control {
            background: #f7f9fc;
            border: none;
            /* border-bottom: 1px solid #dfe7f1; */
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            text-indent: 6px;
            height: 40px;
        }

        .register-photo form .form-check {
            font-size: 13px;
            line-height: 20px;
        }

        .register-photo form .btn-primary {
            /* background: #f4476b; */
            border: none;
            border-radius: 4px;
            padding: 11px;
            box-shadow: none;
            margin-top: 35px;
            text-shadow: none;
            outline: none !important;
        }

        .register-photo form .btn-primary:hover,
        .register-photo form .btn-primary:active {
            background: #eb3b60;
        }

        .register-photo form .btn-primary:active {
            transform: translateY(1px);
        }

        .register-photo form .already {
            display: block;
            text-align: center;
            font-size: 12px;
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none;
        }

        .register-photo form .already .lien {
            font-weight: bold;
            text-decoration: none;
            color: #6f7a85;
            opacity: 0.93;
        }
    </style>
@endsection
