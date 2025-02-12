<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim Diário</title>
    <style>
        body {
            background: #000; /* Fundo preto */
            background: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 10%, rgba(34, 32, 32, 0) 90%, rgba(12, 12, 12, 0) 100%);
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .documento-a4 {
            width: 297mm; /* Largura do A4 em modo paisagem */
            height: 210mm; /* Altura do A4 em modo paisagem */
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            background-color: #fff;
        }

        .document-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .document-header .title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #e67e22; /* Laranja */
        }

        .document-header p {
            font-size: 18px;
            color: #34495e;
            line-height: 1.5;
        }

        .table-container {
            margin-top: 30px;
        }

        /* Estilos da tabela */
        .document-table {
            width: 100%;
            border-collapse: collapse;
        }

        .document-table th, .document-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .document-table th {
            background-color: #e67e22; /* Laranja */
            color: #fff;
            font-weight: bold;
        }

        .document-table td {
            background-color: #ecf0f1;
            color: #34495e;
        }

        .document-table tr:nth-child(even) td {
            background-color: #f4f6f7;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #7f8c8d;
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            .documento-a4 {
                width: 100%;
                height: auto;
                padding: 15px;
            }

            .document-table {
                font-size: 14px;
            }

            .document-table th, .document-table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
  
    <!-- Documento A4 -->
    <div class="documento-a4">
        <!-- Título e Informações -->
        <div class="document-header">
            <h2 class="title">Boletim Diário </h2>
            <p style="font-size:14px;"><B>DEPARTAMENTO DE TECNOLOGIAS DE INFORMAÇÃO E COMUNICAÇÃO</B></p>
        </div>

        <!-- Tabela de dados -->
        <div class="table-container">
            <table class="document-table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Provincia</th>
                        <th>Total Atendidos</th>
                        <th>Masculino</th>
                        <th>Femenino</th>
                        <th>Prova de Vida</th>
                        <th>Cadastrados</th>
                        <th>Reclamações</th>
                        <th>Data´cadastro</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; foreach($boletins as $boletim): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $boletim->nomeProvincia; ?></td>
                        <td><?php echo $boletim->total_atendidos; ?></td>
                        <td><?php echo $boletim->masculino; ?></td>
                        <td><?php echo $boletim->feminino; ?></td>
                        <td><?php echo $boletim->numero_provas_vida; ?></td>
                        <td><?php echo $boletim->numero_cadastrados; ?></td>
                        <td><?php echo $boletim->passes_entregues; ?></td>
                        <td><?php echo formata_data_banco_sem_hora($boletim->cadastrodata); ?></td>
                    </tr>
                <?php endforeach; ?>
                  
                </tbody>
            </table>
        </div>

        <!-- Rodapé -->
        <div class="footer">
            <p>Documento gerado automaticamente. Todos os direitos reservados.</p>
        </div>
       
    </div>
</body>
</html>
