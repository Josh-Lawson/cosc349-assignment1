
# A Vagrantfile to set up 3 VMs for an Online Recipe Management System. 
#
# The VMs are: 
#
# 1. User interface
# 2. Database server
# 3. Admin interface

Vagrant.configure("2") do |config|
    config.vm.box = "ubuntu/focal64"

    # vm for user interface
    config.vm.define "userinterface" do |userinterface|
        userinterface.vm.hostname = "userinterface"
        userinterface.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
        userinterface.vm.network "private_network", ip: "192.168.56.11"
        userinterface.vm.synced_folder "./www/user", "/vagrant/www/user", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
        userinterface.vm.provision "shell", path: "build-user-interface-vm.sh"
    end

    # vm for database server
    config.vm.define "dbserver" do |dbserver|
        dbserver.vm.hostname = "dbserver"
        dbserver.vm.network "private_network", ip: "192.168.56.12"
        dbserver.vm.synced_folder "./data", "/vagrant/data", owner: "vagrant", mount_options: ["dmode=775,fmode=777"]
        dbserver.vm.provision "shell", path: "build-dbserver-vm.sh"
    end

    # vm for admin interface
    config.vm.define "admininterface" do |admininterface|
        admininterface.vm.hostname = "admininterface"
        admininterface.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
        admininterface.vm.network "private_network", ip: "192.168.56.13"
        admininterface.vm.synced_folder "./www/admin", "/vagrant/www/admin", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
        admininterface.vm.provision "shell", path: "build-admin-interface-vm.sh"
    end
end