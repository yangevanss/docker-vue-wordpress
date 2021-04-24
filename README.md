## 安裝步驟

1. 安裝 docker
2. 打開 docker > 點選「右上角齒輪」進到（Setting) > Resources > FILE SHARING
3. 將 /Applications/MAMP/htdocs/display 加入

4. 將專案 clone 到本地端
5. 將專案在 docker 上執行（同時會將 DB 資料匯入）： `sh recreate.sh`

## .sh 檔案說明

1. 請在根目錄執行 `chmod -R +x ./dump.sh`
2. `dump.sh`：將 docker VM 的 DB 資料匯出至 `/SQL/dump-newest.sql`

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

## wordpress 多國語系說明

1. 多國語言翻譯開啟設定：wp-content/plugins/wp-multilang/core-config.json，任何新註冊的 post-type、taxonomy、options 都要去這邊增加設定才會啟用多語系翻譯

## wordpress public-data 快取說明

1. public-data/base-data.php：先定義好 $global_key 變數為 'global'
2. public-data/lang-switcher.php：如果是多國語言，確認當前語言，將 $global_key 更改為 'global_{當前語言}'
3. public-data/global.php：執行快取程式，如果有快取直接取得相對 $global_key 的快取，無快取狀態會呼叫 callGlobal function，取得資料後，將所有的 key 值放到 $context，設定成全域 twig 變數
4. public-data/og-query.php：處理一切情形的 SMO 資料，若有特殊案例需要額外處理一下

## docker 說明

1. mysql.template：volumes 使用哪個 SQL 檔案，建立的時候就會遵照那個檔案建立
2. 如果有 php 錯誤，可取消註解 WORDPRESS_DEBUG，並且執行 clean.sh 再執行 recreate.sh
# docker-vue-wordpress
