set :domain, "festivaltomorrow.com"
set :application, "festivaltomorrow.com"

set :serverName, "sg111.servergrove.com" # The server's hostname
set :deploy_to,       "/var/www/vhosts/festivaltomorrow.com/symfony_projects/"
ssh_options[:port] = 22123
ssh_options[:paranoid] = false
default_run_options[:pty] = true  

set :repository,  "git://github.com/devrantukan/symfony.git"
set :branch, "master"
set :scm, :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "propel"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

set  :keep_releases,  3
set  :deploy_via, :copy
set  :user,       "festiva1"
set  :use_sudo,   false




# Update vendors during the deploy
set :update_vendors, true

# Set some paths to be shared between versions
set :shared_files,    ["app/config/parameters.ini"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

after "deploy:update" do

run "#{sudo} chmod -R 777 #{deploy_to}/current/app/cache #{deploy_to}/current/app/cache"

end
