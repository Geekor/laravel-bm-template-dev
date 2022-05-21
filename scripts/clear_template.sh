#!/bin/bash

function do_clear()
{
    PWD=`pwd`

    # 删除 第三方导入的数据库迁移配置
    cd ./database/migrations/
    rm -f `date '+%Y_%m_%d_*'`
    cd ../..

    # 删除 第三方配置
    cd ./config
    rm -f bm.php bm_roles.php bm_masters.php
    rm -f permission.php
    cd ..

    # 删除 第三方翻译
    cd ./lang && rm -rf vendor/ && cd ..

    # 删除 第三方模块
    cd ./_modules && rm -rf * && cd ..

}

# =====================================

ls ./public 1> /dev/null 2> /dev/null

if [ $? -eq 0 ]; then
    do_clear
else
    echo "You need run this script on root templete directory."
fi



