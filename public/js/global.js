
$.ajaxSetup({
    data: {
        _token: $('meta[name="csrf-token"]').attr('content')
    }
});
function enviarDatos(idproducto,cantidad){

    // var form = $(this);

    alert(cantidad);

    var token = $('#token').val();
    iconocarrito = document.getElementById("iconocarrito"); 
    //  var token = '{{csrf_token()}}';
       var tokenx = $('meta[name="csrf-token"]').attr('content');
        var data={cantidad:cantidad,idproducto:idproducto,_token:token};
    
        // $('#iconocarrito', form).html('<img src="../../images/ajax-loader.gif" />       Please wait...');
    
        $.ajax({
            type: "POST",
            url: "producto/carrito",
            data: data,
            success: function (msg) {
    
                    //alert("Se ha realizado el POST con exito "+msg);
         
                    // $('#iconocarrito').load('layouts/users.blade.php');//actualizas el div
                   // $("#iconocarrito").load("#iconocarrito");
                 
                        //  $("#iconocarrito").load('perfil/users.blade.php');
                         EnviarPrueba();
                 
            
    
            }
        });
    
        
    
    };

    function EnviarPrueba(){

   
       //  document.getElementById("iconocarrito").innerHTML = "<p>Este es el nuevo contenido</p>";
        
 
       $("#iconocarrito").load("inicioajax");
    //    $("#div").load("#div > *");
        
        };
    