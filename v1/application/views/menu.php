<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <?php 
    $link = base_url() . "index.php/ControllerDados/retornaEstoque";

    if(isset($message) && isset($s)){
      echo "<script> alert('$message');";
      echo "javascript:window.location='$link'</script>";
    } else if(isset($s)){
      echo "<script>javascript:window.location='$link'</script>";
    }


?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Tomeecia - <?php echo $titulo?></title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>plugins/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>plugins/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url();?>plugins/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>plugins/css/sb-admin.css" rel="stylesheet">
  
  <script type="text/javascript" src="<?php echo base_url()?>plugins/js/jspdf.min.js"></script>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript">
    
		$(document).ready(function(){	

			$('#enviarEntrada').prop("disabled",true);

			$('#nomeArquivoEntrada').change(function() {
				var nome = ($(this).val());
				nome = nome.substring(12,nome.length);
   			document.getElementById('file-nameEntrada').innerHTML = "<center><b>" + nome + "</b></center><br>"; 
          //$('#file-name').html("oi");
   			$('#enviarEntrada').prop("disabled",false);

   			document.getElementById('labelEnviarEntrada').style = "background-color:gray;";
			});
		});	
    </script>
    <script type="text/javascript">
    
		$(document).ready(function(){	
			$('#enviarSaida').prop("disabled",true);

			$('#nomeArquivoSaida').change(function(event) {
				var nome = ($(this).val());
				nome = nome.substring(12,nome.length);
   			document.getElementById('file-nameSaida').innerHTML = "<center><b>" + nome + "</b></center><br>"; 
   			$('#enviarSaida').prop("disabled",false);

   			document.getElementById('labelEnviarSaida').style = "background-color:gray;";
			});
		});	
    </script>
</head>




