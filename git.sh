while true; do

    export LANG=en_US.UTF-8

    rsync -avz --delete --progress kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/

    sleep 10

    git status . 

    sleep 5

    rsync -avz --delete --progress /home/cp_24/wamp64/www/devs/dilate/wp/kustomtimber/wp-content/themes/dilate-framework kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/

    sleep 10 

done
