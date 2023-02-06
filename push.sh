monitor_dir="/home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework/components/blog_parent"
run_flag=false
while [ "$run_flag" = false ]; do
  export LANG=en_US.UTF-8
  # inotifywait -e modify,create,delete -r $monitor_dir

  # blog_parent
  rsync -avz --update --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework/components/blog_parent kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework/components/

  # functions.php
  rsync -avz --update --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework/functions.php kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework/

  # critical.css
  # rsync -avz --update --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework/assets/css/critical.css kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework/assets/css/

  sleep 2
  run_flag=true
done
