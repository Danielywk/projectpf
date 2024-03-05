$(document).ready(function(){
    var discos = $('#tabla_resultado');
   // var disco_sel = $('#disco_sel');

    //Ejecutar accion al cambiar de opcion en el select de las bandas
    $('#departamentos').change(function(){
      var banda_id = $(this).val(); //obtener el id seleccionado

      if(banda_id !== ''){ //verificar haber seleccionado una opcion valida

        /*Inicio de llamada ajax*/
        $.ajax({
          data: {banda_id:banda_id}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
          dataType: 'html', //tipo de datos que esperamos de regreso
          type: 'POST', //mandar variables como post o get
          url: '../php/consulta.php' //url que recibe las variables
        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

          discos.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
          discos.prop('disabled', false); //habilitar el select
        });
        /*fin de llamada ajax*/

      }else{ //en caso de seleccionar una opcion no valida
        discos.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
        discos.prop('disabled', true); //deshabilitar el select
      }    
    });

  });