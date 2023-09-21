@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Buku</li>
                </ul>

                <div class="panel panel-default">
                    <div class="panelheading">
                        <h2 class="panel-title">Daftar Buku</h2>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-1">
                                <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah</a>
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('export.books') }}" class="btn btn-primary">Export</a>
                            </div>
                        </div> 
                        <p></p>
                        {!! $html->table(['class' => 'table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection
