#!/bin/bash

function do_clear()
{
    PWD=`pwd`

    cd ./database/migrations/
    rm -f `date '+%Y_%m_%d_*'`
    cd ../..

    cd ./config
    rm -f bm.php bm_roles.php bm_masters.php
    rm -f permission.php
    cd ..
}

# =====================================

ls ./public 1> /dev/null 2> /dev/null

if [ $? -eq 0 ]; then
    do_clear
else
    echo "You need run this script on root templete directory."
fi



