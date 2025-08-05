#!/bin/bash
# Generate dynamic flag with timestamp
FLAG="rooted{$(date +%Y%m%d_%H%M%S)}"
echo $FLAG > /root/root.txt

# Start Apache in foreground
exec apachectl -D FOREGROUND
