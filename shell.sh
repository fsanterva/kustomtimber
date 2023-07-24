flag=true
while [ "$flag" = true ]; do
  export LANG=en_US.UTF-8
  rsync -avz --update --delete --progress kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework/ /mnt/c/wamp64/www/devs/dilate/wp/kustomtimber/public_html/wp-content/themes/dilate-framework/
  git status .
flag=false
done

# rsync -avz --update --delete --progress
# kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/plugins/
# kustomtimber@kustomtimber.ddev.com.au:/home/kustomtimber/public_html/wp-content/themes/dilate-framework/
# /mnt/c/wamp64/www/devs/dilate/wp/kustomtimber/public_html/wp-content/plugins/
# /mnt/c/wamp64/www/devs/dilate/wp/kustomtimber/public_html/wp-content/themes/dilate-framework/
