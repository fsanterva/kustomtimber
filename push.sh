#!/bin/bash

# Define the directory to monitor
monitor_dir="/home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework"

# Flag to indicate whether the script has run
run_flag=false

# Use the "inotifywait" command to monitor changes in the directory
while [ "$run_flag" = false ]; do
  export LANG=en_US.UTF-8
  inotifywait -e modify,create,delete -r $monitor_dir
  rsync -avz --update --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/
  run_flag=false
done
