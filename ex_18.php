<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Organizar Agenda da Clínica</title>
</head>

<body>

    <form method="POST">

        <h3>Pesquisar Paciente</h3>

        <label for="paciente_busca">Nome do paciente:</label><br>

        <input type="text" id="paciente_busca" name="paciente_busca" value="<?php echo isset($_POST['paciente_busca']) ? htmlspecialchars($_POST['paciente_busca']) : 'Ana Silva'; ?>"><br><br>


        <button type="submit">Processar Agenda</button>

    </form>


    <?php

    function ordenarConsultasPorHorario($consultas) {

        usort($consultas, function($a, $b) {

            $dataHoraA = $a['data'] . ' ' . $a['horario'];

            $dataHoraB = $b['data'] . ' ' . $b['horario'];

            return strcmp($dataHoraA, $dataHoraB);

        });


        return $consultas;

    }


    function contarPacientesDiferentes($consultas) {

        $pacientes = array_map(function($c) {

            return mb_strtolower(trim($c['paciente']), 'UTF-8');

        }, $consultas);


        return count(array_unique($pacientes));

    }


    function contarPorEspecialidade($consultas) {

        $especialidades = [];


        foreach ($consultas as $c) {

            $esp = $c['especialidade'];

            if (!isset($especialidades[$esp])) {

                $especialidades[$esp] = 0;

            }

            $especialidades[$esp]++;

        }


        return $especialidades;

    }


    function buscarPaciente($consultas, $nomeBusca) {

        $resultados = [];

        $nomeBuscaLimpo = mb_strtolower(trim($nomeBusca), 'UTF-8');


        if ($nomeBuscaLimpo === '') {

            return $resultados;

        }


        foreach ($consultas as $c) {

            if (mb_strtolower(trim($c['paciente']), 'UTF-8') === $nomeBuscaLimpo) {

                $resultados[] = $c;

            }

        }


        return $resultados;

    }


    function verificarHorariosDuplicados($consultas) {

        $horariosVistos = [];

        $duplicados = [];


        foreach ($consultas as $c) {

            $chave = $c['data'] . ' ' . $c['horario'];


            if (in_array($chave, $horariosVistos)) {

                if (!in_array($chave, $duplicados)) {

                    $duplicados[] = $chave;

                }

            } else {

                $horariosVistos[] = $chave;

            }

        }


        return $duplicados;

    }


    function obterExtremosAgenda($consultasOrdenadas) {

        if (empty($consultasOrdenadas)) {

            return ['primeiro' => null, 'ultimo' => null];

        }


        return [

            'primeiro' => $consultasOrdenadas[0],

            'ultimo' => $consultasOrdenadas[count($consultasOrdenadas) - 1]

        ];

    }


    function organizarAgenda($consultas, $pacientePesquisa = '') {

        $consultasOrdenadas = ordenarConsultasPorHorario($consultas);

        $extremos = obterExtremosAgenda($consultasOrdenadas);


        return [

            'total_consultas' => count($consultas),

            'pacientes_diferentes' => contarPacientesDiferentes($consultas),

            'consultas_por_especialidade' => contarPorEspecialidade($consultas),

            'primeiro_atendimento' => $extremos['primeiro'],

            'ultimo_atendimento' => $extremos['ultimo'],

            'lista_ordenada' => $consultasOrdenadas,

            'resultado_pesquisa' => buscarPaciente($consultasOrdenadas, $pacientePesquisa),

            'horarios_duplicados' => verificarHorariosDuplicados($consultas)

        ];

    }


    $agendaExemplo = [

        ['paciente' => 'Ana Silva', 'especialidade' => 'Cardiologia', 'data' => '2026-10-10', 'horario' => '14:00'],

        ['paciente' => 'Carlos Andrade', 'especialidade' => 'Dermatologia', 'data' => '2026-10-10', 'horario' => '08:30'],

        ['paciente' => 'Beatriz Souza', 'especialidade' => 'Cardiologia', 'data' => '2026-10-10', 'horario' => '10:00'],

        ['paciente' => 'Ana Silva', 'especialidade' => 'Pediatria', 'data' => '2026-10-10', 'horario' => '16:30'],

        ['paciente' => 'Daniel Oliveira', 'especialidade' => 'Dermatologia', 'data' => '2026-10-10', 'horario' => '10:00']

    ];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $busca = isset($_POST['paciente_busca']) ? $_POST['paciente_busca'] : '';

        $relatorio = organizarAgenda($agendaExemplo, $busca);


        echo "<br><hr><h3>Relatório da Agenda:</h3>";

        echo "<ul>";

        echo "<li><strong>Total de Consultas:</strong> {$relatorio['total_consultas']}</li>";

        echo "<li><strong>Pacientes Diferentes:</strong> {$relatorio['pacientes_diferentes']}</li>";


        echo "<li><strong>Consultas por Especialidade:</strong><ul>";

        foreach ($relatorio['consultas_por_especialidade'] as $esp => $qtd) {

            echo "<li>" . htmlspecialchars($esp) . ": {$qtd}</li>";

        }

        echo "</ul></li>";


        if ($relatorio['primeiro_atendimento']) {

            $p = $relatorio['primeiro_atendimento'];

            echo "<li><strong>Primeiro Atendimento:</strong> {$p['horario']} - " . htmlspecialchars($p['paciente']) . " (" . htmlspecialchars($p['especialidade']) . ")</li>";

        }


        if ($relatorio['ultimo_atendimento']) {

            $u = $relatorio['ultimo_atendimento'];

            echo "<li><strong>Último Atendimento:</strong> {$u['horario']} - " . htmlspecialchars($u['paciente']) . " (" . htmlspecialchars($u['especialidade']) . ")</li>";

        }


        echo "<li><strong>Horários Duplicados:</strong> ";

        if (!empty($relatorio['horarios_duplicados'])) {

            echo implode(', ', $relatorio['horarios_duplicados']);

        } else {

            echo "Nenhum horário duplicado.";

        }

        echo "</li>";


        echo "<li><strong>Resultado da Pesquisa ('" . htmlspecialchars($busca) . "'):</strong>";

        if (!empty($relatorio['resultado_pesquisa'])) {

            echo "<ul>";

            foreach ($relatorio['resultado_pesquisa'] as $res) {

                echo "<li>Data: {$res['data']} | Horário: {$res['horario']} | Especialidade: " . htmlspecialchars($res['especialidade']) . "</li>";

            }

            echo "</ul>";

        } else {

            echo " Nenhum atendimento encontrado.";

        }

        echo "</li>";


        echo "<li><strong>Lista Ordenada de Atendimentos:</strong><ul>";

        foreach ($relatorio['lista_ordenada'] as $c) {

            echo "<li>{$c['data']} {$c['horario']} - " . htmlspecialchars($c['paciente']) . " [" . htmlspecialchars($c['especialidade']) . "]</li>";

        }

        echo "</ul></li>";

        echo "</ul>";

    }

    ?>

</body>
</html>