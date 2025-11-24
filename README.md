# minimal-php-v2

## Overview

シンプルなメッセージ投稿アプリケーション。CRUD 操作（作成、読み取り、編集、削除）と CSRF トークンによるセキュリティ対策を実装した、学習・テンプレート用の最小構成 PHP プロジェクトです。

## Tech Stack

- **PHP**: 8.4.6-cli (Alpine Linux ベース)
- **Docker**: コンテナ化された開発環境
- **Web Server**: PHP ビルトインサーバー
- **Extensions**: mbstring（日本語対応）

## Setup

```bash
# 初回起動（ビルド込み）
docker compose up --build

# 2回目以降はバックグラウンドで起動
docker compose up -d
```

## Usage

```bash
# アプリケーションにアクセス
open http://localhost:8000
```

アプリケーションの機能：

- **メッセージ投稿**: トップページのフォームからメッセージを投稿
- **メッセージ編集**: 各メッセージの "Edit" リンクから編集
- **メッセージ削除**: 各メッセージの "Delete" リンクから削除

## Directory Structure

```
.
├── docker-compose.yml      # Docker Compose 設定
├── php/                    # PHP コンテナ設定
│   ├── Dockerfile         # PHP 8.4.6 + mbstring
│   └── php.ini            # PHP 設定ファイル
└── work/                  # アプリケーションルート
    ├── app/               # アプリケーションロジック
    │   ├── _parts/       # 共通パーツ（ヘッダー・フッター）
    │   ├── functions.php # 共通関数（CSRF トークン、XSS 対策）
    │   └── messages.txt  # メッセージデータ（ファイルベース）
    └── web/              # ドキュメントルート
        ├── index.php     # メッセージ一覧・投稿
        ├── edit.php      # メッセージ編集
        ├── delete.php    # メッセージ削除
        └── result.php    # 処理完了画面
```

## License

This repository is for personal/private use only.
