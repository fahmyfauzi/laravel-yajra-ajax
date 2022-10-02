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
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control datepicker" id="from_date"
                                        placeholder="From Date">
                                    <div class="input-group-addon mx-2">to</div>
                                    <input type="text" class="form-control datepicker" id="to_date"
                                        placeholder="To Date">
                                    <button class="btn btn-primary btn-sm me-2 " id="filter">Filter</button>
                                    <button class="btn btn-light btn-sm me-2" id="refresh">Refresh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">

                            <div class="btn btn-primary btn-sm" id="btn-tambah">Tambah Pegawai</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table id="tbl-list" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Created_at</th>
                                        <th width="100px">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('components.tambah-modal')
@include('components.edit-modal')
@include('components.delete-modal')

@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endpush
@push('scripts')
<script>
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
    
    $(document).ready(function(){
       
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      
            $('#tbl-list').DataTable({
            processing:true,
            serverSide:true,
            ajax: "{{ route('home-index') }}",
            columns:[
                {data: 'nama', name: 'nama'},
                {data: 'jk', name: 'jk'},
                {data: 'email', name: 'email'},
                {data: 'alamat', name: 'alamat'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: false},
            ]
        });

        $('#from_date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: "linked",
                autoclose: true
        });
        $('#to_date input').datepicker({
            format: 'mm/dd/yyyy',
            todayBtn: "linked",
                autoclose: true
        });
        $('#to_date').datepicker({
          format: 'dd/mm/yyyy',
            todayBtn: "linked",
            autoclose: true
        });

        $('#filter').click(function(){
            var fromDate = $('#from_date').val()
            var toDate = $('#to_date').val()

            if(fromDate != '' && toDate != '')
            {
                $('#tbl-list').DataTable().destroy();
                load_data(fromDate,toDate)
            }
        })

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#tbl-list').DataTable().destroy();
            load_data();
        })

        $(document).on('click','#btn-tambah',function(){
            $('#tambah-modal').modal('show');
        });
    })
</script>

@endpush