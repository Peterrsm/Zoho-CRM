<?php
    /* Carrega a classe DOMPdf */
    require_once("dompdf/dompdf_config.inc.php");
    require_once 'RegistroCRM.php';
    
    /* Inicializa variáveis necessárias para efetuar a consulta no Zoho CRM */
    /* Token gerado via Zoho API */
    $authtoken = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";                  
    $record_id = $_GET["RecordID"];
    $modulo = "Nome do módulo";
    $coluna = "Nome da coluna 1";
    $coluna2 = "Nome da coluna 2";
    $coluna3 = "Nome da coluna 3";
    $coluna4 = "Nome da coluna 4";
    $coluna5 = "Nome da coluna 5";
    
    
    /* Obtém os campos do respectivo registro no Zoho CRM */
    $registro = new RegistroCRM;
    $pesquisa_registro = $registro->procurarCRM($authtoken, $record_id, $modulo);
    
    $encode1 = json_decode($pesquisa_registro, true);    
    
    $info = array();
    
    if (isset($encode1['response']['result'])) {
        $encode2 = $encode1['response']['result'][$modulo]['row']['FL'];
        for ($i = 0; $i < count($encode2); $i++) {
            if ($encode2[$i]['val'] === $coluna) {
                $info[0] = $encode2[$i]['content']; 
                if($info[0] == "null"){
                    $info[0] = " ";
                }
            }
            if ($encode2[$i]['val'] === $coluna2) {
                $info[1] = $encode2[$i]['content']; 
                if($info[1] == "null"){
                    $info[1] = " ";
                }
            }
            if ($encode2[$i]['val'] === $coluna3) {
                $info[2] = $encode2[$i]['content']; 
                if($info[2] == "null"){
                    $info[2] = " ";
                }
            }
            if ($encode2[$i]['val'] === $coluna4) {
                $info[3] = $encode2[$i]['content']; 
                if($info[3] == "null"){
                    $info[3] = " ";
                }
            }
            if ($encode2[$i]['val'] === $coluna5) {
                $info[4] = $encode2[$i]['content'];
                if($info[4] == "null"){
                    $info[4] = " ";
                }
            }
        }
    }
        
    /* Cria a instância */
    $dompdf = new DOMPDF();
    $dompdf->set_option('enable_html5_parser', TRUE);

    /* Carrega seu HTML */
    $str = "";
    
    $str = $str . '
                    <!DOCTYPE html>
                    <style>
                        #teste{
                            width:50%;
                            height: 10%;
                            border: 1px solid black;
                            margin-left:10%;
                        }
                    </style>
                    <html lang="pt">

                    <head>
                        <title>Teste</title>
                    </head>

                    <body>
                        <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:100%;height:20%;font-family:Arial, Helvetica, sans-serif;background-color:#FFFFFF;">
                            <tr>
                                <td style="width:100%;height:65px;text-align:center;vertical-align: center;" rowspan="2">
                                    ' . $info[0] . ' 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;height:65px;text-align:center;vertical-align: center;" rowspan="2">
                                    ' . $info[1] . ' 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;height:65px;text-align:center;vertical-align: center;" rowspan="2">
                                    ' . $info[2] . ' 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;height:65px;text-align:center;vertical-align: center;" rowspan="2">
                                    ' . $info[3] . ' 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100%;height:65px;text-align:center;vertical-align: center;" rowspan="2">
                                    ' . $info[4] . ' 
                                </td>
                            </tr>
                        </table>
                    </body>

                </html>
                        ';
    

    $dompdf->load_html($str);

    /* Renderiza */
    $dompdf->render();

    /* Exibe */
    $dompdf->stream(
        /* Nome do arquivo de saída */
        "Teste.pdf", 
        array(
            /* Para download, altere para true */
            "Attachment" => false 
        )
    );
?>