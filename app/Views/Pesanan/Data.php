
<p>
</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="dataAkun">
        <thead>
        <tr>
            
            <th>No</th>
            <th>Nama Kosan</th>
            <th>Nama User</th>
            <th>Tanggal Pesanan</th>
            <th>Status Verifikasi</th> 
            <th>Lama Waktu</th>   
            <th>Action</th>    
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
    function listdataadmin(){
        var table = $('#dataAkun').DataTable({
            "processing":true,
            "serverSide": true,
            "order":[],
            "ajax":{
                "url": "<?= site_url('datatabel_getpesanan')?>",
                "type":"POST"
            },
            //OPTIONAL
            "columDefs":[{
                "targets":0,
                "orderable":false,
            }],
        })
    }
    $(document).ready(function () {
        //$('#dataAdmin').DataTable();
        listdataadmin();
        $('#centangSemua').click(function(e){

            if ($(this).is(':checked')){
                $('.centangNama').prop('checked',true);
            }else {
                $('.centangNama').prop('checked', false);
            }
        });
    });

    function hapus(id_data) {
        Swal.fire({
            title: 'Admin',
            text: `Yakin Untuk Menghapus Data Ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#072DD6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya',
            cancelButtonText: 'tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('Back/Pages/Admin/hapus')?>",
                    data: {
                        id_data:id_data
                    },
                    dataType: "json",
                    success: function(response){
                        if(response.sukses){
                            Swal.fire({
                                icon:'success',
                                title:'Berhasil',
                                text: response.sukses,
                            });
                            dataAdmin();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }


</script>