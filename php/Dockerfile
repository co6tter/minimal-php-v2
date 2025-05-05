FROM php:8.4.6-cli-alpine3.20

# tzdata - タイムゾーン DB（ホスト依存にせずに正確な日時を扱う）
# oniguruma - mbstring の依存（文字列操作で多用）
# mbstring - マルチバイト文字列拡張（日本語必須）
RUN apk add --no-cache tzdata oniguruma-dev \
  && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
  && echo "Asia/Tokyo" > /etc/timezone \
  \
  # PHP 拡張をビルド & 取り込み
  # docker-php-ext-install の内部は make を呼び出すので、-j$(nproc) を渡して “CPU コア数と同じ並列ジョブ数” でビルドしてコンパイル時間を短縮。
  && docker-php-ext-install -j$(nproc) mbstring \
  \
  # ビルド用ライブラリ削除でサイズ削減
  && apk del oniguruma-dev

COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /work

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/work/web"]
