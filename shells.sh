
set -e # 錯誤回報
read -p "want do you want to do? (dump / deploy): " action_type

if [ "${action_type}" = "dump" ]
then
    sh ./shells/dump.sh
elif [ "${action_type}" = "deploy" ]
then
    sh ./shells/deploy.sh
else
    echo "shell error"
fi