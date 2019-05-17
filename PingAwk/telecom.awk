#!/usr/bin/awk -f

#define variables
BEGIN {
    FS="[=]|[ ]";
    delete timeArr[0];
    arrLength=0;
    success=0;
    failed=0;
    count=0;

    sum=0;
    min=100000;
    max=0;
    mean=0;
    mdev=0;
}

#calculate data for each line NR, for each column NF
{
  timeArr[arrLength++]=$7;
  count+=1;
  if($3 == count)
    success+=1;
  else
  {
    while(count < $3)
    {
      count+=1;
      failed+=1; 
    }
    success+=1;
  }
}

#print data
END {
  for(i=0;i<arrLength;i++)
  {
    el=timeArr[i];
    if(el<min)
      min=el;
    if(el>max)
      max=el;
    sum+=el;
  }
  mean=sum/arrLength;
 
  for(i=0;i<arrLength;i++)
    mdev+=(timeArr[i]-mean)^2;

  mdev=sqrt(mdev / arrLength);

  print (success+failed), "packets transmitted,", success, "received,", (failed/(success+failed))"%", "packet loss";
  print "rtt min/avg/max/mdev =", min "/" mean "/" max "/" mdev, "ms"
}
