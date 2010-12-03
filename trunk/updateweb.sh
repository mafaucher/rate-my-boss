#!/bin/bash

# updateweb.sh
#
# Script to update a webspace with an svn repository
# This will also make sure the rights are properly set
# 
# Requires access to the group account
#
# Author: Marc-Andre Faucher

name="marc"
reponame="rate-my-boss"
webspace="/www/groups/t/tj_comp353_2/"

# Remove last instance in webspace
if [ -d $webspace$reponame"-"$name ]; then
    echo "Cleaning webspace..."
    rm -rf $webspace$reponame"-"$name
fi

# Copy repository and change permissions
echo "Copying repository in webspace..."
cp -R ../$reponame $webspace$reponame"-"$name
chmod -R 775 $webspace$reponame"-"$name

echo "Done."
