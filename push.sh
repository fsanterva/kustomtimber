while true; do
    export LANG=en_US.UTF-8
    rsync -avz --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/
    sleep 1 
done
