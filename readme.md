## CSVに記載したURLから一定時間毎にファイルを取得するプログラム

このプログラムは、取得間隔と保存先ディレクトリ名、URL、拡張子をリストアップすることで、URLから定期的にファイルを取得し、取得時刻を表すファイル名で保存するプログラムです。取得したファイルは1時間ごとにzip圧縮して保存されます。

### 使用方法
1. url_list.csvにダウンロードする間隔（15秒単位）、保存ディレクトリ名、URL、保存拡張子を記載

定期的に岡山県宇野バスのGTFS-RTを取得する例

#### url_list.csv
```
60,unobus_TripUpdate,http://www3.unobus.co.jp/GTFS/GTFS_RT.bin,bin
15,unobus_VehiclePosition,http://www3.unobus.co.jp/GTFS/GTFS_RT-VP.bin,bin
300,unobus_Alert,http://www3.unobus.co.jp/GTFS/GTFS_RT-Alert.bin,bin
```


2. 次のコマンドを実行
```
# Dockerがインストールされている場合
docker-compose up -d
# PHPがインストールされている場合
cd volume
nohup php download_urls.php
```

3. 自動でファイルが保存される

ファイルが取得される毎に``volume/tmp/設定したディレクトリ名``にファイルが保存される。

4. 1時間ごとに圧縮される
``volume/data/設定したディレクトリ名``に1時間ごとに圧縮されたzipファイルが保存される。
