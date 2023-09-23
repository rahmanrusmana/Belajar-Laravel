@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                    <li class="text-sm">
                        <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{ url('/home') }}">
                            <svg class="h-6 w-6 text-black mr-2" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="13" r="2" />
                                <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                                <path d="M6.4 20a9 9 0 1 1 11.2 0Z" />
                            </svg>
                            Dashboard
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm">
                        <a class="flex items-center text-gray-500 hover:text-blue-600" href="{{ url('/admin/books') }}">
                            <svg class="h-6 w-6 text-black" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
                                <line x1="13" y1="8" x2="15" y2="8" />
                                <line x1="13" y1="12" x2="15" y2="12" />
                            </svg>
                            Buku
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                        Ubah Buku
                    </li>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Ubah Buku</h2>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($book, ['url' => route('books.update', $book->id),
                        'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!}
                        @include('books._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection