import matplotlib
matplotlib.use('agg')
import matplotlib.pyplot as plt

import os
import subprocess
from datetime import datetime


try:
    is_admin = os.getuid() == 0
except AttributeError:
    is_admin = ctypes.windll.shell32.IsUserAnAdmin() != 0

if not is_admin:
    print("Please execute this script with administrator right")
    exit()



filename="data.data"
tcpdump="tcpdump -i wlp2s0 -c 100 -ttt"
grep='grep -oh -E "^.[0-9]{2}:[0-9]{2}:[0-9]{2}.[0-9]{6}"'

# os.system("sudo "+tcpdump+" | "+grep+" > "+filename)

lines = []
with open(filename, "r") as f:
    lines = f.readlines()
f.close()

data = []
x, i = [], 0
timeReference = datetime.strptime("00:00:00.000000", '%H:%M:%S.%f')
for line in lines:
    x.append(i)
    i += 1
    line = line[1:-1]
    data.append((datetime.strptime(line, '%H:%M:%S.%f') - timeReference).total_seconds())

plt.plot(x, data, linewidth=1, color="blue")

plt.title('TcpDump statistics')
plt.ylabel('Y-value')
plt.yscale('log')
plt.xlabel('X-value')

plt.grid(True)
#plt.xlim(0, 0)
#plt.ylim(0, 0)
#plt.axis([0, 0, 0, 0])
"""
# graph stretching settings
fig_size = plt.rcParams["figure.figsize"]
fig_size[0] = 15
fig_size[1] = 5
plt.rcParams["figure.figsize"] = fig_size
"""
filename = 'tcpDUMP'
plt.savefig(filename+'.jpg')

print(data)
