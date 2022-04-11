// Mostra imagem ao clicar

$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
/* filtra na galeria
    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
    */
  })
  
// ****************************************************************************


// input File
   $(document).ready(function() {
    $(".btn-file").fileinput({
        showPreview: false,
        showUpload: false,
        elErrorContainer: '#kartik-file-errors',
        allowedFileExtensions: ["jpg", "png", "gif"]
        //uploadUrl: '/site/file-upload-single'
    });
});

//*****************************************************************************

// Cria um novo elemento
$(function(){
    $("#btn-imagem").on('click',function(){
        $("#imagem").append(" <div class='col-1'> <input id='' type='file' value='"+'/help/public/imagens/facisb_logo.png'+"' name='arquivo[]' placeholder='Photo'"+' multiple'+"></div>");
    });

});

//*****************************************************************************

/* Auto Load Imagem Pessoa */
$(function(){
  $("#profileImage").click(function(e) {
    $("#imageUpload").click();
  });
  
  function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#profileImage').attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
  }
  
  $("#imageUpload").change(function(){
    fasterPreview( this );
  });
  
});

//************************************data Table Geral*****************************************

/* Faz funcionar o Data table*/
// //cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json
$(function () {
  var table = $('#geral').DataTable( {
    
    "language": {
      "url": "../traducao-datatable.json",
  },
      //rowReorder: {
      //    selector: 'td:nth-child(2)'
      //},
      "responsive": true,
      "buttons": ['copy', 'excel', 'pdf'],
      // faz aparecer os buttons
      //dom: 'Bfrtip',
  } );
  table
    //.order( [ 2, 'asc' ] )
    .draw();
});

//********************************** Fim DataTable Geral ********************************************

//************************************* DataTable List-chamados****************************************

/* Faz funcionar o Data table*/
// //cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json
$(function () {
  var table = $('#chamados').DataTable( {
    
    "language": {
      "url": "../traducao-datatable.json",
  },
      //rowReorder: {
      //    selector: 'td:nth-child(2)'
      //},
      "responsive": true,
      "buttons": ['copy', 'excel', 'pdf'],
      // faz aparecer os buttons
      //dom: 'Bfrtip',
  } );
  table
    //.order( [ 7, 'asc' ] )
    .draw();
});

//********************************** Fim DataTable List-chamados *****************************

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  $(function() {
   
    //login mask 000.000.00-00
  $('#login').inputmask('###.###.###-##', { 'placeholder': '000.000.000-00' })
  //CPF mask 000.000.00-00
  $('#cpf').inputmask('###.###.###-##', { 'placeholder': '000.000.000-00' })
  //CEP mask 00.000-000
  $('#cep').inputmask('##.###-###', { 'placeholder': '00.000-000' })
  //Datemask dd/mm/yyyy
  $('#tel').inputmask('(##)#####-####', { 'placeholder': '(##)#####-####' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()
});
  //Date picker
  $('#reservationdate').datetimepicker({
      format: 'L'
  });

  //Date and time picker
  $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )

  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  })

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })

})
/*
// BS-Stepper Init
document.addEventListener('DOMContentLoaded', function () {
window.stepper = new Stepper(document.querySelector('.bs-stepper'))
})

// DropzoneJS Demo Code Start
//Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
//var previewNode = document.querySelector("#template")
//previewNode.id = ""
//var previewTemplate = previewNode.parentNode.innerHTML
//previewNode.parentNode.removeChild(previewNode)

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
url: "/target-url", // Set the url
thumbnailWidth: 80,
thumbnailHeight: 80,
parallelUploads: 20,
//previewTemplate: previewTemplate,
autoQueue: false, // Make sure the files aren't queued until manually added
previewsContainer: "#previews", // Define the container to display the previews
clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
})

myDropzone.on("addedfile", function(file) {
// Hookup the start button
file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
})

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
})

myDropzone.on("sending", function(file) {
// Show the total progress bar when upload starts
document.querySelector("#total-progress").style.opacity = "1"
// And disable the start button
file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
})

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
document.querySelector("#total-progress").style.opacity = "0"
})

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
}
document.querySelector("#actions .cancel").onclick = function() {
myDropzone.removeAllFiles(true)
}
*/
  // DropzoneJS Demo Code End

  
  // Consulta CEP

function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('end').value=("");
  document.getElementById('bairro').value=("");
  // document.getElementById('cidade').value=("");
  //document.getElementById('uf').value=("");
  //document.getElementById('ibge').value=("");
}
  
  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('end').value=(conteudo.logradouro);
    document.getElementById('bairro').value=(conteudo.bairro);
    // document.getElementById('cidade').value=(conteudo.localidade);
    // document.getElementById('uf').value=(conteudo.uf);
    // document.getElementById('ibge').value=(conteudo.ibge);
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      alert("CEP não encontrado.");
      }
  }
  
  function pesquisacep(valor) {
  
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
    
      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;
      
      //Valida o formato do CEP.
      if(validacep.test(cep)) {
      
        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('end').value="...";
        document.getElementById('bairro').value="...";
      // document.getElementById('cidade').value="...";
      // document.getElementById('uf').value="...";
      // document.getElementById('ibge').value="...";
      
        //Cria um elemento javascript.
        var script = document.createElement('script');
      
        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
      
        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);
      
      } //end if.
      else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
      }
    } //end if.
    else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
    }
  };

// CLICK DO BOTÃO
$(function(){  
    $(".view1").click(function(){
        alert("O botão foi clicado.")
    });
});

$(window).bind("beforeunload", function() {
   if ($(".view1").is(":visible")) {
       return "Você não salvou a sua tarefa, gostaria mesmo de sair?";
   }
});

// Função para enviar mensagem via zap-zap
$(function(){
     $(".zap").click(function(){
        //var cpf_cnpj = $(this).val();
        //var prestador = $("input[name='name']");
        //var ccm = $("input[name='ccm']");
        //var tomador = $("input[name='tomador']");
		var contato = '5517996638513';
		var sms = 'Seu chamado foi atendido';
		alert("O botão foi clicado.");
        $.ajax({
            url:'https://v1.utalk.chat/send/udrx67t/?cmd=chat&id=5CBRL36RIL&to='+contato+'@c.us&msg='+sms,
            method: 'GET',
            //data: {cpf_cnpj: cpf_cnpj},
           success: function(result) {
		        $('form').trigger("reset");
		        $('#alert').addClass("alert-success");
		        $('#alert').fadeIn().html(result);
		        setTimeout(function(){
		          $('#alert').fadeOut('Slow');
		        },3000);
		   }
        });
    });
 })
 

	$(function () {

    var form;
    $('#arquivo1').change(function (event) {
        form = new FormData();
        form.append('arquivo1', event.target.files[0]); // para apenas 1 arquivo
        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
    });

    $('#btnEnviar1').click(function () {
        $.ajax({
            url: '/interacao/chamado/', // Url do lado server que vai receber o arquivo
            data: form,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                // utilizar o retorno
                
                console.log(data)
            }
        });
    });
});  

	
	
	
	const show = id => {
	 	const dialog = document.getElementById(id);
		//dialogPolyfill.registerDialog(dialog);
	 	dialog.showModal();
	}
	
	const closeDialog = id => {
	  const dialog = document.getElementById(id);
	  dialog.close();
	}
	
	
	