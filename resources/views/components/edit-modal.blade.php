<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="edit-nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="edit-nama" placeholder="Masukan nama anda...">
                    </div>
                    <div class="mb-3">
                        <label for="edit-jk" class="col-form-label">Jenis Kelamin:</label>
                        <select type="text" class="form-control" id="edit-jk">
                            <option selected disabled>-- pilih jenis kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="edit-email" placeholder="Masukan email anda...">
                    </div>
                    <div class="mb-3">
                        <label for="edit-alamat" class="col-form-label">Alamat:</label>
                        <textarea class="form-control" id="edit-alamat" placeholder="Masukan alamat anda"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-store-edit">Submit</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    //csrf token
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    
        //btn edit
        $(document).on('click','.edit',function(){
            pegawai_id = $(this).data('id');

            $.ajax({
                url: `/home/pegawai/${pegawai_id}`,
                type: 'GET',
                cache:false,
                dataType:'json',
                success:function(response){
                  
                    // console.log(response.data);
                    $('#id').val(response.data.id);
                    $('#edit-nama').val(response.data.nama);
                    $('#edit-jk').val(response.data.jk);
                    $('#edit-email').val(response.data.email);
                    $('#edit-alamat').val(response.data.alamat);
                    $('#edit-modal').modal('show');
                },
                error:function(error)
                {
                    console.log(error);
                    // menampilkan error

                }
            });
        })

        $(document).on('click','#btn-store-edit',function(e){
            e.preventDefault();

            // define 
            let pegawai_id = $('#id').val();
            let nama = $('#edit-nama').val();
            let jk = $('#edit-jk').val();
            let email = $('#edit-email').val();
            let alamat = $('#edit-alamat').val();

            $.ajax({    
                url: `/home/pegawai/${pegawai_id}`,
                type:'put',
                cache:false,
                data:{
                    'nama':nama,
                    'jk':jk,
                    'email':email,
                    'alamat':alamat
                },
                success:function(response)
                {
                    Swal.fire({
                    title: 'Success',
                    text: "Berhasil Ditambahkan",
                    icon: 'success',
                    timer: 2000
                    });
                    console.log(response);
                    var oTable = $('#tbl-list').dataTable();
                    oTable.fnDraw(false);
                    $('#edit-modal').modal('hide');

                },
                error:function(error)
                {
                    console.log(error)
                }


            });
        })
    })
</script>
@endpush