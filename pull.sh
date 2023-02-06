run_flag=false
while [ "$run_flag" = false ]; do
  export LANG=en_US.UTF-8
  rsync -avz --update --delete --progress kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/
  git status .
  # sleep 16 
  run_flag=true
done
