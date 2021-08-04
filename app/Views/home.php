<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indicadores</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url();?>/assets/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url();?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url();?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url();?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini" onLoad="cargaElementos();";>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <h3>INDICADORES PRINCIPALES <?php echo date("d-m-Y H:i:s");?></h3>
        </nav> 
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url();?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">HO</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url();?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Usuario Invitado</a>
                    </div>
                </div>
      

                <!-- Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url();?>/public" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-success">Nuevo</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- Fin menu -->
            </div>
        </aside>

        <div class="content-wrapper">
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <?php
                        $anio = date("Y");
                        ?>
                        <div class="col-md-3">
                            
                            <label>Seleccionar Indicador</label>
                            <select class="custom-select" id="tipo">
                                <?php 
                                for($a=0;$a<count($indicadorCombobox);$a++){
                                ?>
                                    <option value="<?php echo $indicadorCombobox[$a]["codigo"];?>"><?php echo $indicadorCombobox[$a]["nombre"];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Seleccionar Año</label>

                            <select class="custom-select" id="anio" value="<?php echo $anio?>">
                                <?php
                                for($a=$anio;$a>=2012;$a--){
                                ?>
                                    <option value="<?php echo $a;?>"><?php echo $a;?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-2">
                            <input type="button" class="btn btn-block bg-gradient-danger btn-lg mt-4" onclick="consultar();" value="Consultar" id="btnConsultar">
                        </div>
                    </div>
                
                    <div class="row" id="grafico">
                    </div>

                    <div class="row"> 
                        <div class="col-lg-12" id="tbRegIndicadores">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?= base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?= base_url();?>/assets/dist/js/adminlte.js"></script>


    <!-- DataTables  & Plugins -->
    <script src="<?= base_url();?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url();?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <!-- Para gráfico highchart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
        // Para consultar el gráfico
        function consultar(){
            var url='<?php echo base_url();?>/public/anio';
            var tipo = document.getElementById('tipo').value;
            var anio = document.getElementById('anio').value;
            document.getElementById("btnConsultar").value="Consultando...";
            $.ajax({   
                type: "POST",
                url:url,
                data:"tipo="+tipo+"&anio="+anio,
                success: function(datos){
                    $('#grafico').html(datos);
                    document.getElementById("btnConsultar").value="Consultar";
                }
            });
        }

        

        
    </script>
    <script>
        //Para guardar un registro en la tabla mantenedor
        function guardar(){
            var id = document.getElementById("fid").value;
            var codigo = document.getElementById("fcodigo").value;
            var nombre = document.getElementById("fnombre").value;
            var medida = document.getElementById("fumedida").value;
            var fecha = document.getElementById("ffecha").value;
            var valor = document.getElementById("fvalor").value;
            var accion = document.getElementById("faccion").value;

            if(codigo==""){
                alert("El campo CÓDIGO no debe estar vacio");
                return false;
            }
            if(nombre==""){
                alert("El campo NOMBRE no debe estar vacio");
                return false;
            }
            if(medida==""){
                alert("El campo MEDIDA no debe estar vacio");
                return false;
            }
            if(fecha==""){
                alert("El campo FECHA no debe estar vacio");
                return false;
            }
            if(valor==""){
                alert("El campo VALOR no debe estar vacio");
                return false;
            }

            if(accion==1){
                var url='<?php echo base_url();?>/public/nuevo_indicador';
            }else{
                var url='<?php echo base_url();?>/public/actualiza_indicador';
            }

            $.ajax({   
                type: "POST",
                url:url,
                data:"id="+id+"&codigo="+codigo+"&nombre="+nombre+"&medida="+medida+"&fecha="+fecha+"&valor="+valor,
                success: function(datos){
                    if(datos==1){
                        $("#formularioModal").modal('hide');
                        alert("Guardado correctamente");
                        cargaTabla();
                        limpiar();
                    }else{
                        alert("Es posible que el código y fecha ya se encuentren registrados en el sistema. Ingrese otro código u otra fecha para poder guardar.");
                    }
                    
                }
            });
            

        }

        //Para actualizar un registro en la tabla mantenedor
        function actualizar(id,codigo,nombre,medida,fecha,valor){
            document.getElementById("fid").value=id;
            document.getElementById("fcodigo").value=codigo;
            document.getElementById("fnombre").value=nombre;
            document.getElementById("fumedida").value=medida;
            document.getElementById("ffecha").value=fecha;
            document.getElementById("fvalor").value=valor;
            document.getElementById("faccion").value=0;
            document.getElementById("formularioModalLabel").innerHTML="Actualizar Registro";
            
        }

        //Para Eliminar un registro de la tabla mantenedor
        function eliminar(id){
            var url='<?php echo base_url();?>/public/elimina_indicador';
            $.ajax({   
                type: "POST",
                url:url,
                data:"id="+id,
                success: function(datos){
                    if(datos==1){
                        $("#formularioModal").modal('hide');
                        alert("Eliminado correctamente");
                        cargaTabla();
                        limpiar();
                    }else{
                        $("#formularioModal").modal('hide');
                        alert("Ocurrio un problema al eliminar.");
                        limpiar();
                    }
                    
                }
            });
        }

        //Para cargar tabla mantenedor con ajax
        function cargaTabla(){
            var url='<?php echo base_url();?>/public/tabla_indicador';
            $.ajax({   
                type: "GET",
                url:url,
                //data:"id="+id,
                success: function(datos){
                    $('#tbRegIndicadores').html(datos);
                }
            });
        }
        
        //Carga gráfico y tabla al cargar la página
        function cargaElementos(){
            consultar();
            cargaTabla();
        }

        //Para limpiar formulario de mantenedor
        function limpiar(){
            document.getElementById("fid").value="";
            document.getElementById("fcodigo").value="";
            document.getElementById("fnombre").value="";
            document.getElementById("fumedida").value="";
            document.getElementById("ffecha").value="";
            document.getElementById("fvalor").value="";
            document.getElementById("faccion").value="";
        }
    </script>
    
</body>
</html>
