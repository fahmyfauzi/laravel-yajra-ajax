@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control me-2" name="from-date" placeholder="From date">
                                <input type="text" class="form-control me-2" name="to-date" placeholder="To date">
                                <button class="btn btn-primary btn-sm me-2">Filter</button>
                                <button class="btn btn-light btn-sm me-2">Refresh</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <div class="btn btn-primary btn-sm">Tambah Pegawai</div>
                        </div>
                    </div>


                    {{-- test --}}
                    @foreach ($pegawais as $pegawai)
                    {{ $pegawai->nama }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection