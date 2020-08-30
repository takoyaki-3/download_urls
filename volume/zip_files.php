<?php

// 定数の設定
const sleep_time = 15;

date_default_timezone_set('Asia/Tokyo');

$counter=0;
$last = time();

$last_zip = date("Y_m_d_H");

while(true){

  $now_zip = date("Y_m_d_H");
  $is_zip = $last_zip!=$now_zip;

  // 読み込み用にtest.csvを開きます。
  $f = fopen("./url_list.csv", "r");

  while($line = fgetcsv($f)){
    if( count($line) < 4) continue;

    // zip圧縮を行う
    if($is_zip){
      // ディレクトリが存在していなければ作成
      if(!file_exists('data/' . $line[1])) exec('mkdir ' . 'data/' . $line[1]);
      $cmd = 'nohup zip -j data/' . $line[1] .'/'. $last_zip.'.zip tmp/' . $line[1] .'/'.$last_zip.'_*; rm tmp/' . $line[1] .'/'.$last_zip.'_*.'.$line[3].' -f';
      exec($cmd);

      echo 'Zip ' . $last_zip . ' ' . $line[1] . "\n";
    }
  }
  // test.csvを閉じます。
  fclose($f);

  $last_zip=$now_zip;

  // スリープ
  $d = $counter + sleep_time - (time() - $last);
  if($d<0) $d=0;
  sleep($d);
  $counter += sleep_time;
}
?>