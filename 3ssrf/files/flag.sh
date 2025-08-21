#!/bin/bash
echo '111111111';
write_flag_in_fs() {
    # 将flag写入到文件系统中
    if [ -z "$1" ]; then
        flag_path="/flag"
    else
        flag_path="$1"
    fi
    echo ${GZCTF_FLAG} > ${flag_path}
}

write_flag_in_db() {
    local db_name="${1:-web}"
    local db_table="${2:-flag}"
    local db_column="${3:-flag}"
    mysql -uroot -proot -e "update ${db_name}.${db_table} set ${db_column}='${GZCTF_FLAG}';"
    echo mysql -uroot -proot -e "update ${db_name}.${db_table} set ${db_column}='${GZCTF_FLAG}';"
}

write_flag_in_fs 
write_flag_in_db web flag flag

export FLAG=not_flag
FLAG=not_flag