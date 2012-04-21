set :application, "menu"
set :repository,  "git@github.com:dieterve/menu-planner.git"
set :user, "dieter"

set :scm, "git"
set :branch, "master"
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

role :web, "dieterve"                          # Your HTTP server, Apache/etc
role :app, "dieterve"                          # This may be the same as your `Web` server

set :deploy_to, "/home/#{user}/apps/#{application}"
set :deploy_via, :remote_cache

set :keep_releases, 5

set :use_sudo, false

namespace :deploy do
	task :update do
		transaction do
			update_code
			symlink
		end
	end

	task :finalize_update do
		transaction do
			run "chmod -R g+w #{releases_path}/#{release_name}"
		end
	end

	task :symlink do
		transaction do
			run "ln -nfs #{current_release} #{deploy_to}/#{current_dir}"
		end
	end

	task :migrate do
		# Nothing.
	end

	task :restart do
		# Nothing.
	end
end