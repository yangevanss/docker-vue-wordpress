## 安裝步驟

1. 到 .env 檔設定基本環境
2. docker compose up -d
3. yarn; yarn dev

## 上傳步驟

1. yarn build
2. .htaccess  RewriteBase、RewriteRule 要改成資料夾對應路徑
3. 壓縮 wordpress 資料夾全部檔案，.htaccess 也要，它是隱藏檔
4. wp-config.php 改成 wp-config-sample.php 裡面的內容
5. 設定 wp-config.php，key從這拿 https://api.wordpress.org/secret-key/1.1/salt/
6. 更新 WPML KEY https://wpml.org/account/sites/

## .sh 檔案說明

1. `dump.sh`：將 docker VM 的 DB 資料匯出至 `/SQL/dump-newest.sql`

## Git Commit Type 規範

1. feat: 新增/修改功能 (feature)。
2. fix: 修補 bug (bug fix)。
3. docs: 文件，增加說明 (documentation)。
4. backup: 備份。EX： SQL檔案
5. data: 資料變化。EX：圖片、固定文案、動態資料
6. style: 格式 (不影響程式碼運行的變動 white-space, formatting, missing semi colons, etc)。
7. refactor: 重構 (既不是新增功能，也不是修補 bug 的程式碼變動)。
8. perf: 改善效能 (A code change that improves performance)。
9. test: 增加測試 (when adding missing tests)。
10. chore: 建構程序或輔助工具的變動 (maintain)。
11. revert: 撤銷回覆先前的 commit 例如：revert: type(scope): subject (回覆版本：xxxx)。


