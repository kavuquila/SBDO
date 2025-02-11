<?php 


defined('BASEPATH') or exit('Ação não permitida');

function formata_data_banco_com_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}

function tempo_relativo($datetime)
{
    // Converte para o formato timestamp
    $data = new DateTime($datetime);
    $agora = new DateTime(); // Hora atual

    // Calcula a diferença entre a data informada e a hora atual
    $diferenca = $agora->diff($data);
    
    // Verifica a diferença em anos, meses, dias, horas, minutos e segundos
    if ($diferenca->y > 0) {
        return $diferenca->y . ' ano' . ($diferenca->y > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->m > 0) {
        return $diferenca->m . ' mês' . ($diferenca->m > 1 ? 'es' : '') . ' atrás';
    } elseif ($diferenca->d > 0) {
        // Se a diferença for maior que 1 dia, mostra o dia da semana e a data
        $dias_da_semana = array('Domingo', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb');
        $dia_da_semana = $data->format('w'); // Retorna o número do dia da semana (0 = Domingo, 1 = Segunda, ...)
        
        // Retorna o formato "Dia da semana, 09/12/2024"
        return $dias_da_semana[$dia_da_semana] . ', ' . $data->format('d/m/Y');
    } elseif ($diferenca->h > 0) {
        return $diferenca->h . ' hora' . ($diferenca->h > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->i > 0) {
        return $diferenca->i . ' minuto' . ($diferenca->i > 1 ? 's' : '') . ' atrás';
    } elseif ($diferenca->s > 0) {
        if ($diferenca->s < 60) {
            return 'Agora mesmo';
        }
    }
    
    // Caso a data seja maior que 1 dia ou mais, usa a data completa
    return $data->format('d/m/Y H:i');
}


