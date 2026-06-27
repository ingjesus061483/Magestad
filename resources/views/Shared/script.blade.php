  <!-- Bootstrap core JavaScript-->
    <script src="{{asset('resources/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('resources/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('resources/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('resources/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('resources/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('resources/js/demo/chart-pie-demo.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{url('/js/scripts.js')}}"></script>
        <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.3.4/datatables.min.js" integrity="sha384-mtJ3+H/dkUyvhmcXYSyIZyaeG0TnEkh91c1JwFkrkBLHBv8oQ3lFjUp8xfDan41b" crossorigin="anonymous"></script>
        <script src="{{asset('resources/js/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            var user=$("#user").val();
             $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '&#x3C;Ant',
                nextText: 'Sig&#x3E;',
                currentText: 'Hoy',
                monthNames: ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'],
                monthNamesShort: ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'],
                dayNames: ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'],
                dayNamesShort: ['dom','lun','mar','mié','jue','vie','sáb'],
                dayNamesMin: ['D','L','M','X','J','V','S'],
                weekHeader: 'Sm',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            $.datepicker.setDefaults( $.datepicker.regional['es'] );


            $("#policyclientcount").html({{isset($policyclients)?count($policyclients):0}});
            $("#autorizationclientcount").html({{isset($autorizationsclients)?count($autorizationsclients):0}})
            var policyClients=[];
            var autorizationClients=[];
            var client=$("#client").val();
            var app=$("#info").val()==""?$("#info").val():parseInt($("#info").val())-1;
            var urlBase=$("#base_url").val();
            $(".importer").click(function(){
                $("#filterForm").fadeOut();
                $("#importForm").fadeIn();
            });
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            if($("#occupational_position").val()==1)
            {
                $(".asalariado").fadeOut();
                $("#ingreso").html("INGRESOS *");
                $("#actividad_economica").html("A QUE SE DEDICA*");
            }
            else if($("#occupational_position").val()==2)
            {
                $(".asalariado").fadeIn();
                $("#ingreso").html("SALARIO MENSUAL *");
                $("#actividad_economica").html("CARGO ACTUAL*");
            }
              progressLabel = $( ".progress-label" );
              progressbar = $("#ProgressBar");
            $("#ProgressBar").progressbar({
            classes: {
            "ui-progressbar": "highlight",
            "ui-progressbar-value": "bg-success"
            },
            max:7,
            value:app,
            change: function() {
               var progress=(parseInt( progressbar.progressbar("option", "value" ))+1)/ parseInt( progressbar.progressbar( "option", "max" ));
               progressLabel.text( progress + "%" );
            },
            complete: function() {
                progressLabel.text( "La solicitud ha sido llena. pulsa el boton enviar solicitud para continuar." );
            }
            });

            var city=$('#city_name').autocomplete({
                    select:function(event,ui){
                        $("#city_name").val( ui.item.label );
                        $("#city_id").val( ui.item.value );
                        console.log($("#city_id").val());
                        return false;
                    },
                    focus: function( event, ui ) {
                        $("#city_name").val( ui.item.label );
                        return false;
                    },
                    source: function( request, response )
                    {
                        $.ajax({
                            url: urlBase+"cities/GetcitiesByName/",
                            type: "GET",
                            dataType: "json",
                            data:{
                                name: request.term
                            },
                            success: function( data )
                            {
                                 response(
                                    $.map( data, function( item )
                                    {
                                        return{
                                            label: item.name,
                                            value: item.id,
                                        }
                                 }));
                            }
                        });
                    },
                    minLength: 0,
            }).autocomplete( "instance" );
            if(city!=undefined)
            {
                city._renderItem = function( ul, item ) {
                    return $( "<li>" ).append( "<div style='font-size:10px;padding:5px' >" + item.label + "</div>" )
                                    .appendTo( ul );
                };

            }
            var client_identification=$("#client_identification").autocomplete({
                    select:function(event,ui){
                        $("#client_identification").val( ui.item.label );
                        $("#identification").val( ui.item.value );
                        return false;
                    },
                    focus: function( event, ui ) {
                        $( "#client_identification" ).val( ui.item.label );
                        return false;
                    },
                    source: function( request, response )
                    {
                        $.ajax({
                            url: urlBase+"clients/GetClients",
                            type: "GET",
                            dataType: "json",
                            data:{
                                name: request.term
                            },
                            success: function( data )
                            {
                                 response(
                                    $.map( data, function( item )
                                    {
                                        return{
                                            label: item.name,
                                            value: item.identification,
                                        }
                                 }));
                            }
                        });
                    },
                    minLength: 0,
                }).autocomplete( "instance" );
                console.log(client_identification);
                if(client_identification!=undefined)
                {
                    client_identification._renderItem = function( ul, item ) {
                        return $( "<li>" ).append( "<div style='font-size:10px;padding:5px' ><strong>Identificación:</strong>" + item.value + "<br/><strong>Nombre:</strong>" + item.label + "</div>" )
                                        .appendTo( ul );
                    };
                }
            var newsnesstype=$("#newsness_type").autocomplete({
                    select:function(event,ui){
                        $("#newsness_type").val( ui.item.label );
                        $("#newsness_type_id").val( ui.item.value );
                        return false;
                    },
                    focus: function( event, ui ) {
                        $( "#newsness_type" ).val( ui.item.label );
                        return false;
                    },
                    source: function( request, response )
                    {
                        $.ajax({
                            url: urlBase+"NewnessType/SearchByName/0",

                            type: "GET",
                            dataType: "json",
                            data:
                            {
                                name: request.term
                            },
                            success: function( data )
                            {
                                 response(
                                    $.map( data, function( item )
                                    {
                                        return{
                                            label: item.name,
                                            value: item.id,
                                        }
                                 }));
                            }
                        });
                    },
                    minLength: 0,
                }).autocomplete( "instance" );
            console.log(newsnesstype);
            if(newsnesstype!=undefined)
            {
                newsnesstype._renderItem = function( ul, item ) {
                    return $( "<li>" ).append( "<div style='font-size:10px;padding:5px' >" + item.label + "</div>" )
                                    .appendTo( ul );
                };
            }
            function focus(text)
            {
                alert("focus");
                text.value=' ';
            }
            if( $(".client"))
            {
                $(".client").autocomplete({
                    source: function( request, response )
                    {
                        var bd_client=$('.client').data('bd_client');
                        $.ajax( {
                            url: urlBase+"clients/SearchByName",
                            type: "GET",
                            dataType: "json",
                            data:
                            {
                                bd_client:bd_client,
                                name: request.term
                            },
                            success: function( data )
                            {
                               response(
                                    $.map( data, function( item )
                                    {
                                        return{
                                            label: item.name,
                                            value: item.id,
                                            desc:item.identification
                                        }
                                 }));
                            }
                        });
                    },
                    focus: function( event, ui ) {
                        $( ".client" ).val( ui.item.label );
                        return false;
                    },
                    select: function( event, ui ) {
                        $( ".client" ).val( ui.item.label );
                        $("#client_id").val( ui.item.value );
                        //alert($("#client_id").val());
                        /*$( "#project-description" ).html( ui.item.desc );
                        $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );*/

                        return false;
                    },
                    minLength: 0,
                })
                .autocomplete( "instance" )._renderItem = function( ul, item ) {
                    var html="<div style='font-size:10px;padding:5px' ><strong>Nombre:</strong> " + item.label +
                                                "<br><strong>Identificación:</strong> " + item.desc +  "</div>" ;
                    return $( "<li>" ).append( html )
                                    .appendTo( ul );
                };
            }
            if( $("#errors").length>0 )
            {
                Swal.fire({
                  title: "Se han encontrado los siguientes errores:",
                  icon: "error",
                  html:$("#errors").html(),
                  draggable: true
                });
            }
            if( $("#message").length>0 )
            {
                Swal.fire({
                  title: "Información",
                  icon: "info",
                  html:$("#message").html(),
                  draggable: true
                });
            }
            if($("#seizure"))
            {
                if($("#seizure").is(':checked'))
                {
                    $("#divCompanySeizure").fadeIn();
                }
            }
            if($("#birth_date"))
            {
                if($("#birth_date").val()!='')
                {
                   let age=CalculateAge($("#birth_date").val());
                    $("#age").val(age +" años");
                }
            }
            for(var i=1;i<=app;i++)
            {
                $("#step"+i).removeClass('progtrckr-todo').addClass('progtrckr-done');
            }
            if($(".table"))
            {
                $(".table").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    scrollX: true,
                    "language":
                    {
                        "url": "https://cdn.datatables.net/plug-ins/2.3.4/i18n/es-ES.json"
                    },
                 /*   "columnDefs":
                    [{
                        className: "dt-head-center", targets: [ 0 ]
                    }],      */
                });
            }
            $("#accordionPolicy").accordion({
                collapsible:true,
                heightStyle: "content",
                active:""
            });
            $( "#accordion" ).accordion({
                collapsible:true,
                heightStyle: "content",
                active: app
            });


            function GetRequestLoanById(id)
            {
                if(id==null)
                {
                    url=urlBase+"requestLoan";//"{{url('/requestLoan/')}}";
                }
                else
                {
                    url=urlBase+"requestLoan?id="+id;//"{{url('/requestLoan/')}}/"+id;
                }
                window.location.href=url;
            }
            function GetPolicyBytitle(title)
            {
                url=urlBase+"authorizationPolicies/ShowByTitle/0";//"{{url('/authorizationPolicies/')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    data:{
                        title:title
                    },
                    success: function (result)
                    {
                        console.log(result);
                        var title=getTitle(result);
                        Swal.fire({
                            title: title,
                            imageUrl: urlBase+"ImagenSistema/autorizaciones.png",
                            imageHeight:200,
                            html: "<p style='text-align:justify'>"+result.description+"</p>",
                            draggable: true
                        });
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }
            function getTitle(result)
            {
                var letra=result.title.charAt(0);
                var number=result.title.replace(letra,'');
                var title="";
                switch (letra )
                {
                    case 'P':{
                        title="Política "+number;
                        break;
                    }
                    case'A':{
                        title="Autorización "+number;
                        break;
                    }
                }
                return title;
            }
            function cambiarColor(combo)
            {
                var state_homework_id=combo.value;
                switch(state_homework_id)
                {
                    case '1':
                        combo.style.backgroundColor="rgba(217, 18, 18, 0.8)";
                        combo.style.color="white";
                       // combo.style.fontWeight="bold";
                        break;
                    case '2':
                        combo.style.backgroundColor="rgba(0, 100, 0, 0.8)";
                        combo.style.color="white";
                       // combo.style.fontWeight="bold";
                        break;
                    default:
                        combo.style.backgroundColor="";
                        combo.style.color="black";
                        combo.style.fontWeight="normal";
                        break;
                }
            }
            function cambiarEstadoHomework(id,checkbox){
                Swal.fire({
                    title: "¿Desea cambiar el estado de la tarea?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, continuar",
                    cancelButtonText: "Cancelar"
                    }).then((result) =>
                    {
                        if(result.isConfirmed)
                        {

                              var state_homework_id=checkbox.checked?2:1;
                              var url=urlBase+"homework/changeStateHomework/"+id;//"{{url('/homework/ChangeStateHomework/')}}/"+id;
                              var data={
                                    state_homework_id:state_homework_id,
                                    _token: "{{ csrf_token() }}"
                              };
                              $.ajax({
                                    url: url,
                                    type: "POST",
                                    data:data,
                                    dataType: "json",
                                    success: function (result)
                                    {
                                        Swal.fire({
                                            title: "Información",
                                            icon: "info",
                                            text:result.message,
                                            draggable: true
                                        });

                                        console.log(result.message);
                                        location.reload();
                                    },
                                    error: function (ajaxContext)
                                    {
                                        Swal.fire({
                                            title: "Se han encontrado los siguientes errores:",
                                            icon: "error",
                                            text:ajaxContext.responseText,
                                            draggable: true
                                        });
                                        //alert(ajaxContext.responseText)
                                    }
                            });
                        }
                        else
                        {
                            checkbox.checked=!checkbox.checked;
                        }

                    });

            }
            function cambiarEstadoNewness(id,checkbox){
                Swal.fire({
                    title: "¿Desea cambiar el estado de la novedad?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, continuar",
                    cancelButtonText: "Cancelar"
                    }).then((result) =>
                    {
                        if(result.isConfirmed)
                        {
                            var state_newness_id=checkbox.checked?2:1;
                            var url=urlBase+"Newness/changeStateNewness/"+id;//"{{url('/Newness/ChangeStateNewness/')}}/"+id;
                            var data={
                                state_newness_id:state_newness_id,
                                _token: "{{ csrf_token() }}"
                            };
                            $.ajax({
                                url: url,
                                type: "POST",
                                data:data,
                                dataType: "json",
                                success: function (result)
                                {
                                    Swal.fire({
                                        title: "Información",
                                        icon: "info",
                                        text:result.message,
                                        draggable: true
                                    });
                                    console.log(result.message);
                                    location.reload();
                                },
                                error: function (ajaxContext)
                                {
                                    Swal.fire({
                                        title: "Se han encontrado los siguientes errores:",
                                        icon: "error",
                                        text:ajaxContext.responseText,
                                        draggable: true
                                    });
                                    //alert(ajaxContext.responseText)
                                }
                            });
                        }
                        else
                        {
                            checkbox.checked=!checkbox.checked;
                        }

                    });

            }
            function editarNovedad(id)
            {
                url=urlBase+"Newness/"+id+"/edit";//"{{url('/Newness')}}/"+id+"/edit";
                window.location.href=url;
            }
            function abrirInfopersonal(us ,cli)
            {
                if(us!='')
                {
                    return true;
                }
                else if(cli!='')
                {
                     return false;

                }
                else
                {
                    return true;
                }
            }
            function buttons(panel,button){
                $(panel).find('form').find('button').each(function(index,element){
                    $(element).removeAttr('onclick');
                    console.log(element);
                    if(button!=element)
                    {
                        $(element).removeAttr('onclick')
                        $(element).addClass('btn-dark');
                    }
                });
            }
            function fillArray(client_id,button,policies){
                var state=$(button).data('state');
                var policy=$(button).data('policy');
                policyClient=
                {
                    state_policy_id:state,
                    client_id:client_id,
                    policy_id:policy,
                };
                 policies.push(policyClient);
            }
            function submitautorization(button){
                 var panel=$(button).data('panel');
                var letra=panel.charAt(0);
                var autorizationcount=$(button).data('autorizationcount');
                var client_id= $("#frmClientPolicy #client_id").val();
                buttons("#"+panel,button);
                fillArray(client_id,button,autorizationClients);
                 $("#autorizationclientcount").html(autorizationClients.length);
                 console.log(autorizationClients);
                 console.log(autorizationcount);
                 if(autorizationClients.length==autorizationcount)
                 {
                    $.ajax({
                        url:urlBase+'clientPolicies',
                        type: "POST",
                        dataType: "json",
                        data: {
                            _token:"{{csrf_token()}}",
                            title:letra,
                            client_id:client_id,
                            policyClients:JSON.stringify(autorizationClients),
                        },
                        success: function (result){
                            Swal.fire({
                                title: "Información",
                                icon: "info",
                                text:result.message,
                                draggable: true
                            });
                            var app=result.info==""?result.info:parseInt(result.info);
                            $("#accordion").accordion( "option", "active",app );

                           // window.location.href=urlBase+'clients/create'
                        },
                        error: function (ajaxContext)
                        {
                            var object=JSON.parse(ajaxContext.responseText);
                            console.log(object.errors);

                            Swal.fire({
                                title: "Se han encontrado los siguientes errores:",
                                icon: "error",
                                text:object.message,
                                draggable: true
                            });
                          window.location.reload();
                        //alert(ajaxContext.responseText)
                        }

                    });

                 }
            }
            function download(modul)
            {
                var token="{{csrf_token()}}";
                 var dateStart=  $("#dateStart").val();
                var dateEnd =$("#dateEnd").val();
                var client= $("#client_id").val();
                var newness_type=modul=='Homework'?'': $("#newsness_type_id").val();
                window.location.href=urlBase+modul+"/download/0?_token="+token+
                                                                "&firstdate="+dateStart+
                                                                "&enddate="+dateEnd+
                                                                "&client_id="+client+
                                                                "&newness_type_id="+newness_type
            }
            function submitPolicy(button)
            {
                 var panel=$(button).data('panel');
                var letra=panel.charAt(0);
                var policiesCount=$(button).data('policiescount');
                var client_id= $("#frmClientPolicy #client_id").val();
               buttons("#"+panel,button);
               fillArray(client_id,button,policyClients);
                $("#policyclientcount").html(policyClients.length);
                console.log(policyClients);
                console.log(policiesCount);
                if(policyClients.length==policiesCount)
                {
                    console.log( JSON.stringify(policyClients));
                    $.ajax({
                        url:urlBase+'clientPolicies',
                        type: "POST",
                        dataType: "json",
                        data: {
                            _token:"{{csrf_token()}}",
                            title:letra,
                            client_id:client_id,
                            policyClients:JSON.stringify(policyClients),
                        },
                        success: function (result){
                            Swal.fire({
                                title: "Información",
                                icon: "info",
                                text:result.message,
                                draggable: true
                            });
                            var app=result.info==""?result.info:parseInt(result.info);
                            $("#accordion").accordion( "option", "active",app );

                           // window.location.href=urlBase+'clients/create'
                        },
                        error: function (ajaxContext)
                        {
                            var object=JSON.parse(ajaxContext.responseText);
                            console.log(object.errors);
                            Swal.fire({
                                title: "Se han encontrado los siguientes errores:",
                                icon: "error",
                                text:object.message,
                                draggable: true
                            });
                            window.location.reload();
                        //alert(ajaxContext.responseText)
                        }

                    });
                }
                else{

                }
                //$("#frmClientPolicy #state_policy_id").val(state);
                //$("#frmClientPolicy").submit();
            }
            function viewDocuments(client,document_type)
            {
                var url=urlBase+"documents";
                var data ={
                    client_id:client,
                    document_type_id:document_type
                };
                $.ajax({
                    url: url,
                    type: "GET",
                    data:data,
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        var documents= result.documents;
                        $("#tblDocuments tbody").empty();
                        $.each(documents, function(index, doc)
                        {
                            i=doc.name.indexOf('.')
                            name=doc.name.substring(0,i)

                            let row= '<tr>'+
                                        "<td style='text-align:center'>"+doc.id+'</td>'+
                                        '<td>'+name+'</td>'+
                                         "<td style='text-align:center'>"+
                                            '<a href="'+urlBase+'documents/download/'+doc.id+'" title="Descargar documento" class="btn btn-success btn-sm"><i class="fa-solid fa-download"></i></a>&nbsp; '+
                                            '<form action="'+urlBase+'documents/'+doc.id+'" method="POST" style="display: inline;">'+
                                                '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">'+
                                                '<input type="hidden" name="_method" value="DELETE">'+
                                                '<button type="button" title="Eliminar documento" class="btn btn-danger btn-sm" onclick="validar(this,\'Eliminar documento?\')"><i class="fa-solid fa-trash"></i></button>'+
                                            '</form>'+
                                        '</td>'+
                                    '</tr>';
                            $("#tblDocuments tbody").append(row);
                        });
                        dialogViewDocuments.dialog("open");
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }
            function validar(obj, mensaje)
            {
                console.log(obj.parentElement);
                var frm = obj.parentElement;
                Swal.fire({
                    title: mensaje,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, continuar",
                    cancelButtonText: "Cancelar"
                    }).then((result) =>
                    {
                        if(result.isConfirmed)
                        {
                            frm.submit();
                        }


                    });

            }
            function editarNewnessType(id)
            {
                url=urlBase+"NewnessType/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogNewnessType.dialog("open");
                        $("#frmNewnessType #name").val(result.name);
                        $("#frmNewnessType #description").val(result.description);
                        $("#frmNewnessType").attr('action',urlBase+"NewnessType/"+id);// "{{url('/arls')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmNewnessType").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });

            }
            function editarUser(id)
            {
                      url=urlBase+"users/"+id;//"{{url('/DocumentType')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                       dialogUser. dialog("open");
                        $("#frmUser #name").val(result.name);
                        $("#frmUser #email").val(result.email);
                        $("#frmUser #phone").val(result.phone);
                        $("#frmUser").attr('action',urlBase+"users/"+id);//"{{url('/DocumentType')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmUser").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });

            }
            function editarDocumentType(id)
            {
                url=urlBase+"DocumentType/"+id;//"{{url('/DocumentType')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogDocumentType.dialog("open");
                        $("#frmDocumentType #name").val(result.name);
                        $("#frmDocumentType #description").val(result.description);
                        $("#frmDocumentType").attr('action',urlBase+"DocumentType/"+id);//"{{url('/DocumentType')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmDocumentType").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }

            function dropFilters(client )
            {
                $("#client_name").val('');
                $("#client_id").val('');
                $("#rows_per_page").val('');
                if(!client)
                {
                    $("#dateStart").val('');
                    $("#dateEnd").val('');
                    $("#newsness_type").val('');
                    $("#newsness_type_id").val('');

                }
                else
                {
                    $("#loan_reference").val('');
                }
                $("#frmfilter").submit();
            }

            function editarPolicy(id)
            {
                url=urlBase+"authorizationPolicies/"+id;//"{{url('/authorizationPolicies')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogPolicy.dialog("open");
                        $("#frmPolicy #title").val(result.title);
                        $("#frmPolicy #description").val(result.description);
                        $("#frmPolicy").attr('action',urlBase+"authorizationPolicies/"+id);//"{{url('/authorizationPolicies')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmPolicy").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }
            function editarArl(id)
            {
                url=urlBase+"arls/"+id;//"{{url('/arls')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogArl.dialog("open");
                        $("#frmArl #name").val(result.name);
                        $("#frmArl #description").val(result.description);
                        $("#frmArl").attr('action',urlBase+"arls/"+id);// "{{url('/arls')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmArl").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }
            function myGreeting(etiqueta)
            {
                $("#"+etiqueta).fadeOut();
            }
            function CalculateAge(dateString)
            {
                let hoy = new Date();
                let fechaNacimiento = new Date(dateString);
                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
                if (
                    diferenciaMeses < 0 ||(diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate()))
                {
                    edad--;
                }
                return edad;
            }
            function attach(documentTypeId)
            {
                $("#frmAttach #document_type").val(documentTypeId);
                dialogAttach.dialog("open");

            }

            function loadModule()
            {
                 var ul=$("#searchlist");
                 ul.empty();
                console.log( $("#accordionSidebar").find('li') );
                $("#accordionSidebar").find('li').each(function(index,element){
                    console.log($(element).find('span')[0].innerHTML)
                    if($(element).find('.collapse-inner').length>0&&$(element).find('span')[0].innerHTML!="CONFIGURACION")
                    {
                        console.log($(element).find('.collapse-inner')[0]);
                       var div =$(element).find('.collapse-inner')[0];
                       $(div).find('a').each(function(index1,element1)
                       {
                            console.log(element1.href)

                            ul.append("<li style='list-style-type: none' >"+ element1.outerHTML + '</li>');
                       });
                    }
                });

                console.log(ul)

            }
            function editarEps(id)
            {
                url=urlBase+"eps/"+id;// "{{url('/eps')}}/"+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogEps.dialog("open");
                        $("#frmEps #name").val(result.name);
                        $("#frmEps #description").val(result.description);
                        $("#frmEps").attr('action',urlBase+"eps/"+id);//"{{url('/eps')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmEps").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }


            function editarEventType(id)
            {
                 var url =urlBase+'eventtype/'+id;
                 $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        dialogEventTipe.dialog("open");
                        $("#frmEventTipe #name").val(result.name);
                        $("#frmEventTipe #description").val(result.description);
                        $("#frmEventTipe").attr('action',urlBase+"eventtype/"+id);//"{{url('/eps')}}/"+id);
                        let metodo= '<input type="hidden" name="_method" value="PUT">';
                        $("#frmEventTipe").append(metodo);
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });


            }
            function remark(id)
            {
                //alert(id);
                 var url =urlBase+'homework/'+id;
                 $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        //alert(result.remark)
                        if(result.remark!='')
                        {
                            Swal.fire({
                            title: "Comentario:",
                            icon: "info",
                            html:'<div>'+result.remark+'</div>',
                            draggable: true
                            });

                        }
                        else{
                            Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "warning",
                            text:'No se han encontrado comentarios',
                            draggable: true
                            });

                        }
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });

            }
            function showEvents(button)
            {
                var date =$(button).data('date');
                var event_type=$(button).data('event_type');
                var url=urlBase+'events/0';
                var data={
                    date:date,
                    event_type:event_type
                }

                 $.ajax({
                    url: url,
                    type: "GET",
                    data:data,
                    dataType: "json",
                    success: function (result)
                    {
                        $("#events").html('');
                        console.log(result);
                        var d = new Date(date).toLocaleString("en-US",{
                            year:"numeric",
                            month:"long",
                            day:"numeric"
                        });
                        console.log(d);
                        var title=result.event_type.name;
                        dialogEvent.dialog( "option", "title",  title);
                        dialogEvent.dialog("open");
                        var div='';
                        $.each(result.events, function (index, element){
                            console.log(element)
                                var time=new Date(element.date+" "+element.time);
                                div=div+"<div class ='col-6' style='padding:5px;'>";
                                div=div+"<div class='card'><div class='card-header' style='align-text:center;align-items:center'>  "+element.title  +"</div>";
                                div=div+"<div class='card-body'> <p style='font-size:12px'><strong>Hora:</strong> "+   time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })    +"</p>";
                                div=div+"<div style='font-size:12px; height:200px; overflow: auto;'>"+element.remark +"</div>";
                                div=div+"<div style='padding:5px'>"+
                                    "<button class='btn-sm btn-warning'onclick='editEvent("+element.id+")' title='Editar evento' style='margin-left:10px' >"+
                                    "<i class='fa-solid fa-pencil'></i></button>"+
                                    "<button class='btn-sm btn-danger' onclick=' deleteEvent("+element.id+")' style='margin-left:10px' title='Eliminar evento'>"+
                                    "<i class='fa-solid fa-trash'></i></button>"
                                div=div+"</div></div></div></div>";

                        });
                        $("#events").html(div);
                    },
                    error: function (ajaxContext,status)
                    {
                        console.log( ajaxContext);
                        var error=ajaxContext.responseJSON;
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:error.message,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            }
            function deleteEvent(id)
            {

               var url=urlBase+'events/'+ id
              var  data={
                _method:'delete',
                _token: "{{csrf_token()}}"
              }
                 Swal.fire({
                    title: 'Eliminar evento?',
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, continuar",
                    cancelButtonText: "Cancelar"
                    }).then((result) =>
                    {
                        if(result.isConfirmed)
                        {
                           $.ajax({
                    url: url,
                    type: "post",
                    data:data,
                    dataType: "json",
                    success: function (result)
                    {
                        Swal.fire({
                            title: "Mensaje",
                            icon: "info",
                            text:result.message,
                            draggable: true
                        });
                        window.location.reload()
                    },
                    error: function (ajaxContext,status)
                    {
                        console.log( ajaxContext);
                        var error=ajaxContext.responseJSON;
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:error.message,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });

                        }


                    });


            }
            function editEvent(id){
                var url= urlBase+'events/'+ id+'/edit';
                window.location.href=url;

             }
            function quitarEspacios(text){
                var a= text.value.trim()
                text.value=a
            }
            $("#occupational_position").change(function()
            {
                $('#company_works').val('');
                $('#nit_company_works').val('');
                $('#main_address').val('');
                $('#city').val('');
                $('#state').val('');
                $('#contract_type').val('');
                $('#entry_date').val('');
                $("#company_on_mission").val('');
                $("#nit_company_on_mission").val('');
                $('#address_company_on_mission').val('');
                if(this.value==-1 ||this.value==1 )
                {
                    $(".asalariado").fadeOut();
                    $("#ingreso").html("INGRESOS *");
                    $("#actividad_economica").html("A QUE SE DEDICA*");

                }
                else if(this.value==2)
                {
                    $(".asalariado").fadeIn();

                    $("#ingreso").html("SALARIO MENSUAL *");

                    $("#actividad_economica").html("CARGO ACTUAL*");

                }


            });
            $(".btnterm").click(function(){
                dialogPolicies.dialog('open');
                var active=parseInt( $(this).data('active'));
                $("#accordionPolicy").accordion( "option", "active",active );

            });
            $("#appearAutorizations").click(function(){
                var panel=$(this).data('panel');
                $("."+panel).fadeIn();
               var grandpa=$(this).parent().parent();
               var check=grandpa.find("#chkallAutorization")
             //  $(check).attr("disabled", true);
                console.log(check)

            });
            $("#chkallAutorization").change(function(){
               if(this.checked)
               {
                   $("#autorizations").children().each(function(index,element)
                   {
                        var buttonSuccess =$(element).find(".row").find('.btn-success')[0];
                        submitautorization(buttonSuccess);
                        console.log( buttonSuccess);

                    });
               }
               $(this).attr("disabled", true);
            });
            $("#appearPolicies").click(function(){
                var panel=$(this).data('panel');
                $("."+panel).fadeIn();
               var grandpa=$(this).parent().parent();
               var check=grandpa.find("#chkallPolicy")
              // $(check).attr("disabled", true);
                console.log(check)

            });
            $("#accept_data_treatment").change(function(){
                var client=$(this).data('client');
                if(this.checked&& client!='')
                {
                   $.ajax({
                        url:urlBase+'clients/UpdateDataProccess/'+client,
                        type: "POST",
                        dataType: "json",
                        data: {
                            _method:'PATCH',
                            accept_data_treatment:this.checked,
                            _token:"{{csrf_token()}}",
                        },
                        success: function (result){
                            progressbar.progressbar("option", "value",parseInt( result.info));
                            $("#step7").removeClass('progtrckr-todo').addClass('progtrckr-done');
                            setTimeout(function(){
                                window.location.href=urlBase+'clients/'+client+'?action=finish';
                            }, 5000);
                        },
                        error: function (ajaxContext)
                        {
                            var object=JSON.parse(ajaxContext.responseText);
                            console.log(object.errors);
                            Swal.fire({
                                title: "Se han encontrado los siguientes errores:",
                                icon: "error",
                                text:object.message,
                                draggable: true
                            });
                           // window.location.reload();
                        //alert(ajaxContext.responseText)
                        }
                   })
                }
            });

            $(".filter").click(function(){

                $("#filterForm").fadeIn();
                $("#importForm").fadeOut();

            })
            $("#btnCloseImportExcel").click(function(){
                $("#importForm").fadeOut();
            });
            $("#btnCloseFilter").click(function(){
                $("#filterForm").fadeOut();
            });
            $("#chkallPolicy").change(function(){
               if(this.checked)
               {
                   $("#policies").children().each(function(index,element)
                   {
                        var buttonSuccess =$(element).find(".row").find('.btn-success')[0];
                        submitPolicy(buttonSuccess);
                        console.log( buttonSuccess);

                    });
               }
               $(this).attr("disabled", true);
            });
            $("#eps_affiliate").change(function(){
                if(this.value == "-1")
                {
                    dialogEps.dialog("open");
                }
            });
            $("#arl_affiliate").change(function(){
                if(this.value == "-1")
                {
                    dialogArl.dialog("open");
                }
            });
            $("#btnHomework").click(function(){
                dialogHomework.dialog("open");

            });
            $("#btnNewness").click(function(){
                dialogNewness.dialog("open");

            });
            $("#btnNewnessType").click(function(){
                dialogNewnessType.dialog("open");

            });
            $("#btnUser").click(function(){
                dialogUser.dialog("open");
            });
            $(".btnPolicy").click(function(){
                dialogPolicy.dialog("open");
            });
            $(".btnEps").click(function(){
                dialogEps.dialog("open");
            });
            $(".btnArl").click(function(){
                dialogArl.dialog("open");
            });

            $("#birth_date").change(function(){
                let age=CalculateAge(this.value);
                   $("#age").html("Edad: "+age +" años");
            });
            $(".currency").focus(function(){
                this.value= "$";
            });
            $(".currency").blur(function(){
              var num= new Intl.NumberFormat("en-US", {
                                        style: "currency",
                                        currency: "USD"
                                        }).format(this.value.replace('$',''));
                    this.value=num;

            });
            $("#state").change(function(){
                console.log(this.value);
                url=urlBase+"cities/GetCitiesByState/"+this.value;//"{{url('/cities/GetCitiesByState/')}}/"+this.value;
                $("#city").empty().append('<option value="">Seleccione una ciudad</option>');
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (result)
                    {
                        console.log(result);
                        $.each(result, function(index, city)
                        {
                            $("#city").append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    },
                    error: function (ajaxContext)
                    {
                        Swal.fire({
                            title: "Se han encontrado los siguientes errores:",
                            icon: "error",
                            text:ajaxContext.responseText,
                            draggable: true
                        });
                        //alert(ajaxContext.responseText)
                    }
                });
            });
            $("#seizure").change(function(){
                console.log( this.checked);
                this.checked?$("#divCompanySeizure").fadeIn():$("#divCompanySeizure").fadeOut();
                $("#company_seizure").focus();
                $("#company_seizure").val('');
            });
            $("#btnPolAutorizaciones").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnPolAutorizaciones")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                 $(".card").fadeOut();
                $("#cardPolAutorizaciones").fadeIn();

            });
            $(".btnfilter").click(function(){
                console.log($(this).data('url'));
                console.log($(this).data('title'));
                $("#frmFilter").attr('action',$(this).data('url'));
                dialogfilter.dialog("open");

            }) ;
            $("#btnInfoPatrimonial").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnInfoPatrimonial")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                 $(".card").fadeOut();
                $("#cardInfoPatrimonial").fadeIn();

            });
            $("#btnDocumenType").click(function(){
                dialogDocumentType.dialog("open");
            });
            $("#btnInfoPersonal").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');

                $(".card").fadeOut();
                if(abrirInfopersonal(user ,client)){
                    $("#btnInfoPersonal")
                .removeClass('btn-primary')
                .addClass('btn-info');
                    $("#cardInfoPersonal").fadeIn();

                   }
                   else
                   {
                       Swal.fire({
                        title: "Advertencia",
                        icon: "warning",
                        html:"La informacion ya se encuentra registrada, si desea actualizarla por favor contacte al administrador",
                        draggable: true
                        });
                    }


            });
            $("#btnEventType").click(function(){
                dialogEventTipe.dialog('open');

            })

            $("#btnInfoLaboral").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnInfoLaboral")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                $(".card").fadeOut();
                $("#cardInfoLaboral").fadeIn();

            });
            $("#btnDatosContacto").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnDatosContacto")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                $(".card").fadeOut();
                $("#cardDatosContacto").fadeIn();

            });
            $("#btnInfoLegal").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnInfoLegal")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                $(".card").fadeOut();
                $("#cardInfoLegal").fadeIn();
            })
            $("#btnInfoCredito").click(function(){
                $(".btn").removeClass('btn-info').addClass('btn-primary');
                $("#btnInfoCredito")
                 .removeClass('btn-primary')
                 .addClass('btn-info');
                $(".card").fadeOut();
                $("#cardInfoCrediticia").fadeIn();

            });
            $("#btnSearch").click(function(){
                loadModule();
                dialogSearch.dialog('option','classes.ui-dialog','background:red')
                console.log(dialogSearch.dialog('option','classes.ui-dialog'))
                dialogSearch.dialog('open');
            })

            $("#btnContact").click(function()
            {
                dialogContact.dialog("open");
            });
            $(".btnEditClient").click(function()
            {
                client_id=$(this).data('id');
                $("#frmEditClient").attr('action',urlBase+"clients/"+client_id+"/edit");
                dialogEditClient.dialog("open");
            });
            $("#datepicker").datepicker({
                onSelect:function(  dateText, inst )
                {
                    showEvents(dateText);
                },
                setDate:"10/12/2012",
                selectedDay: 24,
                selectedMonth: 9,
                selectedYear:2026,
                onChangeMonthYear:function(year, month, inst)
                {
                    console.log(inst);
                    alert(year);
                },
                autoSize:true
              });
              var dialogEvent=$("#dialogEvent").dialog({
                autoOpen: false,
                height: "auto",
                width:400,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    title:"Regresar",
                    icon: 'fa-solid fa-arrow-left',
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogEvent.dialog("close");
                    }
                }],

                close: function ()
                {

                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            })
             var dialogEditClient= $("#dialogEditClient").dialog({
                autoOpen: false,
                height: "auto",
                width: "auto",
                 title: "¿Qué desea editar?",
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    title:"Regresar",
                    icon: 'fa-solid fa-arrow-left',
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogEditClient.dialog("close");
                    }
                }],

                close: function ()
                {

                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var  dialogHomework= $("#dialogHomework").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{

                    text: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmHomework")[0].submit();
                    }
                },
                {
                    text: "Salir",
                    "class": 'btn btn-danger',
                    click: function () {
                        dialogHomework.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmHomework")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogSearch=$("#dialogSearch").dialog({
                autoOpen: false,
                height: "auto",
                width: 350,
                modal: true,
                classes:{
                    "ui-dialog-titlebar":"none"
                },

                buttons:
                [{
                    icon:'fa-solid fa-arrow-left',
                    title: "Regresar",
                    class: 'btn btn-primary',
                    click: function () {
                        dialogSearch.dialog("close");
                    }
                }],
            });
            var dialogPolicies=$("#dialogPolicies").dialog({
                autoOpen: false,
                  classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                height: "auto",
                width: 350,
                modal: true,
                buttons:
                [{
                    icon:'fa-solid fa-arrow-left',
                    title: "Regresar",
                    class: 'btn btn-primary',
                    click: function () {
                        dialogPolicies.dialog("close");
                    }
                }],
            });
            var dialogfilter=$("#dialogfilter").dialog({
                title: $(".btnfilter").data('title'),
                autoOpen: false,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                height: "auto",
                width: 300,
                modal: true,
                buttons:
                [{
                    icon:'fa-solid fa-magnifying-glass',
                    title: "Buscar",
                    class: 'btn btn-success',
                    click: function () {
                        $("#frmfilter")[0].submit();
                    }
                },
                {
                    icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    class: 'btn btn-primary',
                    click: function () {
                        dialogfilter.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmfilter")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogNewnessType=$("#dialogNewnessType").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                modal: true,
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmNewnessType")[0].submit();
                    }
                },
                {
                    icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogNewnessType.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmNewnessType")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogViewDocuments= $("#dialogViewDocuments").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    text: "Salir",
                    "class": 'btn btn-danger',
                    click: function () {
                        dialogViewDocuments.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#tblDocuments tbody").empty();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogDocumentType= $("#dialogDocumentType").dialog({
                autoOpen: false,
                height: "auto",
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                width: 300,
                modal: true,
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmDocumentType")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogDocumentType.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmDocumentType")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogUser=$("#dialogUser").dialog({
                autoOpen: false,
                height: "auto",
                classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                width: 300,
                modal: true,
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    class: 'btn btn-success',
                    click: function () {
                       $("#frmUser")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogUser.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmUser")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            })
            var dialogAttach= $("#dialogAttach").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    icon: 'fa-solid fa-paperclip',
                    title: "Adjuntar",
                    "class": 'btn btn-success',
                    click: function () {
                       $("#frmAttach")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogAttach.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmAttach")[0].reset();
                   //form[0].reset();
                    //allFields.removeClass("ui-state-error");

                }
            });
            var dialogPolicy= $("#dialogPolicy").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmPolicy")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogPolicy.dialog("close");
                    }
                }],
            });
            var dialogArl= $("#dialogArl").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmArl")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogArl.dialog("close");
                    }
                }],
                close: function (){
                    $("#frmArl")[0].reset();
                }
            });
            dialogEps= $("#dialogEps").dialog({
                autoOpen: false,
                height: "auto",
                width: 300,
                modal: true,
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                buttons:
                [{
                    icon: 'fa-solid fa-save',
                    title: "Guardar",
                    "class": 'btn btn-success',
                    click: function () {
                        $("#frmEps")[0].submit();
                    }
                },
                {
                      icon:'fa-solid fa-arrow-left',
                    title: "Salir",
                    "class": 'btn btn-primary',
                    click: function () {
                        dialogEps.dialog("close");
                    }
                }],
                close: function ()
                {
                    $("#frmEps")[0].reset();
                    //form[0].reset();
                    //allFields.removeClass("ui-state-error");
                }
            });
            var dialogEventTipe=$("#dialogEventTipe").dialog({
                autoOpen: false,
                height: "auto",
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                width: 300,
                modal: true,
                buttons:
                [
                    {
                        icon: 'fa-solid fa-save',
                        title: "Guardar",
                        "class": 'btn btn-success',
                        click: function()
                        {
                            $("#frmEventTipe")[0].submit();
                        }
                    },
                    {
                        icon: 'fa-solid fa-arrow-left',
                        title: "Salir",
                        "class": 'btn btn-primary',
                        click: function ()
                        {
                             $("#frmEventTipe")[0].reset();
                            dialogContact.dialog("close");
                        }

                    }
                ],
                close: function ()
                {
                    $("#frmContact")[0].reset();
                //form[0].reset();
                //allFields.removeClass("ui-state-error");
                }
            })
            dialogContact= $("#dialogContact").dialog({
                autoOpen: false,
                height: "auto",
                 classes:{
                    "ui-dialog-titlebar-close":"hidden"
                },
                width: 300,
                modal: true,
                buttons:
                [
                    {
                        icon: 'fa-solid fa-save',
                        title: "Guardar",
                        "class": 'btn btn-success',
                        click: function()
                        {
                            $("#frmContact")[0].submit();
                        }
                    },
                    {
                        icon: 'fa-solid fa-arrow-left',
                        title: "Salir",
                        "class": 'btn btn-primary',
                        click: function ()
                        {
                             $("#frmContact")[0].reset();
                            dialogContact.dialog("close");
                        }

                    }
                ],
                close: function ()
                {
                    $("#frmContact")[0].reset();
                //form[0].reset();
                //allFields.removeClass("ui-state-error");
                }
            });
        </script>
