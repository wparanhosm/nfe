<div id ="tableExport" style="display:none"> 
    <table>
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