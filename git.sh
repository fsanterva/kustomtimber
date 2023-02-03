run_flag=false
while [ "$run_flag" = false ]; do
  export LANG=en_US.UTF-8
  ssh kustomtimber@kustomtimber.ddev.com.au
  git status .
  run_flag=true
done
