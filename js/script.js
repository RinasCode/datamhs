// jQuery(document)
$(document).ready(function(){
    
    $('#tombol-cari').hide();

    $('#keyword').on('keyup', function(){
        $('.loader').show();
        
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data){

            $('#container').html(data);
            $('.loader').hide(); 
        });
    });
});