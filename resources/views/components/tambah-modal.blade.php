<div class="modal fade" id="tambah-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukan nama anda...">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="col-form-label">Jenis Kelamin:</label>
                        <select type="text" class="form-control" id="jk">
                            <option selected disabled>-- pilih jenis kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jk"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Masukan email anda...">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="alamat" placeholder="Masukan alamat anda"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-store">Submit</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    //csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //btn store
   $('#btn-store').click(function(e){
        e.preventDefault();

        let nama = $('#nama').val();
        let jk = $('#jk').val();
        let email = $('#email').val();
        let alamat = $('#alamat').val();

        $.ajax({
            url: "{{ route('home-store') }}",
            type: 'post',
            cache:false,
            data : {
                'nama' : nama,
                'jk': jk,
                'email':email,
                'alamat': alamat,
            },
            success:function(response){
                Swal.fire({
                    title: 'Success',
                    text: "Berhasil Ditambahkan",
                    icon: 'success',
                    timer: 2000
                });

                var oTable = $('#tbl-list').dataTable();
                oTable.fnDraw(false);
                $('#tambah-modal').modal('hide');
           
            },
            error:function(error){
                console.log(error)
            

            }
        });
        
    })
  
</script>
@endpush