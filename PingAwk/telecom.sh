#creating default content variables
COUNT=$1
HOST=$2

#if no parameters given then ask parameters
if [ -z "$1" ];then
    echo 'How many times?'
    read COUNT
fi

if [ -z "$2" ];then
    echo 'What Host?'
    read HOST
fi

#gather time and save them in pingdata file
ping -c "$COUNT" "$HOST" | awk 'BEGIN{FS="[:]"}{if($2 != ""){print $2}}' | ./telecom.awk


#if file exists (no error accessing it) proceed or exit
#if [ -s pingdata ];then
#    echo 'Processing data...'
#else
#    echo 'No data exported, exiting...'
#    exit
#fi
