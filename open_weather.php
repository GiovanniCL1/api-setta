<?php
//consumir api open weather

//funcao que retorna temperatura
function get_temperature()
{
    $ch = curl_init();//inicializa o curl para consumir api

    $lat="-18.59702072094311";
    $lon="-46.51514102560381";
    $key="294705fc736cf4fb7792f49293bfe980";//chave api open weather

    //define parametro do curl com a url do open weather
    curl_setopt($ch, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lon."&appid=".$key."&units=metric");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resultado = curl_exec($ch);
    curl_close($ch);

    // Convertendo a resposta para JSON (se a API retornar dados em JSON)
    $dados = json_decode($resultado, true);

    return $dados["main"]["temp"];
}
?>