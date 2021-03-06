<?php
include("../partials/verify-session.php");
?>
<!-- author: Alexis Holguin, github: MoraHol -->
<!doctype html>
<html lang="es">

<head>
  <title>GreenPack | Crear Producto</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="/css/all.min.css">

  <!-- Include Editor style. -->
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type='text/css' />
  <link rel="stylesheet" href="/css/nice-select.css">


  <link rel="stylesheet" href="/vendor/dropzone/dropzone.css">

  <!-- Include JS file. -->
  <script type="text/javascript" src="/vendor/froala_editor.pkgd.min.js"></script>

  <?php
  require_once dirname(dirname(__DIR__)) . "/dao/MaterialDao.php";
  $materialDao = new MaterialDao();
  $materials = $materialDao->findAll(); ?>
  <style>
    select .wide {
      width: 90%;
    }

    hr {
      border-top: 3px solid rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="white-edition">
  <div class="wrapper ">
    <?php include("../partials/sidebar.php") ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include("../partials/navbar.php"); ?>
      <div class="content">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.hhtmltml">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Crear un Nuevo Producto</li>
          </ol>
          <br>
          <div class="form-group">
            <label for="title">Nombre:</label>
            <input type="text" placeholder="bolsa de manija" id="title" class="form-control">
          </div>
          <br>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="ref">Referencia:</label>
                <input type="text" placeholder="LV-12" id="ref" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" placeholder="2000" id="price" class="form-control">
              </div>
            </div>
          </div>

          <br>
          <div class="form-group">
            <label for="content">Descripción:</label>
            <br>
            <textarea name="content" id="content"></textarea>
          </div>
          <div class="form-group">
            <label for="myId">Imagenes del producto:</label>
            <div id="myId" class="dropzone"></div>
          </div>
          <br>
          <br>
          <div class="form-gruop">
            <label for="campo1">Usos:</label>
            <div class="container">
              <div class="row" id="fields">

              </div>
              <div>
              </div>
              <button class="btn btn-primary" onclick="addField()" title="Agregar un uso"><i class="fas fa-plus"></i></button>
              <!-- <hr> -->
              <div class="form-gruop" style="display: none">
                <label for="campo1">Medidas:</label>
                <ul class="list-unstyled" id="measurements">

                </ul>
              </div>
              <button style="display: none" class="btn btn-primary" onclick="addMeasurement()" title="Agregar una medida"><i class="fas fa-plus"></i></button>
              <hr>
              <div class="form-gruop" style="display: none">
                <label for="campo1">Materiales:</label>
                <ul class="list-unstyled" id="materials">


                </ul>
              </div>

              <button style="display: none" class="btn btn-primary" onclick="addMaterial()" title="Agregar un material"><i class="fas fa-plus"></i></button>
              <!-- <hr> -->
              <?php
              require dirname(dirname(__DIR__)) . "/dao/CategoryDao.php";
              $categoryDao = new CategoryDao();
              $categories = $categoryDao->findAll(); ?>
              <div class="form-group">
                <label for="category">Selecciona la categoría del producto:</label>
                <br>
                <select id="category" class="wide">
                  <option disabled selected>Selecciona</option>
                  <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->getId(); ?>"><?= $category->getName(); ?></option>
                  <?php } ?>
                </select>
              </div>


              <div class="row" style="margin-bottom: 20px; margin-top: 60px;">
                <div class="col"></div>
                <div class="col text-center"><button id="submitEditor" class="btn btn-primary btn-lg">Crear</button></div>
                <div class="col"></div>
              </div>


            </div>
          </div>
          <?php include("../partials/footer.html"); ?>
        </div>
      </div>


      <!--   Core JS Files   -->
      <script src="/js/jquery-2.2.4.min.js"></script>
      <script src="../assets/js/core/popper.min.js"></script>
      <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
      <script src="/js/jquery.nice-select.min.js"></script>
      <script src="https://unpkg.com/default-passive-events"></script>
      <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      <!-- Chartist JS -->
      <script src="../assets/js/plugins/chartist.min.js"></script>
      <!--  Notifications Plugin    -->
      <script src="../assets/js/plugins/bootstrap-notify.js"></script>
      <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
      <!-- Material Dashboard DEMO methods, don't include it in your project! -->
      <script src="../assets/demo/demo.js"></script>
      <script>
        $(() => {
          $('.sidebar div.sidebar-wrapper ul.nav li:first').removeClass('active')
          $('#product-item').addClass('active')
        })
      </script>
      <script src="../assets/js/script.js"></script>
      <script src="/js/es.js"></script>
      <script src="/vendor/dropzone/dropzone.js"></script>
      <script>
        let indexField = 1
        let indexMeasurement = 0
        $(document).ready(function() {
          $('[data-toggle="popover"]').popover();
          $('#fields').append(`<div class="col-sm-4">
                  Uso ${indexField}:<input type="text" id="field${indexField}" class="form-control">
                </div>`)
          // $('#measurements').append(`<li>Medida ${indexField}:<div class="row">
          //         <div class="col"><label for="width${indexMeasurement}">Ancho:</label><input type="number" id="width${indexMeasurement}" class="form-control"></div>
          //         <div class="col"><label for="height${indexMeasurement}">Alto:</label><input type="number" id="height${indexMeasurement}" class="form-control"></div>
          //         <div class="col"><label for="lenght${indexMeasurement}">Largo:</label><input type="number" id="lenght${indexMeasurement}" class="form-control"></div>
          //         <div class="col"><label for="window${indexMeasurement}">Ventana:</label><input type="number" id="window${indexMeasurement}" class="form-control"</div>
          //       </div></li>`)
          $('#materials').append(`<li><select class="wide" style="margin-bottom: 10px;"><option disabled selected>Seleccione un material</option>
                  <?php
                  foreach ($materials as  $material) { ?>
                    <option value="<?= $material->getId(); ?>"><?= $material->getName(); ?></option>
                  <?php }
                  ?>
                </select></li>`)
        });

        function addField() {
          indexField++;
          $('#fields').append(`<div class="col-sm-4">
                  Uso ${indexField}:<input type="text" id="field${indexField}" class="form-control">
                </div>`)
        }

        function addMeasurement() {
          if ($('#category').val() == null) {
            $.notify({
              message: 'Selecciona una categoria antes de adicionar las medidas',
              //title: 'Greenpack',
              icon: 'notification_important'
            }, {
              type: 'warning'
            })
          } else {
            indexMeasurement++;
            let nameAdditional = ''
            switch (parseInt($('#category').val())) {
              case 1:
                nameAdditional = 'Ventana'
                addMeasurementHtml(indexMeasurement, nameAdditional)
                break;
              case 2:
                nameAdditional = 'Piezas Por Pliego'
                addMeasurementHtml(indexMeasurement, nameAdditional)
                break;
              case 3:
                nameAdditional = 'Piezas Por Pliego'
                addMeasurementHtml(indexMeasurement, nameAdditional)
                break;
              case 4:
                nameAdditional = 'Piezas Por Pliego'
                addMeasurementHtml(indexMeasurement, nameAdditional)
                break;
              case 5:
                nameAdditional = 'Piezas Por Pliego'
                addMeasurementHtml(indexMeasurement, nameAdditional)
                break;
              case 6:
                addMeasurementHtml(indexMeasurement)
                $('.lenght').css('display', 'none')
                $('.window').css('display', 'none')
                $(`#lenght${indexMeasurement}`).val(0)
                $(`#window${indexMeasurement}`).val(0)
                break;
            }
            
          }
        }
        function addMeasurementHtml(indexMeasurement, nameAdditional = ''){
          $('#measurements').append(`<li>Medida ${indexMeasurement}:<div class="row">
                  <div class="col"><label for="width${indexMeasurement}">Ancho:</label><input type="number" id="width${indexMeasurement}" class="form-control"></div>
                  <div class="col"><label for="height${indexMeasurement}">Alto:</label><input type="number" id="height${indexMeasurement}" class="form-control"></div>
                  <div class="col lenght"><label for="lenght${indexMeasurement}">Largo:</label><input type="number" id="lenght${indexMeasurement}" class="form-control"></div>
                  <div class="col window"><label for="window${indexMeasurement}">${nameAdditional}:</label><input type="number" id="window${indexMeasurement}" class="form-control"></div>
                </div></li>`)
        }


        function addMaterial() {
          $('#materials').append(`<li><select class="wide" style="margin-bottom: 10px;" ><option disabled selected>Selecciona un material</option>
                  <?php foreach ($materials as  $material) { ?>
                    <option value="<?= $material->getId(); ?>"><?= $material->getName(); ?></option>
                  <?php } ?>
                </select></li>`)
          $('select').niceSelect()

        }
      </script>
      <script>
        let editor
        let myDropzone
        $(() => {
          $('select').niceSelect()
          Dropzone.autoDiscover = false
          editor = new FroalaEditor('#content', {
            language: 'es',
            height: 300,
            imageUploadParam: 'photo',
            imageUploadURL: '/admin/upload.php',
            imageUploadMethod: 'POST',
            videoUploadParam: 'video',
            videoUploadURL: 'upload-video.php',
            imageUploadMethod: 'POST',
            fileUploadParam: 'file',
            fileUploadURL: '/admin/upload-file.php',
            fileUploadMethod: 'POST',
            events: {
              'image.removed': function($img) {
                img = $img[0]
                $.post('/admin/image_delete.php', {
                  src: $img.attr('src')
                }, (data, status) => {
                  if (status != "success") {
                    alert("error")
                  }
                })
              },
              'file.removed': function($file) {
                file = $file[0]
                $.post('/admin/file_delete.php', {
                  src: $file.attr('src')
                }, (data, status) => {
                  if (status != "success") {
                    alert("error")
                  }
                })
              },
              'keyup': function(keyupEvent) {
                if (document.domain != 'localhost') {
                  $('.fr-wrapper>div:first-child').css('visibility', 'hidden')
                }
              }
            }
          }, () => {
            if (document.domain != 'localhost') {
              $('.fr-wrapper>div:first-child').css('visibility', 'hidden')
            }
          })
          myDropzone = new Dropzone("div#myId", {
            url: "/admin/upload.php",
            method: 'post',
            paramName: 'photo',
            acceptedFiles: "image/*",
            dictDefaultMessage: 'Sube tus archivos, arrastralos o haz click para buscarlos',
            dictMaxFilesExceeded: 'Carga solo una imagen',
            dictInvalidFileType: 'Carga solo imagenes'
          })
          $('button#submitEditor').click(() => {
            if (myDropzone.getAcceptedFiles().length > 0 && $('#title').val() != '' && editor.html.get() != '') {
              let responses = []
              let uses = []
              let materials = []
              let measurements = []
              myDropzone.getAcceptedFiles().forEach(image => {
                let response = JSON.parse(image.xhr.responseText)
                responses.push(response.link)
              })
              for (let index = 0; index < $('#fields').children().length; index++) {
                if (typeof($('#field' + index).val()) != 'undefined' && $('#field' + index).val() !== "") {
                  uses.push($('#field' + index).val())
                }
              }

              for (let index = 0; index < $('#materials').children().length; index++) {
                let value = $('#materials').children()[index].firstElementChild.value
                if (value != '' && typeof(value) != 'undefined') {
                  materials.push(value)
                }
              }
              for (let index = 0; index < $('#measurements').children().length; index++) {
                let measurement = {}

                measurement.width = $('#width' + (index + 1)).val()
                measurement.height = $('#height' + (index + 1)).val()
                measurement.lenght = $('#lenght' + (index + 1)).val()
                measurement.window = $('#window' + (index + 1)).val()
                if (typeof($('#width' + (index + 1)).val()) != 'undefinded' && $('#width' + (index + 1)).val() != '' &&
                  typeof($('#height' + (index + 1)).val()) != 'undefined' && $('#height' + (index + 1)).val() != '' &&
                  typeof($('#lenght' + (index + 1)).val()) != 'undefined' && $('#lenght' + (index + 1)).val() != '' &&
                  $('#window' + (index + 1)).val() != undefined) {
                  measurements.push(measurement)
                }
              }
              $.post("api/create_product.php", {
                title: $('#title').val(),
                content: editor.html.get(),
                photos: JSON.stringify(responses),
                uses: JSON.stringify(uses),
                ref: $('#ref').val(),
                category: $('#category').val(),
                price: $('#price').val(),
                materials: JSON.stringify(materials),
                measurements: JSON.stringify(measurements)
              }, (data, status) => {
                $.notify({
                  message: 'Producto creado',
                  //title: 'Greenpack',
                  icon: 'notification_important'
                }, {
                  type: 'success'
                })
                fieldsClear()
              })
            } else {
              $.notify({
                message: 'Completa todos los campos',
                //title: 'Greenpack',
                icon: 'notification_important'
              }, {
                type: 'danger'
              })
            }
          })
        })

        function fieldsClear() {
          $('#title').val('')
          editor.html.set('')
          myDropzone.removeAllFiles()
        }
      </script>
</body>

</html>