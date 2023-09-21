@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Halo
                </div>
                <div class="card-body">
                    Selamat datang di Larapus.
                    <tbody>
                        <tr>
                            <td class="text-muted">Buku Di Pinjam</td>
                            <td>
                                @if ($borrowLogs->count() == 0)
                                    Tidak ada Buku Di Pinjam
                                @endif
                                <ul>
                                    @foreach ($borrowLogs as $borrowLog)
                                        {{-- <li>{{ $borrowLog->book->title}}</li> --}}
                                        <li>
                                            {!! Form::open([
                                                'url' => route('member.books.return', $borrowLog->book_id),
                                                'method' => 'put',
                                                'class' => 'form-inline js-confirm',
                                                'data-confirm' => "Anda yakin hendak mengembalikan " . $borrowLog->book->title . "?"] ) !!}
                                                    {{ $borrowLog->book->title }}
                                                    {!! Form::submit('Kembalikan', ['class'=>'btn btn-xs btn-default']) !!}
                                            {!! Form::close() !!}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Dashboard</h2>
                    </div>
                    <div class="panel-body">
                        Selamat datang di Larapus.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


