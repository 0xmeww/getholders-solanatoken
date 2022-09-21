<?php 
echo "[!] Tools untuk mengambil data berapa banyak yang menyimpan sebuah Token tersebut.\n";
echo "[*] Hasil output berupa file JSON.\n\n";
echo "[?] Masukan Token Address Solana :\n";
$token = trim(fgets(STDIN));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.mainnet-beta.solana.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, " \n  {\n    \"jsonrpc\": \"2.0\",\n    \"id\": 1,\n    \"method\": \"getProgramAccounts\",\n    \"params\": [\n      \"TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA\",\n      {\n        \"encoding\": \"jsonParsed\",\n        \"filters\": [\n          {\n            \"dataSize\": 165\n          },\n          {\n            \"memcmp\": {\n              \"offset\": 0,\n              \"bytes\": \"".$token."\"\n            }\n          }\n        ]\n      }\n    ]\n  }\n");

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
echo "Tunggu sebentar ..\n";
$result = curl_exec($ch);


$file = fopen("list-holder.txt", "a+") or die;
$isi = "$result";
$isi .= "\n";
fwrite($file, $isi);
fclose($file);
echo "selesai.\n";
echo "file tersimpan pada file bernama list-holder.txt\n";

curl_close($ch);

?>
