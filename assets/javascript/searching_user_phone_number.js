$(document).ready(function(){

    // inisialisasi variable timer
    var x_timer;

    // jquery ketika input text user_phone_number selesai diketik maka akan mengecek kedalam database
    $('#user_phone_number').on("change click keyup", function(){
    
        // instansiasi variable timer
        clearTimeout(x_timer);

        // mengambil nilai dari input text user_phone_number
        var user_phone_number = $(this).val();

        //regular expression for checking phone number
        var regex_phone_number = /(\+62 ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+/gm;
            
        // base_url versi javascript
        var base_url = window.location.origin + '/MarketPlace.id/index.php/User/user_phone_number_check_for_jquery';

        var regexResult = regex_phone_number.test(user_phone_number);
        // console.log(regex_phone_number.test(user_phone_number));

        // kondisi jika input text user_phone_number kosong
        if (user_phone_number == '') {

            // menambahkan class css is-invalid kedalam input text user_phone_number
            $('#user_phone_number').addClass('is-invalid');

            // maka akan menampilkan respon 
            $('#user_phone_number_validation_respon')
            .html('Nomer handphone belum diisi')
            .css({'color' : 'red', 'font-size' : '12px'});

        // // kondisi jika input text user_phone_number tidak kosong
        } else if(regexResult == true){

            // maka sistem akan menunggu 2 detik untuk mengecek dari database
            x_timer = setTimeout(function(){
            
                $.ajax({
                    url: base_url,
                    type: 'POST',
                    data: {user_phone_number: user_phone_number},

                    // proses loading data
                    success: function(data) {
                    
                        // fungsi loading
                        setTimeout(function(){

                            // kondisi jika respon sama dengan 1 (URL sudah ada),
                            if (data == 1) {

                                // console.log(true);

                                // menambahkan class css is-invalid kedalam input text user_phone_number
                                $('#user_phone_number').addClass('is-invalid');

                                // maka akan menampilkan respon sudah ada
                                $('#user_phone_number_validation_respon')
                                    .html('Nomer handphone sudah pernah digunakan. Silahkan gunakan Nomer lain.')
                                    .css({'color' : 'red', 'font-size' : '12px'});

                            // kondisi jika respon sama dengan 0 (nomor handphone belum ada),
                            }else{

                                // menghilangkan class css is-invalid kedalam input text user_phone_number
                                $('#user_phone_number').removeClass('is-invalid');

                                // menghilangkan css dan html dari user_phone_number_respon
                                $('#user_phone_number_validation_respon').empty();

                                // console.log(false);
                            }

                        // ini bracket setTimeout
                        }, 500);
                    
                    // ini bracket success   
                    }

                // ini bracket ajax
                });
                
            // ini bracket setTimeout x_timer
            }, 500);
        
        } else {

            // menambahkan class css is-invalid kedalam input text user_phone_number
            $('#user_phone_number').addClass('is-invalid');

            // maka akan menampilkan respon sudah ada
            $('#user_phone_number_validation_respon')
                .html('Nomer handphone sudah pernah digunakan. Silahkan gunakan Nomer lain.')
                .css({'color' : 'red', 'font-size' : '12px'});


        // ini bracket else
        }

    // ini bracket jquery subdomain
    });
    
});
