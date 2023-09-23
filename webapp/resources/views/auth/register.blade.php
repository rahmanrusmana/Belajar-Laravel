@extends('layouts.app')

@section('content')
<section class="gradient-form h-full">
    <div class="container">
        <div class=" flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
            <div class="w-full">
                <div class="block rounded-lg bg-neutral-200 dark:bg-neutral-700 shadow-lg dark:bg-neutral-800">
                    <div class="g-0 lg:flex lg:flex-wrap">
                        <!-- Left column container-->
                        <div class="px-4 md:px-0 lg:w-6/12">
                            <div class="md:mx-6 md:p-12">
                                <!--Logo-->
                                <div class="text-center">
                                    <img class="mx-auto w-48"
                                        src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                        alt="logo" />
                                    <h4 class="mb-12 mt-1 pb-1 text-xl font-semibold">
                                        Daftar Untuk Akses Penuh
                                    </h4>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="w-full">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name"
                                                placeholder="Nama">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="w-full">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Alamat Email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="w-full">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="w-full">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Konfirmasi Password">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="w-full">
                                            <div
                                                class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                <div class="col-md-offset-4 col-md-6">
                                                    {!! app('captcha')->display() !!}
                                                    {!! $errors->first('g-recaptcha-response', '<p class="help-block">
                                                        :message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-12 pb-1 pt-1 text-center">
                                        <button
                                            class="mb-3 inline-block w-full rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_rgba(0,0,0,0.2)] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)]"
                                            type="submit" data-te-ripple-init data-te-ripple-color="light"
                                            style=" background: linear-gradient(to right, #a600ff, #7200b0, #4b0073, #000000);">
                                            Register
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <!-- Right column container with background and description-->
                        <div class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none"
                            style="background: linear-gradient(to right,  #a600ff, #7200b0, #4b0073, #000000)">
                            <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                                <h4 class="mb-6 text-xl font-semibold">
                                    Buat Akun Anda dan Jelajahi Dunia Kami
                                </h4>
                                <p class="text-sm">
                                    Kami merasa sangat senang menyambut Anda di dalam dunia kami yang penuh dengan
                                    peluang dan pengalaman. Dengan membuat akun pribadi, Anda akan membuka pintu menuju
                                    layanan, konten, dan fitur-fitur eksklusif kami. Yuk, mari kita mulai perjalanan ini
                                    bersama dengan mengisi formulir pendaftaran di bawah ini.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
@endsection