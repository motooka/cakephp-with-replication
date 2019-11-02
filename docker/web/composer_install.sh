#!/bin/bash

set -e

# install dependencies
cd /repository
yes | composer install

# set permissions
cd /repository/bin
chmod 755 cake

