@push('scripts')
<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '.delete', function () {
            dataId = $(this).data('id');
        
            //show notif
            Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if(result.isConfirmed){
                    console.log('test');

                    $.ajax({
                        url:`/home/pegawai/${dataId}`,
                        type:'delete',
                        cache:false,
                        success:function(response){

                            console.log(response);
                            // show message or notification
                            Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                            });
                            
                            //remove contact from table
                            var oTable = $('#tbl-list').dataTable();
                            oTable.fnDraw(false); //reset
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                }
            });
        });
    });
    
</script>

@endpush