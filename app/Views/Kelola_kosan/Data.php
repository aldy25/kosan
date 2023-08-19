<?= form_open('Back/Pages/Admin/hapusbanyak',['class' => 'formhapusbanyak']) ?>
<p>
</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="dataAkun">
        <thead>
        <tr>

            <th>No</th>
            <th>nama_kosan</th>
            <th>alamat</th>
            <th>harga</th>
            <th>status</th> 
            <th>Pemilik Kosan</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?=form_close();?>
<script>
    function listdataadmin(){
        var table = $('#dataAkun').DataTable({
            "processing":true,
            "serverSide": true,
            "order":[],
            "ajax":{
                "url": "<?= site_url('datatabel_getdatakos')?>",
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

    function hapus(id_kosan) {
        Swal.fire({
            title: 'Pemilik',
            text: `Yakin Untuk Menghapus Kosan Ini ?`,
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
                    url: "<?= base_url('Hapus')?>",
                    data: {
                        id_kosan:id_kosan
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