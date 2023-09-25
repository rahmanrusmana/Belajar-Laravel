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
                                        Masukkan Informasi Login Anda
                                    </h4>
                                </div>
                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                                @endif

                                {!! Form::open(['url'=>'/password/email', 'class'=>'form-horizontal'])!!}

                                <div class="row mb-3">
                                    {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-4 control-label']) !!}
                                    <div class="w-full">
                                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="mb-12 pb-1 pt-1 text-center">
                                    <button
                                        class="mb-3 inline-block w-full rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_rgba(0,0,0,0.2)] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(0,0,0,0.1),0_4px_18px_0_rgba(0,0,0,0.2)]"
                                        type="submit" data-te-ripple-init data-te-ripple-color="light"
                                        style=" background: linear-gradient(to right, #a600ff, #7200b0, #4b0073, #000000);">
                                        Kirim link reset password
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <!-- Right column container with background and description-->
                        <div class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none"
                            style="background: linear-gradient(to right,  #a600ff, #7200b0, #4b0073, #000000)">
                            <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                                <h4 class="mb-6 text-xl font-semibold">
                                    Selamat Datang Kembali ke Platform Kami
                                </h4>
                                <p class="text-sm">
                                    Kami tahu waktu Anda berharga, jadi kami akan membuat proses login secepat dan
                                    sesederhana mungkin. Masukkan data login Anda untuk melanjutkan ke pengalaman kami.
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