<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo base_url()?>/index.php/ControllerDados/retornaEstoque">Tomé Montagens</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo base_url();?>index.php/ControllerDados/retornaEstoque">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Estoque</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo base_url();?>index.php/ControllerDados/retornaPendencias">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Pendencias</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProdutos" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Utimos produtos</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProdutos">
            <li>
              <a class="nav-link" href="<?php echo base_url();?>index.php/ControllerDados/retornaUltimasEntradas">Ultimas Entradas</a>
            </li>
            <li>
              <a class="nav-link" href="<?php echo base_url();?>index.php/ControllerDados/retornaUltimasSaidas">Ultimas Saídas</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-text">Adicionar Produto</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a class="nav-link" data-toggle="modal" data-target="#EntradaModal">Entrada</a>
            </li>
            <li>
              <a class="nav-link" data-toggle="modal" data-target="#SaidaModal">Saída</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#modalSair">
            <i class="fa fa-fw fa-sign-out"></i>Sair</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <!-- header -->
        <div class="card-header" style="display:run-in; align-items:center;">
          <div style="width: 20%;height: 100%;position: relative;float: left;padding-top: 10px;"><i class="fa fa-table" style="padding-top:5px"></i> <?php echo $titulo?></div>
          <button type="button" id="btnExport" class="btn btn-info" style="float:right" data-toggle="modal" data-target="#modalExportar">
            <span class="fa fa-cloud-upload"></span> Exportar
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nome do Produto</th>
                  <th>Código do Produto</th>
                  <th>Unidade Comercial</th>
                  <th>Quantidade Comecial</th>
                  <th><?php echo $propriedade;?></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nome do Produto</th>
                  <th>Código do Produto</th>
                  <th>Unidade Comercial</th>
                  <th>Quantidade Comecial</th>
                  <th><?php echo $propriedade;?></th>
                </tr>
              </tfoot>
               <tbody>
           <?php foreach($estoque as $key => $dados){ ?>  
                <tr>
                  <td><?php echo $dados->xProd;?></td>
                  <td><?php echo $dados->cProd;?></td>
                  <td><?php echo $dados->uCom;?></td>
                  <td><?php echo $dados->qCom;?></td>
                  <td><?php echo $valorPropriedade[$key];?></td>
                </tr>
               <?php } ?>
              </tbody> 
            </table>
            <div id ="tableExport" style="display:none"> 
              <table id="tempTable">
                  <thead>
                      <tr>
                          <th>Nome do Produto</th>
                          <th>Código</th>
                          <th>Unidade Com.</th>
                          <th>Quantidade</th>
                          <th><?php echo $propriedade;?></th>
                      </tr>
                  </thead>
                  <tbody>

                  </tbody>
              </table>
              <style>
                      #tableExport table{
                          border: 1px solid black;
                          margin:20px;
                      }

                      #tableExport tr{
                          border: 1px solid black;
                      }
                      #tableExport td{
                          border: 1px solid black;
                      }
                      #tableExport th{
                          border: 1px solid black;
                      }
                  </style>
          </div>
          </div>
        </div>
        <div class="card-footer small text-muted">Atualizado dia <?php echo $data['dia']?> às <?php echo $data['hora']?></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Walter Miranda 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- export modal -->
    <div class="modal fade" id="modalExportar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exportar</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
              <button id="btnPDF"  class="btn btn-danger">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                 Exportar para PDF
              </button>
              <input id="pdfExport" class="form-control form-control-sm" placeholder="Nome do Arquivo" type="text" value="<?php echo $titulo.$data['dia'].$data['hora']?>.pdf">
            </center>
            <br>
            <center>
              <button id="btnExcel"  class="btn btn-success">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                 Exportar para Excel
              </button>
              <input id="excelExport" class="form-control form-control-sm" placeholder="Nome do Arquivo" type="text" value="<?php echo $titulo.$data['dia'].$data['hora']?>.xls">
            </center>
          </div>
        </div>
      </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="modalSair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Encerrar sessão?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Clique em "Sair" apenas se estiver certeza que deseja encerrar essa sessão.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?php echo base_url()?>/index.php/ControllerLogin/logout">Sair</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Entrada Modal-->
    <div class="modal fade" id="EntradaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="modalEntrada">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Entrada de produtos</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"><center>Entre com o arquivo XML da nota fiscal</center></div>
          <div id="file-nameEntrada" style="color:blue"></div>
          <button id="btnVE" style="display:none" class="btn btn-success">Carregar</button>
          <button id="btnOE" style="display:none" class="btn btn-danger">Ocultar</button>
          <div class="table-responsive">
            <center>
              <div style="width: 98%"> 
                <table class="table table-bordered" id="tabelaListarEntrada" width="98%" cellspacing="0" style="display:none">
                  <thead>
                    <tr>
                      <th>Nome do Produto</th>
                      <th>Código do Produto</th>
                      <th>Unidade Comercial</th>
                      <th>Quantidade Comecial</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome do Produto</th>
                      <th>Código do Produto</th>
                      <th>Unidade Comercial</th>
                      <th>Quantidade Comecial</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </center>
          </div>
          <div class="modal-footer">
            <form action="<?php echo base_url()?>/index.php/ControllerDados/recebeXML" method="post" enctype="multipart/form-data" style="width:100%" name="formEntrada">
              <center>
                <label for="nomeArquivoEntrada" class="labelArquivo">Procurar Arquivo</label>
                <input type="hidden" name="txt_tipo" value="e">
                <label for="enviarEntrada" class="labelArquivo" style="background-color:#CCC" id="labelEnviarEntrada">Enviar Arquivo</label>
                <input type="submit" class="enviar" id="enviarEntrada" style="border:none;padding:0px;display:none">
                <input type="file" name="arquivo" id="nomeArquivoEntrada" accept="text/xml" style="display:none">
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--inicio Modal Saida -->
    <div class="modal fade" id="SaidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelSaida">
      <div class="modal-dialog" role="document" id="modalSaida">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelSaida">Saída de produtos</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"><center>Entre com o arquivo XML da nota fiscal</center></div>
          <div id="file-nameSaida" style="color:blue"></div>
          <button id="btnVS" style="display:none" class="btn btn-success">Carregar</button>
          <button id="btnOS" style="display:none" class="btn btn-danger">Ocultar</button>
          <div class="table-responsive">
            <center>
            <div style="width: 98%"> 
              <table class="table table-bordered" id="tabelaListarSaida" width="98%" cellspacing="0" style="display:none">
                <thead>
                  <tr>
                    <th>Nome do Produto</th>
                    <th>Código do Produto</th>
                    <th>Unidade Comercial</th>
                    <th>Quantidade Comecial</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Nome do Produto</th>
                    <th>Código do Produto</th>
                    <th>Unidade Comercial</th>
                    <th>Quantidade Comecial</th>
                  </tr>
                </tfoot>
                <tbody>
                </tbody>
              </table>
            </div>
            </center>
            </div>
          <div class="modal-footer">
            <form action="<?php echo base_url()?>/index.php/ControllerDados/recebeXML" method="post" enctype="multipart/form-data" style="width:100%" name="formSaida">
            <center>
              <label for="nomeArquivoSaida" class="labelArquivo">Procurar Arquivo</label>
              <input type="hidden" name="txt_tipo" value="s">
              <label for="enviarSaida" class="labelArquivo" style="background-color:#CCC" id="labelEnviarSaida">Enviar Arquivo</label>
              <input type="submit" class="enviar" id="enviarSaida" style="border:none;padding:0px; display:none">
              <input type="file" name="arquivo" id="nomeArquivoSaida" accept="text/xml" style="display:none">
            </center>
			      </form>
          </div>
        </div>
      </div>
    </div>
    <!-- fim modal saida -->
    <style>
      .labelArquivo{    
        background-color: #3498db;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        width:160px;
        height:40px;
        position: relative;
        text-align: center;
        padding: 6px 20px;
      }
      .btn{
        margin-bottom: 10px;
      }

      .modal-backdrop.in{
        display: none;
      }
    </style>
    <script>
      function call_tabelaSaida(result)
      {
          var tbody = $("#tabelaListarSaida tbody");
          tbody.empty();
          console.log(result);
          if(typeof(result.NFe) != 'undefined'){
            var produto = result.NFe.infNFe.det;

            if(Array.isArray(produto) == false){
              var prod = produto.prod;
              tbody.append('<tr>')
              tbody.append('<td>'+ prod.xProd + '</td>');
              tbody.append('<td>'+ prod.cProd+'</td>');
              tbody.append('<td>'+ prod.uCom+'</td>');
              tbody.append('<td>'+ parseFloat(prod.qCom)+'</td>');
              tbody.append('</tr>');
            } else {

              for(var i = 0; i < produto.length; i++){

                
                var prod = produto[i].prod;
                tbody.append('<tr>')
                tbody.append('<td>'+ prod.xProd + '</td>');
                tbody.append('<td>'+ prod.cProd+'</td>');
                tbody.append('<td>'+ prod.uCom+'</td>');
                tbody.append('<td>'+ parseFloat(prod.qCom)+'</td>');
                tbody.append('</tr>');
                  
              }
            }

            document.getElementById('tabelaListarSaida').style = "display:block;";
            document.getElementById('modalSaida').style = "max-width:960px";
            document.getElementById('btnVS').style = "display:none";
            document.getElementById('btnOS').style = "display:block; border-radius:0";
          } else {
            alert("Arquivo inválido!");
          }
      }

      function ocultarSaida(){
          document.getElementById('tabelaListarSaida').style = "display:none;";
          document.getElementById('modalSaida').style = "max-width:500px";
          document.getElementById('btnVS').style = "display:block; border-radius:0";
          document.getElementById('btnOS').style = "display:none";
      }
      $(document).ready(function(){
        var form;
          $('#nomeArquivoSaida').change(function(event) {
            ocultarSaida();
            form = new FormData();
            form.append('arquivo', event.target.files[0]); 
            console.log(form);
          });
          $("#btnOS").click(function(){
            ocultarSaida();
          });
          $("#btnVS").click(function(){
            var link = "<?php echo site_url('/controllerDados/visualizaXML')?>";
              $.ajax({
                  url: link,
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  dataType: 'json',
                  data: form,
                  success: function(result) 
                  {                       
                      call_tabelaSaida(result);
                  },
                  error: function(xhr, ajaxOptions, thrownError) 
                  {
                      console.log(xhr);
                  }
              });         
          });
      });
    </script>
    <script>
    
      function call_tabelaEntrada(result)
      {
          var tbody = $("#tabelaListarEntrada tbody");
          tbody.empty();
          console.log(result);
          if(typeof(result.NFe) != 'undefined'){
            
            var produto = result.NFe.infNFe.det;

            if(Array.isArray(produto) == false){
              var prod = produto.prod;
              tbody.append('<tr>')
              tbody.append('<td>'+ prod.xProd + '</td>');
              tbody.append('<td>'+ prod.cProd+'</td>');
              tbody.append('<td>'+ prod.uCom+'</td>');
              tbody.append('<td>'+ parseFloat(prod.qCom)+'</td>');
              tbody.append('</tr>');

            } else {
              
              for(var i = 0; i < produto.length; i++){  
                var prod = produto[i].prod;
                tbody.append('<tr>')
                tbody.append('<td>'+ prod.xProd + '</td>');
                tbody.append('<td>'+ prod.cProd+'</td>');
                tbody.append('<td>'+ prod.uCom+'</td>');
                tbody.append('<td>'+ parseFloat(prod.qCom)+'</td>');
                tbody.append('</tr>');
              }
            }

              document.getElementById('tabelaListarEntrada').style = "display:block;";
              document.getElementById('modalEntrada').style = "max-width:960px";
              document.getElementById('btnVE').style = "display:none";
              document.getElementById('btnOE').style = "display:block; border-radius:0";
          } else {
            alert("Arquivo inválido!");
          }
      }

      function ocultarEntrada(){
        document.getElementById('tabelaListarEntrada').style = "display:none;";
        document.getElementById('modalEntrada').style = "max-width:500px";
        document.getElementById('btnVE').style = "display:block; border-radius:0";
        document.getElementById('btnOE').style = "display:none";
      }
      $(document).ready(function(){
        var form;
          $('#nomeArquivoEntrada').change(function(event) {
            ocultarEntrada();
            formEntrada = new FormData();
            formEntrada.append('arquivo', event.target.files[0]); 
            console.log(formEntrada);
          });
          $("#btnOE").click(function(){
           ocultarEntrada();
          });
          $("#btnVE").click(function(){
            var link = "<?php echo site_url('/controllerDados/visualizaXML')?>";
              $.ajax({
                  url: link,
                  type: 'POST',
                  processData: false,
                  contentType: false,
                  dataType: 'json',
                  data: formEntrada,
                  success: function(result) 
                  {                       
                      call_tabelaEntrada(result);
                  },
                  error: function(xhr, ajaxOptions, thrownError) 
                  {
                      console.log(xhr);
                  }
              });         
          });
      });
    </script>
    <script>
      function genPDF(){
				html2canvas(document.getElementById('tableExport'),{
					onrendered: function (canvas){
            var name = document.getElementById('pdfExport').value;
						var img = canvas.toDataURL("image/PNG");
						var doc = new jsPDF("portrait");
						doc.addImage(img, 'JPEG',2,3,(0.25*canvas.width),(0.25* canvas.height));
						doc.save(name);
					}
				});
			}

      $(document).ready(function(){
        $('#btnPDF').click(function(){
          document.getElementById('tableExport').style = "display:block";
          genPDF();
          document.getElementById('tableExport').style = "display:none";
        });

        $('#btnExcel').click(function(e){
          
          e.preventDefault();

          var table_div = document.getElementById('tableExport');

          var blobData = new Blob(['\ufeff'+table_div.outerHTML], {type:'application/vnd.ms-excel'});

          var url = window.URL.createObjectURL(blobData);

          var a = document.createElement('a');
          document.body.appendChild(a);

          a.setAttribute("type","hidden");

          a.href = url;

          var name = document.getElementById('excelExport').value;
          var names = name.split('.');
          name = names[0] + '.xls';

          a.download = name;

          a.click();

          console.log(a);
        });
      });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url();?>plugins/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>plugins/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url();?>plugins/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>plugins/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>plugins/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>plugins/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo base_url();?>plugins/js/sb-admin-datatables.min.js"></script>
    <script src="<?php echo base_url();?>plugins/js/sb-admin-charts.min.js"></script>
    <script src="http://www.developerdan.com/table-to-json/javascripts/jquery.tabletojson.min.js"></script>
    <script>
      $('#btnExport').click( function(){
        var table = $('#dataTable').tableToJSON();
        console.log(table);
        var tbody = $("#tempTable tbody");
        tbody.empty();

        for(var i = 1; i <= table.length;i++){
        tbody.append('<tr>');
        tbody.append('<td>' + table[i]["Nome do Produto"] + '</td>');
        tbody.append('<td>' + table[i]["Código do Produto"] + '</td>');
        tbody.append('<td>' + table[i]["Unidade Comercial"] + '</td>');
        tbody.append('<td>' + table[i]["Quantidade Comecial"] + '</td>');
        tbody.append('<td>' + table[i]["<?php echo $propriedade?>"] + '</td>');
        tbody.append('</tr>');
      }
      });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('modal-backdrop fade show').insertAfter($('body'));
    });
    </script>
  </div>
</body>

</html>
