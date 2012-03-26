set :application, "menu"
set :repository,  "git@github.com:dieterve/menu-planner.git"
set :user, "dieter"

set :scm, "git"
set :branch, "master"
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

role :web, "dieterve"                          # Your HTTP server, Apache/etc
role :app, "dieterve"                          # This may be the same as your `Web` server

set :deploy_to, "/home/#{user}/apps/#{application}"

set :use_sudo, false

set :deploy_via, :remote_cache

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

# If you are using Passenger mod_rails uncomment this:
# namespace :deploy do
#   task :start do ; end
#   task :stop do ; end
#   task :restart, :roles => :app, :except => { :no_release => true } do
#     run "#{try_sudo} touch #{File.join(current_path,'tmp','restart.txt')}"
#   end
# end
