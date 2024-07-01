<?php
//inclui arquivos conn e open weather
include("../conn.php");
include("../open_weather.php");
date_default_timezone_set('America/Sao_Paulo');

$datetime = new DateTime();
$dataHoraAtual = $datetime->format('Y-m-d H:i:s');
$temperature = get_temperature();

//retorna a eficiencia de acordo com a temperatura
function get_efficience($temp)
{
    if($temp<24.0){
        return 75;
    }
    elseif($temp>28.0){
        return 100;
    }
    else{
        return 85;
    }
}

//salva uma nova analise no banco de dados
function save_analysis($conn, $temp, $eff, $dt)
{
    $sql =  "INSERT INTO analises (eficiencia, temperatura, data_hora) VALUES (".$eff.", ".$temp.", '".$dt."')";

    if ($conn->query($sql) !== TRUE) {
        die("Connection failed: " . $conn->query($sql));
    }
}


//retorna analise do banco de dados em formato json
function get_analysis($conn)
{
    $sql =  "SELECT * FROM analises";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $json_result = [];
        while($row = $result->fetch_assoc()) {
            $linha = [
                "id"=>$row["id"],
                "eficiencia"=> $row["eficiencia"],
                "temperatura"=>$row["temperatura"],
                "data_hora"=>$row["data_hora"],
            ];
            array_push($json_result, $linha);
        }
        return $json_result;
    } else {
        $json_result = [];
    }
}

//chama funcao de salvar analises
save_analysis($conn, $temperature, get_efficience($temperature), $dataHoraAtual);
header('Content-Type: application/json');//define o tipo da resposta pra json

//retornar analises em json
echo json_encode(get_analysis($conn));
?>